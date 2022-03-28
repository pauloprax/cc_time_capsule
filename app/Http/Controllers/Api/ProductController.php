<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::with('category')->paginate(10));
        //return ProductResource::collection(Product::with('category')->get());
        //return ProductResource::collection(Product::all());
    }
}
