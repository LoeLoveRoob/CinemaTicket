<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Session;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"=> User::all()->random()->id,
            "session_id"=> Session::all()->random()->id,
            "price"=> rand(10_000, 20_000)
        ];
    }
}
