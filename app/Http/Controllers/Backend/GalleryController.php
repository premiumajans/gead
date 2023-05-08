<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Gallery;
use App\Models\GalleryPhotos;
use App\Models\GalleryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Ramsey\Uuid\v1;

class GalleryController extends Controller
{
    public function index()
    {
        check_permission('gallery index');
        $gallerys = Gallery::all();
        return view('backend.gallery.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('gallery create');
        return view('backend.gallery.create');
    }

    public function store(Request $request)
    {
        check_permission('gallery create');
        try {
            $gallery = new Gallery();
            $gallery->photo = upload('gallery', $request->file('photo'));
            $gallery->save();
            foreach (active_langs() as $lang) {
                $translation = new GalleryTranslation();
                $translation->locale = $lang->code;
                $translation->name = $request->name[$lang->code];
                $translation->gallery_id = $gallery->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.gallery.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.gallery.index'));
        }
    }

    public function edit($id)
    {
        check_permission('gallery edit');
        $gallery = Gallery::find($id);
        return view('backend.gallery.edit', get_defined_vars());
    }

    public function update(Request $request, Gallery $gallery)
    {
        check_permission('gallery edit');
        try {
            DB::transaction(function () use ($request, $gallery) {
                if ($request->hasFile('photo')) {
                    if (file_exists($gallery->photo)) {
                        unlink(public_path($gallery->photo));
                    }
                    $gallery->photo = upload('gallery', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $gallery->translate($lang->code)->name = $request->name[$lang->code];
                }
                $gallery->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.gallery.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.gallery.index'));
        }
    }

    public function delete($id)
    {
        check_permission('gallery delete');
        return CRUDHelper::remove_item('\App\Models\Gallery', $id);
    }

    public function status($id)
    {
        check_permission('gallery edit');
        return CRUDHelper::status('\App\Models\Gallery', $id);
    }

    public function photos($id)
    {
        check_permission('gallery edit');
        $photos = Gallery::where('id', $id)->with('photos')->first();
        return view('backend.gallery.photos', get_defined_vars());
    }

    public function photosStore(Request $request)
    {
        check_permission('gallery edit');
        $gallery = Gallery::where('id',$request->gallery_id)->with('photos')->first();
        foreach (multi_upload('gallery', $request->file('photos')) as $photo) {
            $galleryPhoto = new GalleryPhotos();
            $galleryPhoto->photo = $photo;
            $gallery->photos()->save($galleryPhoto);
        }
        return redirect()->back();
    }

    public function photosDelete($id)
    {
        check_permission('gallery delete');
        return CRUDHelper::remove_item('\App\Models\GalleryPhotos', $id);
    }
}
