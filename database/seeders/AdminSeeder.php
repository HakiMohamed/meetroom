<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Assurez-vous que les rôles existent
        $adminRole = Role::where('name', 'admin')->first();
        $employeeRole = Role::where('name', 'employe')->first();

        // Crée un compte admin
        $admin = User::create([
            'firstname' => 'Mohamed',
            'lastname' => 'Haki',
            'id_employe' => 'A123456',
            'email' => 'MohamedHaki70@gmail.com',
            'password' => Hash::make('adminpassword'),
        ]);

        // Assigner le rôle 'admin'
        $admin->roles()->attach($adminRole);

        
        
    }
}
