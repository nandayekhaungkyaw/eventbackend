<?php

namespace App\Http\Controllers;

use App\Models\RecordOrder;
use App\Http\Requests\StoreRecordOrderRequest;
use App\Http\Requests\UpdateRecordOrderRequest;
use App\Models\Order;
use App\Services\RecordOrderService;

class RecordOrderController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     */

     protected $recordOrderService;


    public function __construct(RecordOrderService $recordOrderService)
    {
        $this-> recordOrderService = $recordOrderService;
    }

    public function saveRecord()
    {
       $data= $this->recordOrderService->archiveConfirmedOrders();
        return response()->json(['message' => 'Orders archived successfully.',
        'data' => $data],200);
    }
    public function saveRecordAll()
    {
      $SaveRecord=RecordOrder::paginate(10);
        return response()->json(['message' => 'Orders archived successfully fetched.',
        'data' => $SaveRecord],200);
    }

    public function searchRecordOrder($search)
    {
        $recordOrders = RecordOrder::where('event_title', 'like', "%{$search}%")
            ->orWhere('ticket_title', 'like', "%{$search}%")
            ->orWhere('first_name', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%")
            ->orwhere('total_amount', 'like', "%{$search}%")
            ->paginate(10);

        return response()->json(['message' => 'Search results fetched successfully.',
        'data' => $recordOrders], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RecordOrder $recordOrder)
    {
        //
    }

    public function showRecordOrder($id)
    {
        $recordOrder = RecordOrder::find($id);
        if ($recordOrder) {
            return response()->json(['message' => 'Record order fetched successfully.',
            'data' => $recordOrder], 200);
        }
        return response()->json(['message' => 'Record order not found.'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RecordOrder $recordOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordOrderRequest $request, RecordOrder $recordOrder)
    {
        //
    }

    public function recordOrderAll(){
  // 1. Get confirmed orders with relationships
$confirmedOrders = Order::where('status', 'confirmed')
    ->with(['event', 'ticket'])
    ->get()
    ->map(function ($order) {
        return [
            'id' => $order->id,
            'type' => 'confirmed_order',
            'event_title' => $order->event->title ?? 'Unknown Event',
            'ticket_title' => $order->ticket->title ?? 'Unknown Ticket',
            'quantity' => $order->quantity,
            'created_at' => $order->created_at,
        ];
    });

// 2. Get all RecordOrders (assume already includes event/ticket info or similar)
$recordOrders = RecordOrder::all()->map(function ($record) {
    return [
        'id' => $record->id,
        'type' => 'record_order',
        'event_title' => $record->event_title ?? 'Unknown Event',
        'ticket_title' => $record->ticket_title ?? 'Unknown Ticket',
        'quantity' => $record->quantity,
        'created_at' => $record->created_at,
    ];
});

// 3. Merge both
$combined = $recordOrders->concat($confirmedOrders)->values();

// 4. Return response
return response()->json([
    'message' => 'Record orders + confirmed orders fetched successfully.',
    'data' => $combined
], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecordOrder $recordOrder)
    {
        //
    }
}
