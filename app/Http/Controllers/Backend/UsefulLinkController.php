<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\UsefulLink;
use Exception;
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

    public function edit($id)
    {
        check_permission('usefulLink edit');
        $link = UsefulLink::find($id);
        return view('backend.useful-links.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        check_permission('usefulLink edit');
        try {
            $link = UsefulLink::find($id);
            if ($request->hasFile('photo')) {
                if (file_exists($link->photo)) {
                    unlink(public_path($link->photo));
                }
                $link->photo = upload('usefulLink', $request->file('photo'));
            }
            $link->link = $request->link;
            $link->save();
            alert()->success(__('messages.add-success'));
            return redirect()->route('backend.useful-links.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.useful-links.index');
        }
    }

    public function store(Request $request)
    {
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

    public function delete($id)
    {
        check_permission('usefulLink delete');
        return CRUDHelper::remove_item('\App\Models\UsefulLink', $id);
    }

    public function status($id)
    {
        check_permission('usefulLink edit');
        return CRUDHelper::status('\App\Models\UsefulLink', $id);
    }
}
