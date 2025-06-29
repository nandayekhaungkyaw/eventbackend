<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqResource;
use App\Models\Faq;

use App\Repositories\FaqRepositories;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $FaqRepositories;
     public function __construct(FaqRepositories $FaqRepositories)

     {
         $this->FaqRepositories=$FaqRepositories;

     }

    public function index()
    {
       $faq=Faq::all();
       return apiResponse(FaqResource::collection($faq),'successfully fetched faq');
    }

    public function eventFaq($eventId)
    {
        $faq=Faq::where('event_id','=',$eventId)->get();
        return apiResponse(FaqResource::collection($faq),'successfully fetched faq');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {


    }


    public function store(Request $request)
    {
        $faq=$this->FaqRepositories->create([
    'question'=>$request->question,
    'answer'=>$request->answer,
    'event_id'=>$request->event_id

]);

return apiResponse(FaqResource::make($faq),'successfully created faq');
    }

    public function show($id)
    {
      if($this->FaqRepositories->find($id)){
          $faq=$this->FaqRepositories->find($id);
        return apiResponse(FaqResource::make($faq),'successfully fetched faq');

      }
      return response()->json([
        'message' => 'faq not found',
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
      $faq=$this->FaqRepositories->update($id,[
    'question'=>$request->question,
    'answer'=>$request->answer,
    'event_id'=>$request->event_id

   ]);

    return apiResponse(FaqResource::make($faq),'successfully updated faq');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq=$this->FaqRepositories->delete($id);
            return response()->json([

        'message' => 'successfully deleted faq'

    ],200 );

    }
}
