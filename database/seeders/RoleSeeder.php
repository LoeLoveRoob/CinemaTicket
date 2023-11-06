<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultRoles = ["admin", "artist", "director", "user"];
        foreach ($defaultRoles as $role){
            Role::create([
                "name"=> $role
            ]);
        }
    }
}
