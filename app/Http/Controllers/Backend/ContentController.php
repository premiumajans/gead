<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\AltCategory;
use App\Models\Category;
use App\Models\ContentPhotos;
use App\Models\ContentTranslation;
use Exception;
use Illuminate\Http\Request;
use App\Models\Content;

class ContentController extends Controller
{
    public function index()
    {
        check_permission('content index');
        $contents = Content::with('photos')->get();
        return view('backend.content.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('content create');
        $categories = Category::where('status', 1)->get();
        $altCategories = AltCategory::where('category_id', $categories[0]->id)->get();
//        if ($altCategories[0]->sub()->exists()) {
//            $subCategories = $altCategories[0]->sub()->get();
//        }
        return view('backend.content.create', get_defined_vars());
    }

    public function store(Request $request)
    {
//        dd($request->all());
        check_permission('content create');
        try {
            $content = new Content();
            if ($request->hasFile('pdf')) {
                $content->pdf = pdf_upload($request->file('pdf'));
            }
            if ($request->hasFile('photo')) {
                $content->photo = upload('content', $request->file('photo'));
            }
            $content->category_id = $request->category;
            $content->alt_id = $request->altCategory;
            $content->sub_id = $request->subCategory;
            $content->save();
            foreach (active_langs() as $lang) {
                $contentTranslation = new ContentTranslation();
                $contentTranslation->locale = $lang->code;
                $contentTranslation->content_id = $content->id;
                $contentTranslation->name = $request->name[$lang->code];
                $contentTranslation->content = $request->content1[$lang->code];
                $contentTranslation->save();
            }
            if ($request->hasFile('photos')) {
                foreach (multi_upload('content', $request->file('photos')) as $photo) {
                    $contentPhoto = new ContentPhotos();
                    $contentPhoto->photo = $photo;
                    $content->photos()->save($contentPhoto);
                }
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.content.index'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.content.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('content edit');
        $content = Content::where('id', $id)->with('photos')->first();
        return view('backend.content.edit', get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('content edit');

    }

    public function changeCategory(Request $request)
    {
        $newSelect = '';
        $id = $request->category_id;
        $category = Category::where('id', $id)->with('alt.sub')->first();
        if ($category->alt()->exists()) {
            $altCategories = $category->alt()->get();
            $newSelect .= '<select class="form-control" name="altCategory" id="altCategory">';
            foreach ($altCategories as $al) {
                $newSelect .= '<option value="' . $al->id . '">' . $al->translate(app()->getLocale())->name . '</option>';
            }
            $newSelect .= '</select>';
            return $newSelect;
        } else {
            return 'salam';
        }
    }

    public function changeAltCategory(Request $request)
    {
        $newSelect = '';
        $id = $request->alt_id;
        $altCategory = AltCategory::where('id', $id)->with('sub')->first();
        if ($altCategory->sub()->exists()) {
            $subCategories = $altCategory->sub()->get();
            $newSelect .= '<select class="form-control" name="subCategory" id="subCategory">';
            foreach ($subCategories as $al) {
                $newSelect .= '<option value="' . $al->id . '">' . $al->translate(app()->getLocale())->name . '</option>';
            }
            $newSelect .= '</select>';
            return $newSelect;
        }
    }

    public function status(string $id)
    {
        check_permission('content edit');
        return CRUDHelper::status('\App\Models\Content', $id);
    }

    public function delete(string $id)
    {
        check_permission('content delete');
        return CRUDHelper::remove_item('\App\Models\Content', $id);
    }


}
