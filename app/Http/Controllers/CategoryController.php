<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepositories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $CategoryRepository;
     public function __construct(CategoryRepositories $CategoryRepository)

     {
         $this->CategoryRepository=$CategoryRepository;

     }

    public function index()
    {
       $categories=Category::all();
       return apiResponse($categories,'successfully fetched categories');
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
            'name' => 'required|string|max:255|unique:categories,name',

        ]);
        $category=$this->CategoryRepository->create([
    'name'=>$request->name,
    'description'=>$request->description
]);

return apiResponse($category,'successfully created category');
    }

    public function show($id)
    {
       if($this->CategoryRepository->find($id)){
        $category=$this->CategoryRepository->find($id);
        return apiResponse($category,'successfully fetched category');
    }

          return response()->json([
        'message' => 'category not found',
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
            'name' => 'required|string|max:255|unique:categories,name,' . $id .',id',

            ]);
      $category=$this->CategoryRepository->update($id,[
    'name'=>$request->name,
    'description'=>$request->description]);

    return apiResponse($category,'successfully updated category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=$this->CategoryRepository->delete($id);
            return response()->json([

        'message' => 'successfully deleted category'

    ],200 );

    }
}
