<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultMovies = [
            "اطلس",
            "هویزه"
        ];
        foreach ($defaultMovies as $movie)
        {
            Movie::create([
                "category_id"=> Category::all()->random()->id,
                "director_id"=> User::directors()->get()->random()->id,
                "name"=> $movie,
                "rating"=> random_int(1, 10),
                "about"=> fake()->text(10),
                "short_story"=> fake()->text(30),
            ]);
        }
    }
}
