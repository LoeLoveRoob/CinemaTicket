<?php

namespace Database\Seeders;

use App\Models\Session;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Session::all()->each(function ($session) {
            Ticket::factory(rand(1, 30))->create([
                "session_id"=> $session->id,
            ]);
        });
    }
}
