<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Register;
use Exception;
use Illuminate\Http\Request;

class AppealsController extends Controller
{
    public function index()
    {
        check_permission('content index');
        $appeals = Register::all();
        return view('backend.appeals.index', get_defined_vars());
    }

    public function show($id)
    {
        check_permission('content index');
        $appeal = Register::find($id);
        if ($appeal->read_status == 0) {
            $appeal->update(['read_status' => 1]);
        }
        return view('backend.appeals.show', get_defined_vars());
    }

    public function delete(string $id)
    {
        check_permission('content delete');
        return CRUDHelper::remove_item('\App\Models\Register', $id);
    }
}
