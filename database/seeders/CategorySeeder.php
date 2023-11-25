<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainCategories = [
            "بزرگسال",
            "خانواده",
            "کودکان",
        ];

        foreach ($mainCategories as $mainCategory)
        {
            Category::factory()->create([
                "name"=> $mainCategory,
                "parent_id"=> null,
            ]);
        }
    }
}
