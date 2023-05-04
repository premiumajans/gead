<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('alt.sub')->get();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::where('id',$id)->with('alt.sub')->get();
        return response()->json($category);
    }
}
