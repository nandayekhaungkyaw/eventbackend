<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Image;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'kyaw@gmail.com',
            'password' => Hash::make('password'),
        ]);

         $this->call([
        CategorySeeder::class,
    ]);
    $this->call([
        TypeSeeder::class,
    ]);
    $this->call([
        EventSeeder::class,
        FaqSeeder::class,
        ImageSeeder::class,
        TicketSeeder::class,
        OrderSeeder::class,
    ]);
    }
}
