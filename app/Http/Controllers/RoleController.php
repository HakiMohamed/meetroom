<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    // Affiche le formulaire de création de rôle
    public function create()
    {
        return view('roles.create');
    }

    // Enregistre un nouveau rôle
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')->with('status', 'Role created successfully!');
    }

    // Affiche tous les rôles
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    // Affiche les détails d'un rôle
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    // Affiche le formulaire d'édition de rôle
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    // Met à jour un rôle
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$role->id,
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')->with('status', 'Role updated successfully!');
    }

    // Supprime un rôle
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('status', 'Role deleted successfully!');
    }
}
