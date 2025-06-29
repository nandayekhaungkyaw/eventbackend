<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Repositories\EventRepositories;
use Illuminate\Http\Request;

class EventController extends Controller
{

     protected $EventRepositories;
     public function __construct(EventRepositories $EventRepositories)

     {
         $this->EventRepositories=$EventRepositories;

     }

    public function index()
    {
       $event=Event::all();
       return apiResponse(EventResource::collection($event),'successfully fetched type');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }


    public function store(EventRequest $request)
    {


        $event=$this->EventRepositories->create([
             'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'category_id' => $request->category_id,
        'type_id' => $request->type_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'googleMap' => $request->googleMap,
        'price' => $request->price


]);

return apiResponse(EventResource::make($event),'successfully created type');
    }

    public function show($id)
    {
        if($this->EventRepositories->find($id)){
            $event=$this->EventRepositories->find($id);
            return apiResponse(EventResource::make($event),'successfully fetched event');
        }
        return response()->json([

            'message' => 'event not found',


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
    public function update($id,EventRequest $request)
    {
      $event=$this->EventRepositories->update($id,[
      'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'category_id' => $request->category_id,
        'type_id' => $request->type_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'googleMap' => $request->googleMap,
        'price' => $request->price


   ]);

    return apiResponse(EventResource::make($event),'successfully updated event');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if($this->EventRepositories->find($id)){
            $event=$this->EventRepositories->delete($id);
            return response()->json([

        'message' => 'successfully deleted event'

    ],200 );

    }
        }


}
