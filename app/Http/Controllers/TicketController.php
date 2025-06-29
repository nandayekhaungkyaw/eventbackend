<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Repositories\TicketRepositories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    protected $TicketRepositories;
    public function __construct(TicketRepositories $TicketRepositories)

    {
        $this->TicketRepositories = $TicketRepositories;
    }

    public function index()
    {
        $ticket = Ticket::with('event')->OrderBy('event_id', 'asc')->get();
        return apiResponse(TicketResource::collection($ticket), 'successfully fetched ticket');
    }

    public function eventticket($eventId)
    {
        $ticket = Ticket::where('event_id', '=', $eventId)->get();
        return apiResponse($ticket, 'successfully fetched ticket');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}


    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric|min:0',
            'available_quantity' => 'required|integer|min:0',
            'sale_start_date' => 'required|date',
            'sale_end_date' => 'required|date|after_or_equal:sale_start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tickets')->where(function ($query) use ($request) {
                    return $query->where('event_id', $request->event_id);
                }),
            ],

        ]);
        $ticket = $this->TicketRepositories->create([

            'event_id' => $request->event_id,

            'amount' => $request->amount,
            'available_quantity' => $request->available_quantity,
            'sale_start_date' => $request->sale_start_date,
            'sale_end_date' => $request->sale_end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'title' => $request->title,
            'description'=>$request->description,

        ]);

        return apiResponse(TicketResource::make($ticket), 'successfully created ticket');
    }

    public function show($id)
    {
        if ($this->TicketRepositories->find($id)) {
            $ticket = $this->TicketRepositories->find($id);
            return apiResponse(TicketResource::make($ticket), 'successfully fetched ticket');
        }
        return response()->json([
            'message' => 'ticket not found',
        ], 200);
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
    public function update($id, Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'amount' => 'required|numeric|min:0',
            'available_quantity' => 'required|integer|min:0',
            'sale_start_date' => 'required|date',
            'sale_end_date' => 'required|date|after_or_equal:sale_start_date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tickets')->where(function ($query) use ($request) {
                    return $query->where('event_id', $request->event_id);
                })->ignore($id),
            ],
        ]);
        $ticket = $this->TicketRepositories->update($id, [
            'event_id' => $request->event_id,
            'amount' => $request->amount,
            'title' => $request->title,
            'available_quantity' => $request->available_quantity,
            'sale_start_date' => $request->sale_start_date,
            'sale_end_date' => $request->sale_end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description'=>$request->description,

        ]);

        return apiResponse(TicketResource::make($ticket), 'successfully updated ticket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = $this->TicketRepositories->delete($id);
        return response()->json([

            'message' => 'successfully deleted ticket'

        ], 200);
    }
}
