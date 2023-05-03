<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UsefulLink;
use Illuminate\Http\Request;

class UsefulLinkController extends Controller
{
    public function index()
    {
        check_permission('usefulLink index');
        $links = UsefulLink::all();
        return view('backend.useful-links.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('usefulLink create');
        return view('backend.useful-links.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
        check_permission('usefulLink create');
        try {
            $link = new UsefulLink();
            $link->photo = upload('usefulLink', $request->file('photo'));
            $link->link = $request->link;
            $link->status = 1;
            $link->save();
            alert()->success(__('messages.add-success'));
            return redirect()->route('backend.useful-links.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.useful-links.index');
        }
    }
}
