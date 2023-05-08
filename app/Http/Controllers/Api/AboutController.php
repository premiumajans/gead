<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return response()->json(About::where('status', 1)->get());
    }

    public function show($id)
    {
        return response()->json(About::find($id));
    }
}
