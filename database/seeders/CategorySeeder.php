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
        $defaultCategories = [
            "فیلم ایرانی",
            "کودک و نوجوان",
            "تئاتر",
            "هنر و تجربه",
            "تئاتر کمدی",
            "فیلم خارجی"
            ];
        foreach ($defaultCategories as $category)
        {
            Category::create([
                "name"=> $category,
                "parent_id"=> null,
            ]);
        }
    }
}
