<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login function
    public function login(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'identifier' => 'required',
            'password' => 'required',
        ]);

        // Détermination du type de champ (email ou employeId)
        $fieldType = filter_var($request->identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'employeId';

        // Vérification des informations d'identification
        $credentials = [
            $fieldType => $request->identifier,
            'password' => $request->password,
        ];

        // Tentative de connexion
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Régénération de la session pour prévenir le fixation de session

            return redirect()->intended('/')->with('success', 'You are logged in!');
        }

        // Retourner les erreurs si la connexion échoue
        return back()->withErrors([
            'identifier' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show the register form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Register function
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'employeId' => 'required|string|unique:users,employeId|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new user with role_id = 2 (default)
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'employeId' => $request->employeId,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2, // Default role is set to 2
        ]);

        // Set up the Brevo API configuration
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', env('MAIL_PASSWORD'));

        $emailApi = new TransactionalEmailsApi(
            new \GuzzleHttp\Client,
            $config
        );

        $email = new SendSmtpEmail([
            'to' => [['email' => $user->email]],
            'subject' => 'Welcome to Our Platform!',
            'htmlContent' => '<p>Hello '.$user->firstname.$user->lastname.',</p>'.
                             '<p>Welcome to our platform! Here are your credentials:</p>'.
                             '<p><strong>Employee ID:</strong> '.$user->employeId.'</p>'.
                             '<p><strong>Email:</strong> '.$user->email.'</p>'.
                             '<p><strong>Password:</strong> '.$request->password.'</p>'.
                             '<p>Thank you for joining us!</p>',
            'sender' => ['email' => env('MAIL_FROM_ADDRESS'), 'name' => env('MAIL_FROM_NAME')],
        ]);

        try {
            $response = $emailApi->sendTransacEmail($email);
            Auth::login($user);

            return redirect()->route('home')->with('success', 'Account created successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email. Error: '.$e->getMessage());

            return back()->with('error', 'Failed to send welcome email. Please try again.'.$e->getMessage());
        }
    }

    // Logout function
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
