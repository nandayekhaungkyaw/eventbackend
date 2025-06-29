<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventId=Event::pluck('id','title');
        $tickets = [
            [
                'event_id' => $eventId['Laravel Workshop'],
                'title' => 'VIP Ticket',
                'amount' => 1500.00,
                'available_quantity' => 50,
                'sale_start_date' => '2025-06-20',
                'sale_end_date' => '2025-06-30',
                'start_time' => '09:00',
                'end_time' => '18:00',
                'description'=>'you can be fronted of the stage'
            ],
            [
                'event_id' =>  $eventId['Laravel Workshop'],
                'title' => 'Regular Ticket',
                'amount' => 750.00,
                'available_quantity' => 200,
                'sale_start_date' => '2025-06-20',
                'sale_end_date' => '2025-06-30',
                'start_time' => '09:00',
                'description'=>'you can be just mid and back of the stage',
                'end_time' => '18:00',
            ],
            [
                'event_id' =>  $eventId['Laravel Workshop'],
                'title' => 'Student Ticket',
                'amount' => 500.00,
                'available_quantity' => 100,
                'sale_start_date' => '2025-07-01',
                'sale_end_date' => '2025-07-10',
                'start_time' => '10:00',
                'end_time' => '17:00',
                'description'=>'you can be just side of the stage',
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
