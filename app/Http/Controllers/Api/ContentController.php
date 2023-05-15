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
            return response()->json(['content' => Content::where('status', 1)->get()]);
        } else {
            return response()->json(['content' => 'content-is-empty']);
        }
    }

    public function show($id)
    {
        if (Content::where('id', $id)->exists()) {
            $content = Content::where('id', $id)->first();
            if ($content->sub_id != (-1 && null)) {
                $related = Content::where('id', '<>', $content->id)
                    ->where('sub_id', $content->sub_id)
                    ->orderBy('created_at', 'desc')
                    ->take(env('RELATED_POST_COUNT'))
                    ->get();
            } else {
                $related = Content::where('id', '<>', $content->id)
                    ->where('alt_id', $content->alt_id)
                    ->orderBy('created_at', 'desc')
                    ->take(env('RELATED_POST_COUNT'))
                    ->get();
            }
            $content->increment('view');
            return response()->json([
                'content' => $content,
                'related' => $related,
            ]);
        } else {
            return response()->json(['content' => 'content-is-empty']);
        }
    }

    public function altCat($cat_id, $alt_id)
    {
        if (Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->exists()) {
            return response()->json(['content' => Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->get()]);
        } else {
            return response()->json(['content' => 'content-is-empty']);
        }
    }

    public function subAltCat($cat_id, $alt_id, $sub_id)
    {
        if (Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->where('sub_id', $sub_id)->exists()) {
            return response()->json(['content' => Content::where('category_id', $cat_id)->where('alt_id', $alt_id)->where('sub_id', $sub_id)->get()]);
        } else {
            return response()->json(['content' => 'content-is-empty']);
        }
    }
}
