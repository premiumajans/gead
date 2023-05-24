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
            $video->link = $request->link;
            $video->save();
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
                $video->link = $request->link;
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
}
