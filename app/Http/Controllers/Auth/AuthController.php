<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\WelcomeEmail;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('identifier', 'password');

        $user = User::where('email', $credentials['identifier'])
                    ->orWhere('EmployeId', $credentials['identifier'])
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'identifier' => 'Les informations de connexion ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'EmployeId' => 'required|string|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'EmployeId' => $request->EmployeId,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        // Envoyer un email de bienvenue
        Notification::send($user, new WelcomeEmail($user));

        Auth::login($user);

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
