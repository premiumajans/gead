<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AltCategory;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Content;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    public function index()
    {
        if (Content::where('status', 1)->exists()) {
            return response()->json(Content::where('status', 1)->get());
        } else {
            return response()->json('content-is-empty');
        }
    }

    public function altCat($cat_id, $alt_id)
    {
        if (Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->exists()) {
            return response()->json(Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->get());
        } else {
            return response()->json('content-is-empty');
        }
    }

    public function subAltCat($cat_id, $alt_id, $sub_id)
    {
        if (Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->where('sub_id', $sub_id)->exists()) {
            return response()->json(Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->where('sub_id', $sub_id)->get());
        } else {
            return response()->json('content-is-empty');
        }
    }
}
