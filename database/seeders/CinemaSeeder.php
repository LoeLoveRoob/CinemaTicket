<?php

namespace Database\Seeders;

use App\Models\Cinema;
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
            "هویزه"
        ];
        foreach ($defaultCinemas as $cinema)
        {
            Cinema::create([
                "name"=> $cinema,
                "address"=> fake()->address(),
                "rating"=> random_int(1, 10),
                "salons"=> json_encode([1, 2]),
            ]);
        }
    }
}
