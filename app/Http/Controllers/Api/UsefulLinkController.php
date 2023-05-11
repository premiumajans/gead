<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UseFulLink;
use Illuminate\Http\Request;

class UseFullinkController extends Controller
{
    public function index()
    {
        $links = UseFulLink::where('status', 1)->get();
        return response()->json($links);
    }

    public function show($id)
    {
        $category = UseFulLink::where('id', $id)->where('status', 1)->get();
        return response()->json($category);
    }
}
