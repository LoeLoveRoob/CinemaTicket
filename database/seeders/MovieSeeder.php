<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Cinema;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Session;
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
            "فرار از زندان",
            "برکینگ بد",
            "مردگان متحرک",
            "دزدو پلیس",
            "اتش بس",
        ];
//        $subCategories = Category::query()->where("parent_id", !null);
//        foreach ($defaultMovies as $defaultMovie)
//        {
//            $subCategories->each(function ($subCategory) use ($defaultMovie){
//                $movie = Movie::factory()->create([
//                    "category_id" => $subCategory->id,
//                    "director_id" => User::directors()->get()->random()->id,
//                    "name" => $defaultMovie,
//                    "rating" => random_int(1, 10),
//                    "about" => fake()->text(10),
//                    "short_story" => fake()->text(30),
//                ]);
//                $cinemas = Cinema::factory(5)->create()->each(function ($cinema){
//                    Session::factory()->create([
//                        "cinema_id"=> $cinema->id
//                    ]);
//                });
//                $movie->cinemas()->sync($cinemas->pluck("id"));
//            });
//        }
        foreach ($defaultMovies as $defaultMovie) {
            $movie = Movie::factory()->create([
                "category_id" => Category::all()->random(),
                "director_id" => User::directors()->get()->random()->id,
                "name" => $defaultMovie,
                "rating" => rand(1, 10),
                "about" => fake()->text(10),
                "short_story" => fake()->text(30),
            ]);
            $movie->genres()->sync(Genre::all()->random()->id);
            $movie->artists()->sync(User::artists()->get()->random(rand(10, 30))->pluck("id"));
        }
    }
}
