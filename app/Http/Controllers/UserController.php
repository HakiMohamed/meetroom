<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Display a list of users
    public function index()
    {
        $users = User::with('role')->paginate(10);

        return view('users.index', compact('users'));
    }

    // Show the form to create a new user
    public function create()
    {
        $roles = Role::all(); // Fetch roles for assignment

        return view('users.create', compact('roles'));
    }

    // Store a new user in the database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'employeId' => 'required|string|unique:users,employeId|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', // Ensure role exists
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'employeId' => $request->employeId,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id, // Assign role
        ]);

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

            return redirect()->route('users.index')->with('success', 'Account created successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email. Error: '.$e->getMessage());

            return back()->with('error', 'Failed to send welcome email. Please try again.'.$e->getMessage());
        }

    }

    // Show the form for editing a user
    public function edit(User $user)
    {
        $roles = Role::all(); // Fetch roles for assignment

        return view('users.edit', compact('user', 'roles'));
    }

    // Update a user in the database
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'employeId' => 'required|string|max:255|unique:users,employeId,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', // Ensure role exists
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'employeId' => $request->employeId,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id, // Assign role
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove a user from the database
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
