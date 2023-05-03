<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\WhyGefen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $why = WhyGefen::first();
        return view('backend.about.index', get_defined_vars());
    }

    public function update(Request $request, About $about)
    {
        try {
            DB::transaction(function () use ($request, $about) {
                foreach (active_langs() as $lang) {
                    $about->translate($lang->code)->description = $request->description[$lang->code];
                }
                $about->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.about.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.about.index'));
        }
    }

    public function whyGefen(Request $request, $id)
    {
        try {
            $why = WhyGefen::find($id);
            DB::transaction(function () use ($request, $why) {
                if ($request->hasFile('photo1')) {
                    if (file_exists($why->photo_1)) {
                        unlink($why->photo_1);
                    }
                    $why->photo_1 = upload('why', $request->file('photo1'));
                }
                if ($request->hasFile('photo2')) {
                    if (file_exists($why->photo_2)) {
                        unlink($why->photo_2);
                    }
                    $why->photo_2 = upload('why', $request->file('photo2'));
                }
                if ($request->hasFile('photo3')) {
                    if (file_exists($why->photo_3)) {
                        unlink($why->photo_3);
                    }
                    $why->photo_3 = upload('why', $request->file('photo3'));
                }
                foreach (active_langs() as $lang) {
                    $why->translate($lang->code)->description = $request->description[$lang->code];
                }
                $why->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.about.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.about.index'));
        }
    }
}
