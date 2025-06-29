<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderService
{
    public function confirmOrder(Order $order)
    {

        if ($order->status !== 'pending') {
            throw new Exception("Only pending orders can be confirmed.");
        }

        $ticket = $order->ticket;

        if ($ticket->available_quantity < $order->quantity) {
            throw new Exception("Not enough tickets available.");
        }

        DB::transaction(function () use ($order, $ticket) {
            // Reduce ticket quantity
            $ticket->available_quantity -= $order->quantity;
            $ticket->save();

            // Update order status
            $order->status = 'confirmed';
            $order->save();
        });

        return $order;
    }
}
