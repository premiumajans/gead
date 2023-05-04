<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class UsefulLinkController extends Controller
{
    public function index()
    {
        $categories = UsefulLink::where('status', 1)->get();
        return response()->json($categories);
    }

    public function show($id)
    {
        $category = UsefulLink::where('id', $id)->where('status', 1)->get();
        return response()->json($category);
    }
}
