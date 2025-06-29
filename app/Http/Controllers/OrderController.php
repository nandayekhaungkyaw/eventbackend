<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;

use App\Repositories\OrderRepositories;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
 protected $OrderRepositories;
 protected $orderService;
     public function __construct(OrderRepositories $OrderRepositories,OrderService $orderService)

     {
         $this->OrderRepositories=$OrderRepositories;
          $this->orderService = $orderService;

     }
      public function confirm($id)
    {
        $order = Order::with('ticket')->findOrFail($id);

        try {
            $confirmedOrder = $this->orderService->confirmOrder($order);
            return response()->json([
                'message' => 'Order confirmed successfully',
                'order' => $confirmedOrder
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function index()
    {
       $Order = Order::with(['ticket', 'event', 'event.category', 'event.type'])->OrderBy('created_at', 'desc')->get();
       return apiResponse(OrderResource::collection($Order),'successfully fetched Order');
    }

    public function eventOrder($eventId)
    {
        $Order=Order::where('event_id','=',$eventId)->get();
        return apiResponse(OrderResource::collection($Order),'successfully fetched Order');
    }

    public function ticketOrder($ticketId)
    {
        $Order=Order::where('ticket_id','=',$ticketId)->get();
        return apiResponse(OrderResource::collection($Order),'successfully fetched Order');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }


    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
    'ticket_id' => [
        'required',
        Rule::exists('tickets', 'id')->where(function ($query) use ($request) {
            $query->where('event_id', $request->event_id);
        }),
    ],
    'quantity' => 'required|integer|min:1',
    'total_amount' => 'required|numeric|min:0',
    'phone' => 'nullable|string|max:20',
    'status' => 'nullable|in:pending,paid,cancelled,confirmed',
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'transaction_id' => 'required|string|max:255',
   'payment_method' => 'required|string|max:255|in:KBZ,AYA,WAVE MONEY,CB PAY,MPT PAY,OK PAY,K PAY,E-WALLET,Free',

    'confirmed_email' => 'required|same:email',  // Confirmed email should match email
]);

        $Order=$this->OrderRepositories->create([
    'ticket_id' => $request->ticket_id,
    'event_id' => $request->event_id,
    'quantity' => $request->quantity,
    'total_amount' => $request->total_amount,
    'phone' => $request->phone, // nullable
    'status' => $request->status ?? 'pending',
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'email' => $request->email,
    'confirmed_email' => $request->confirmed_email,
    'payment_method'=>$request->payment_method,
    'transaction_id'=>$request->transaction_id,

]);

return apiResponse(OrderResource::make($Order),'successfully created Order');
    }

    public function show($id)
    {
      if($this->OrderRepositories->find($id)){
          $Order=$this->OrderRepositories->find($id);
        return apiResponse(OrderResource::make($Order),'successfully fetched Order');

      }
      return response()->json([
        'message' => 'Order not found',
      ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,Request $request)
    {
      $Order=$this->OrderRepositories->update($id,[
    'question'=>$request->question,
    'answer'=>$request->answer,
    'event_id'=>$request->event_id

   ]);

    return apiResponse($Order,'successfully updated Order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Order=$this->OrderRepositories->delete($id);
            return response()->json([

        'message' => 'successfully deleted Order'

    ],200 );

    }

}
