<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            "phone"=> "989332246347",
            "password"=> "password",
        ]);
        $admin->roles()->sync([1, 2, 3, 4]);
        User::factory(40)->create()->each(function ($artist){
            $artist->roles()->sync([2]);
        });

        User::factory(20)->create()->each(function ($director){
            $director->roles()->sync([3]);
        });

    }

}
