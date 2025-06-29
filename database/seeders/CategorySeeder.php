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
         $categories = [
            ['name' => 'Education', 'description' => 'Educational events and activities.'],
            ['name' => 'Party', 'description' => 'Fun and entertaining parties.'],
            ['name' => 'Conference', 'description' => 'Professional conferences and meetings.'],
            ['name' => 'Workshop', 'description' => 'Hands-on workshops for skill development.'],
            ['name' => 'Sports', 'description' => 'Sports competitions and events.'],
            ['name' => 'Concert', 'description' => 'Live music concerts and performances.'],
            ['name' => 'Charity / Fundraising', 'description' => 'Events for charity and fundraising.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
