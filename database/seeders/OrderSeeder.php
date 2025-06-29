<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $eventIds = Event::pluck('id', 'title');
          $ticketIds = Ticket::pluck('id', 'title');
       $orders = [
            [
                'ticket_id' => $ticketIds['VIP Ticket'],
                'event_id' => $eventIds['Laravel Workshop'],
                'quantity' => 2,
                'total_amount' => 200.00,
                'phone' => '0912345678',
                'status' => 'pending',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'confirmed_email' => 'john@example.com',
                'payment_method' => 'WAVE MONEY',
                'transaction_id' => 'TXN123456',
            ],
            [
                'ticket_id' => $ticketIds['Regular Ticket'],
                'event_id' => $eventIds['Laravel Workshop'],
                'quantity' => 1,
                'total_amount' => 100.00,
                'phone' => '0923456789',
                'status' => 'pending',
                'first_name' => 'Alice',
                'last_name' => 'Smith',
                'email' => 'alice@example.com',
                'confirmed_email' => 'alice@example.com',
                'payment_method' => 'AYA',
                'transaction_id' => 'TXN987654',
            ],
            [
                'ticket_id' => $ticketIds['Regular Ticket'],
                'event_id' => $eventIds['Laravel Workshop'],
                'quantity' => 3,
                'total_amount' => 300.00,
                'phone' => '0934567890',
                'status' => 'pending',
                'first_name' => 'Bob',
                'last_name' => 'Brown',
                'email' => 'bob@example.com',
                'confirmed_email' => 'bob@example.com',
                'payment_method' => 'KBZ',
                'transaction_id' => 'TXN112233',
            ]
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
