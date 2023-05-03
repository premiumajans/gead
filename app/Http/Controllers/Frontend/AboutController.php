<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Director;
use App\Models\Forigner;
use App\Models\WhyGefen;

class AboutController extends Controller
{
    public function index(){
        $about = About::first();
        $why = WhyGefen::first();
        return view('frontend.about.index',get_defined_vars());
    }
}
