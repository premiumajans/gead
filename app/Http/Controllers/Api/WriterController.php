<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index()
    {
        if (Writer::where('status', 1)->exists()) {
            return response()->json(['writers' => Writer::where('status', 1)->get()]);
        } else {
            return response()->json(['writers' => 'writers-is-empty']);
        }
    }

    public function show($id)
    {
        if (Writer::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['writers' => Writer::where('status', 1)->where('id', $id)->first()]);
        } else {
            return response()->json(['writers' => 'writer-is-not-founded']);
        }
    }
}
