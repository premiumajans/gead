<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::where('status', 1)->get();
        return response()->json($settings);
    }

    public function show($name)
    {
        $setting = Setting::where('name', $name)->where('status', 1)->first();
        return response()->json($setting);
    }
}
