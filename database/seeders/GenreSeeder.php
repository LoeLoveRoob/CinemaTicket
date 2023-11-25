<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultGenres = [
            "درام",
            "کمدی",
            "ترسناک",
            "هیجان انگیز"
        ];
        foreach ($defaultGenres as $genre)
        {
            Genre::factory()->create([
                "name"=> $genre,
            ]);
        }
    }
}
