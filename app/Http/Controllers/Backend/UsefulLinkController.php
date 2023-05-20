<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\UseFulLink;
use Exception;
use Illuminate\Http\Request;

class UsefulLinkController extends Controller
{
    public function index()
    {
        check_permission('UseFulLink index');
        $links = UseFulLink::all();
        return view('backend.useful-links.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('UseFulLink create');
        return view('backend.useful-links.create');
    }

    public function edit($id)
    {
        check_permission('UseFulLink edit');
        $link = UseFulLink::find($id);
        return view('backend.useful-links.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        check_permission('UseFulLink edit');
        try {
            $link = UseFulLink::find($id);
            if ($request->hasFile('photo')) {
                if (file_exists($link->photo)) {
                    unlink(public_path($link->photo));
                }
                $link->photo = upload('UseFulLink', $request->file('photo'));
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
        check_permission('UseFulLink create');
        try {
            $link = new UseFulLink();
            $link->photo = upload('UseFulLink', $request->file('photo'));
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
        check_permission('UseFulLink delete');
        return CRUDHelper::remove_item('\App\Models\UseFulLink', $id);
    }

    public function status($id)
    {
        check_permission('UseFulLink edit');
        return CRUDHelper::status('\App\Models\UseFulLink', $id);
    }
}
