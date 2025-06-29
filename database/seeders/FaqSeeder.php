<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $eventIds = Event::pluck('id', 'title');

       $faqs = [

        [
            'event_id' => $eventIds['Laravel Workshop'],
            'question' => 'What is Laravel 10?',
            'answer' => 'Laravel is a web application framework for PHP that provides a robust development environment for building web applications using the MVC architecture.',
        ],
        [
            'event_id' => $eventIds['PHP Conference 2025'],
            'question' => 'What is php Conference 2024?',
            'answer' => 'php is a web application framework for PHP that provides a robust development environment for building web applications using the MVC architecture.',
        ],
             [
            'event_id' => $eventIds['PHP Conference 2025'],
            'question' => 'What is PHP Conference 2025?',
            'answer' => 'php is a web application framework for PHP that provides a robust development environment for building web applications using the MVC architecture.',
        ],
        [

            'event_id' => $eventIds['Laravel Workshop'],
            'question' => 'What is Laravel 12?',
            'answer' => 'Laravel is a web application framework for PHP that provides a robust development environment for building web applications using the MVC architecture.',
        ]

        ];

        foreach ($faqs as $faq) {
         Faq::create($faq);
        }
    }
}
