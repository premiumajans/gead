<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Http\Requests\Backend\ServiceRequest;
use App\Models\Backend\Service;
use App\Models\Backend\ServiceTranslation;
use App\Models\ServiceComponent;
use App\Models\ServiceComponentTranslation;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;


class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('backend.services.index', get_defined_vars());
    }

    public function create()
    {
        return view('backend.services.create');
    }

    public function store(ServiceRequest $request)
    {
        try {
            $service = new Service();
            $service->photo = upload('services', $request->file('photo'));
            $service->alt = $request->alt;
            $service->status = 1;
            $service->save();
            foreach (active_langs() as $lang) {
                $serviceTranslation = new ServiceTranslation();
                $serviceTranslation->service_id = $service->id;
                $serviceTranslation->locale = $lang->code;
                $serviceTranslation->name = $request->name[$lang->code];
                $serviceTranslation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.services.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.services.index'));
        }
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('backend.services.edit', get_defined_vars());
    }

    public function update(ServiceRequest $request, $id)
    {
        $service = Service::find($id);
        try {
            DB::transaction(function () use ($request, $service) {
                if ($request->hasFile('photo')) {
                    if (file_exists($service->photo)) {
                        unlink(public_path($service->photo));
                    }
                    $service->photo = upload('services', $request->file('photo'));
                }
                $service->alt = $request->alt;
                foreach (active_langs() as $lang) {
                    $service->translate($lang->code)->name = $request->name[$lang->code];
                }
                $service->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.services.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.services.index'));
        }
    }

    public function status($id)
    {
        $status = Service::where('id', $id)->value('status');
        if ($status == 1) {
            Service::where('id', $id)->update(['status' => 0]);
        } else {
            Service::where('id', $id)->update(['status' => 1]);
        }
        alert()->success(__('messages.success'));
        return redirect()->route('backend.services.index', $id);
    }

    public function component($id)
    {
        $components = Service::find($id)->component()->get();
        return view('backend.services.component.index', get_defined_vars());
    }

    public function componentCreate($id)
    {
        return view('backend.services.component.create', get_defined_vars());

    }

    public function storeComponent(Request $request, $id)
    {
        try {
            $service = Service::find($id);
            $serviceC = new ServiceComponent();
            $serviceC->photo = upload('services', $request->file('photo'));
            $service->component()->save($serviceC);
            foreach (active_langs() as $lang) {
                $tr = new ServiceComponentTranslation();
                $tr->locale = $lang->code;
                $tr->service_component_id = $serviceC->id;
                $tr->name = $request->name[$lang->code];
                $tr->save();
            }
            alert()->success(__('messages.success'));
            return redirect()->route('backend.serviceComponent', $id);
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.serviceComponent', $id);
        }
    }

    public function componentEdit($id)
    {
        $serviceComponent = ServiceComponent::find($id);
        return view('backend.services.component.edit', get_defined_vars());
    }

    public function updateComponent(Request $request, $id)
    {
        $component = ServiceComponent::find($id);
        try {
            DB::transaction(function () use ($request, $component) {
                if ($request->hasFile('photo')) {
                    if (file_exists($component->photo)) {
                        unlink(public_path($component->photo));
                    }
                    $component->photo = upload('services', $request->file('photo'));
                }
                foreach (active_langs() as $lang) {
                    $component->translate($lang->code)->name = $request->name[$lang->code];
                }
                $component->save();
            });
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function componentDelete($id)
    {
        try {
            $component = ServiceComponent::find($id);
            if (file_exists($component->photo)) {
                unlink(public_path($component->photo));
            }
            $component->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.services.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.services.index'));
        }
    }

    public function delete($id)
    {
        try {
            $service = Service::find($id);
            if (file_exists($service->photo)) {
                unlink(public_path($service->photo));
            }
            $service->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.services.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.services.index'));
        }
    }
}
