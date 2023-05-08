<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use function Ramsey\Uuid\v1;

class GalleryController extends Controller
{
    public function index()
    {
        check_permission('gallery index');
        $gallery = Gallery::all();
        return view('backend.gallery.index', get_defined_vars());
    }
}
