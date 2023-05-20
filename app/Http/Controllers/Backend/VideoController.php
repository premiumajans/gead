<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\VideoPhotos;
use App\Models\VideoTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        check_permission('video index');
        $videos = Video::all();
        return view('backend.video.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('video create');
        return view('backend.video.create');
    }

    public function store(Request $request)
    {
        check_permission('video create');
        try {
            $video = new Video();
            $video->photo = upload('video', $request->file('photo'));
            $video->save();
            foreach (active_langs() as $lang) {
                $translation = new VideoTranslation();
                $translation->locale = $lang->code;
                $translation->name = $request->name[$lang->code];
                $translation->video_id = $video->id;
                $translation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.video.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.video.index'));
        }
    }

    public function edit($id)
    {
        check_permission('video edit');
        $video = Video::find($id);
        return view('backend.video.edit', get_defined_vars());
    }

    public function update(Request $request, Video $video)
    {
        check_permission('video edit');
        try {
            DB::transaction(function () use ($request, $video) {
                if ($request->hasFile('photo')) {
                    if (file_exists($video->photo)) {
                        unlink(public_path($video->photo));
                    }
                    $video->photo = upload('video', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $video->translate($lang->code)->name = $request->name[$lang->code];
                }
                $video->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.video.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.video.index'));
        }
    }

    public function delete($id)
    {
        check_permission('video delete');
        return CRUDHelper::remove_item('\App\Models\Video', $id);
    }

    public function status($id)
    {
        check_permission('video edit');
        return CRUDHelper::status('\App\Models\Video', $id);
    }

    public function photos($id)
    {
        check_permission('video edit');
        $photos = Video::where('id', $id)->with('photos')->first();
        return view('backend.video.photos', get_defined_vars());
    }

    public function photosStore(Request $request)
    {
        check_permission('video edit');
        $video = Video::where('id',$request->video_id)->with('photos')->first();
        foreach (multi_upload('video', $request->file('photos')) as $photo) {
            $videoPhoto = new VideoPhotos();
            $videoPhoto->photo = $photo;
            $video->photos()->save($videoPhoto);
        }
        return redirect()->back();
    }

    public function photosDelete($id)
    {
        check_permission('video delete');
        return CRUDHelper::remove_item('\App\Models\VideoPhotos', $id);
    }
}
