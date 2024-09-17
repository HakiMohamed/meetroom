<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Assurez-vous que les rôles existent
        $adminRole = Role::where('name', 'admin')->first();
        $employeeRole = Role::where('name', 'employe')->first();

        // Crée un compte admin
        User::create([
            'firstname' => 'Mohamed',
            'lastname' => 'Haki',
            'employeId' => 'A123456',
            'email' => 'MohamedHaki70@gmail.com',
            'role_id' => $adminRole->id,
            'password' => bcrypt('adminpassword'),
        ]);

    }
}
