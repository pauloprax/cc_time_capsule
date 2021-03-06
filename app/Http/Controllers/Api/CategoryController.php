<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        //return CategoryResource::collection(Category::select('id','name')->get());
        //return CategoryResource::collection(Category::all());
        return CategoryResource::collection(Category::paginate(20));
    }

    public function show(Category $category)
    {
        //return $category;
        return new CategoryResource($category);
    }

    public function store(StoreCategoryRequest $request){
        $category = Category::create($request->all());
        
        return new CategoryResource($category);
    }

    public function update(Category $category,StoreCategoryRequest $request){
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category){
        $category->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }


}
