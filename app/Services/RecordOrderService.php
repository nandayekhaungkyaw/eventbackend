<?php

namespace App\Services;

use App\Models\Order;
use App\Models\RecordOrder;
use Illuminate\Support\Facades\DB;

class RecordOrderService
{
    public function archiveConfirmedOrders()
    {
// return  $confirmedOrders = Order::with('event', 'ticket')->where('status', 'confirmed')->get();


         return DB::transaction(function () {
        $confirmedOrders = Order::with('event', 'ticket')->where('status', 'confirmed')->get();

        foreach ($confirmedOrders as $order) {
            RecordOrder::create([
                'event_title' => $order->event->title,
                'ticket_title' => $order->ticket->title,
                'quantity' => $order->quantity,
                'total_amount' => $order->total_amount,
                'phone' => $order->phone,
                'status' => $order->status,
                'payment_method' => $order->payment_method,
                'transaction_id' => $order->transaction_id,
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'email' => $order->email,
                'confirmed_email' => $order->confirmed_email,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
            ]);
            $order->delete();
        }

        // ✅ this return goes back to DB::transaction() which goes back to service function
        return $confirmedOrders;
    });
    }

}
