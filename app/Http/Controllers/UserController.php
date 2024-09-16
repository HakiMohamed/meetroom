<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreated;

class UserController extends Controller
{
    // Affiche le formulaire de création d'utilisateur
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    // Enregistre un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'EmployeId' => 'required|string|unique:users,EmployeId',
            'password' => 'required|string|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'EmployeId' => $request->input('EmployeId'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
        ]);

        // Send email with credentials
        Mail::to($user->email)->send(new UserCreated($user, $request->input('password')));

        return redirect()->route('users.index')->with('status', 'User created successfully!');
    }

    // Affiche tous les utilisateurs
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Affiche les détails d'un utilisateur
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Affiche le formulaire d'édition d'utilisateur
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    // Met à jour un utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'EmployeId' => 'required|string|unique:users,EmployeId,' . $user->id,
            'password' => 'nullable|string|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'email' => $request->input('email'),
            'EmployeId' => $request->input('EmployeId'),
            'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
            'role_id' => $request->input('role_id'),
        ]);

        return redirect()->route('users.index')->with('status', 'User updated successfully!');
    }

    // Supprime un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User deleted successfully!');
    }
}
