<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Writer;
use App\Models\WriterTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WriterController extends Controller
{
    public function index()
    {
        check_permission('writer index');
        $writers = Writer::all();
        return view('backend.writer.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('writer create');
        return view('backend.writer.create');
    }

    public function store(Request $request)
    {
        check_permission('writer create');
        try {
            $writer = new Writer();
            $writer->photo = upload('writer', $request->file('photo'));
            $writer->save();
            foreach (active_langs() as $lang) {
                $writerTranslation = new WriterTranslation();
                $writerTranslation->locale = $lang->code;
                $writerTranslation->writer_id = $writer->id;
                $writerTranslation->name = $request->name[$lang->code];
                $writerTranslation->description = $request->description[$lang->code];
                $writerTranslation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.writer.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.writer.index'));
        }
    }

    public function edit(string $id)
    {
        check_permission('writer edit');
        $writer = Writer::find($id);
        return view('backend.writer.edit',get_defined_vars());
    }

    public function update(Request $request, string $id)
    {
        check_permission('writer edit');
        try {
            $writer = Writer::find($id);
            DB::transaction(function () use ($request, $writer) {
                if ($request->hasFile('photo')) {
                    if (file_exists($writer->photo)) {
                        unlink(public_path($writer->photo));
                    }
                    $writer->photo = upload('writer', $request->file('photo'));
                }
                foreach (active_langs() as $lang){
                    $writer->translate($lang->code)->name = $request->name[$lang->code];
                    $writer->translate($lang->code)->description = $request->description[$lang->code];
                }
               $writer->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.writer.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.writer.index'));
        }
    }

    public function status(string $id)
    {
        check_permission('writer edit');
        return CRUDHelper::status('\App\Models\Writer', $id);
    }

    public function delete(string $id)
    {
        check_permission('writer delete');
        return CRUDHelper::remove_item('\App\Models\Writer', $id);
    }
}
