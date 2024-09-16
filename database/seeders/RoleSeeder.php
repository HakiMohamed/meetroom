<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Définir les rôles à ajouter
        $roles = [
            ['name' => 'admin'],
            ['name' => 'employe'],
        ];

        // Insérer les rôles dans la table 'roles'
        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['name' => $role['name']],
                ['name' => $role['name']]
            );
        }
    }
}
