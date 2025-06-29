<?php

namespace App\Http\Controllers;

use App\Models\Type;

use App\Repositories\TypeRepositories;
use Illuminate\Http\Request;

class TypeController extends Controller
{

     protected $TypeRepositories;
     public function __construct(TypeRepositories $TypeRepositories)

     {
         $this->TypeRepositories=$TypeRepositories;

     }

    public function index()
    {
       $type=Type::all();
       return apiResponse($type,'successfully fetched type');
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
            'name' => 'required|string|max:255|unique:types,name',
        ]);
        $type=$this->TypeRepositories->create([
    'name'=>$request->name,

]);

return apiResponse($type,'successfully created type');
    }

    public function show($id)
    {
        if($this->TypeRepositories->find($id)){
            $type=$this->TypeRepositories->find($id);
            return apiResponse($type,'successfully fetched type');
        }
        return response()->json([
        'message' => 'type not found',
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
        $request->validate([
            'name' => 'required|string|max:255|unique:types,name,' . $id .',id',

        ]);
      $type=$this->TypeRepositories->update($id,[
    'name'=>$request->name,
   ]);

    return apiResponse($type,'successfully updated type');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type=$this->TypeRepositories->delete($id);
            return response()->json([

        'message' => 'successfully deleted type'

    ],200 );

    }
}
