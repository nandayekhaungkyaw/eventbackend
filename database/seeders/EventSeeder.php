<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id', 'name');
$typeIds = Type::pluck('id', 'name');

       $events = [
    [
        'title' => 'Laravel Workshop',
        'description' => 'A hands-on Laravel development workshop for beginners and advanced learners.',
        'location' => 'Yangon Convention Center',
        'category_id' => $categoryIds['Education'],
        'type_id' => $typeIds['Online'],
        'start_date' => '2025-07-01',
        'end_date' => '2025-07-02',
        'start_time' => '09:30:00',
        'end_time' => '16:00:00',
        'price' => 'free',
        'googleMap'=>'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3818.651001990381!2d96.14724315949506!3d16.84366098946521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c194a01c730fd7%3A0xb159dc82ca48eb50!2sYangon%20Convention%20Center!5e0!3m2!1sen!2smm!4v1750323615652!5m2!1sen!2smm" '
    ],
    [
        'title' => 'PHP Conference 2025',
        'description' => 'Annual PHP developer conference with international speakers.',
        'location' => 'Mandalay Grand Hotel',
       'category_id' => $categoryIds['Party'],
        'type_id' => $typeIds['Offline'],
        'start_date' => '2025-08-10',
        'end_date' => '2025-08-12',
        'start_time' => '10:00:00',
        'end_time' => '17:00:00',
        'price' => 'paid',
        'googleMap'=>'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3809809.5431851367!2d92.66143798828124!3d21.17160633827274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ca3f4624c9bda7%3A0x4ee09e591684cb4d!2sAureum%20Palace%20Hotel%20%26%20Resort%20Bagan!5e0!3m2!1sen!2smm!4v1750323664314!5m2!1sen!2smm" '
    ],
    [
        'title' => 'Summer Charity Concert',
        'description' => 'A charity concert to raise funds for local children hospitals.',
        'location' => 'Yangon Stadium',
        'category_id' => $categoryIds['Sports'],
        'type_id' => $typeIds['Both'],
        'start_date' => '2025-09-05',
        'end_date' => '2025-09-05',
        'start_time' => '18:00:00',
        'end_time' => '22:00:00',
        'price' => 'paid',
        'googleMap'=>'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15276.365490285749!2d96.16323014484601!3d16.821822578659514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c19360a0b860f7%3A0xf8369d6a8a729bab!2sHotel%20Stadium%20Yangon!5e0!3m2!1sen!2smm!4v1750323716999!5m2!1sen!2smm" '
    ],
];

foreach ($events as $event) {
    Event::create($event);
}
    }
}
