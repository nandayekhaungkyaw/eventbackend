<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Http\Resources\ImageResource;
use App\Repositories\ImageRepositories;

use Illuminate\Http\Request;


class ImageController extends Controller
{
    protected $ImageRepositories;
    public function __construct(ImageRepositories $ImageRepositories)
    {
        $this->ImageRepositories = $ImageRepositories;
    }

    public function index()
    {
        $Image = Image::OrderBy('event_id', 'asc')->get();
        return apiResponse(ImageResource::collection($Image), 'successfully fetched Image');
    }

    public function eventImage($eventId)
    {
        $Image = Image::where('event_id', '=', $eventId)->get();

        return apiResponse(ImageResource::collection($Image), 'successfully fetched EventImage');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            'event_id' => 'required|exists:events,id'
        ]);
        $uploadedImages = [];

        foreach ($request->file('image') as $image) {
            $imageName = "EventImage_" . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('eventImages', $imageName, 'public');
            $uploadedImages[] = [
                'event_id' => $request->event_id,
                'url' => asset('storage/eventImages/' . $imageName),
            ];
            $Image = $this->ImageRepositories->create([
                'image' => $imageName,
                'event_id' => $request->event_id
            ]);
        }


        return apiResponse($uploadedImages, 'successfully created Image');
    }

    public function show($id)
    {
        if ($this->ImageRepositories->find($id)) {
            $Image = $this->ImageRepositories->find($id);
            return apiResponse(ImageResource::make($Image), 'successfully fetched Image');
        }
        return response()->json([
            'message' => 'Image not found',
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }


    public function update($id, Request $request) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Image = $this->ImageRepositories->delete($id);
        return response()->json([

            'message' => 'successfully deleted Image'

        ], 200);
    }
}
