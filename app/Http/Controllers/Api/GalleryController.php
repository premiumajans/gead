<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        if (Gallery::where('status', 1)->exists()) {
            return response()->json(Gallery::where('status', 1)->with('photos')->get());
        } else {
            return response()->json('gallery-is-empty');
        }
    }

    public function show($id)
    {
        if (Gallery::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(Gallery::where('status', 1)->where('id', $id)->with('photos')->first());
        } else {
            return response()->json('gallery-is-not-founded');
        }
    }
}
