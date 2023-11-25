<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\City;
use App\Policies\CinemaPolicy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultCinemas = [
            "اطلس",
            "هویزه",
            "افریقا",
            "پارک بازار",
            "رجایی",
            "ملل"
        ];
        foreach ($defaultCinemas as $cinema)
        {
            Cinema::factory()->create([
                "name"=> $cinema,
            ]);
        }
    }
}
