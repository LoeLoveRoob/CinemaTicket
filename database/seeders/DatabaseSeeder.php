<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        # priority is important!
        $seeders = [
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            GenreSeeder::class,
            CinemaSeeder::class,
            CitySeeder::class,
            MovieSeeder::class,
            SalonSeeder::class,
            SessionSeeder::class,
            TicketSeeder::class,
        ];

        foreach ($seeders as $seeder)
        {
            $this->call(
                $seeder
            );
        }
    }
}
