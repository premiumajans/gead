<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('slider index'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sliders = Slider::orderBy('order')->get();
        return view('backend.slider.index', get_defined_vars());
    }

    public function create()
    {
        abort_if(Gate::denies('slider create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('slider create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            if (empty(Slider::first())) {
                $sliderOrder = 1;
            } else {
                $sliderOrder = Slider::all()->last()->order + 1;
            }
            Slider::create([
                'photo' => upload('sliders', $request->file('photo')),
                'alt' => $request->alt,
                'order' => $sliderOrder,
                'status' => 1,
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('slider edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            if ($request->hasFile('photo')) {
                Slider::find($id)->update([
                    'photo' => upload('sliders', $request->file('photo'))
                ]);
            }
            Slider::find($id)->update([
                'alt' => $request->alt
            ]);
            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }

    public function edit(Slider $slider)
    {
        abort_if(Gate::denies('slider edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.slider.edit', get_defined_vars());
    }

    public function delSlider($id)
    {
        abort_if(Gate::denies('slider delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            unlink(Slider::find($id)->photo);
            Slider::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect()->route('backend.slider.index');
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('backend.slider.index');
        }
    }
    public function sliderOrder(Request $request, $id)
    {
        abort_if(Gate::denies('slider edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $slider = Slider::find($id);
            $orders = [];
            foreach (Slider::orderBy('order', 'asc')->get() as $sl) {
                $orders[] = $sl->order;
            }
            if ($request->direction == "up") {
                $prevKey = (array_search($slider->order, $orders)) - 1;
                Slider::where('order', $orders[$prevKey])->update([
                    'order' => $slider->order,
                ]);
                $slider->update(['order' => $orders[$prevKey]]);
            }
            else{
                if ($slider->order == end($orders)) {
                    Slider::where('order', $orders[count($orders) - 2])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[count($orders) - 2]]);
                } elseif ($slider->order == $orders[0]) {
                    Slider::where('order', $orders[1])->update([
                        'order' => $slider->order
                    ]);
                    $slider->update(['order' => $orders[1]]);
                } else {
                    $nextKey = (array_search($slider->order, $orders)) + 1;
                    Slider::where('order', $orders[$nextKey])->update([
                        'order' => $orders[$nextKey - 1],
                    ]);
                    $slider->update(['order' => $orders[$nextKey]]);
                }
            }

            alert()->success(__('messages.success'));
            return redirect(route('backend.slider.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.slider.index'));
        }
    }
    public function sliderStatus($id)
    {
        $status = Slider::where('id', $id)->value('status');
        if ($status == 1) {
            Slider::where('id', $id)->update(['status' => 0]);
        } else {
            Slider::where('id', $id)->update(['status' => 1]);
        }
        return redirect()->route('backend.slider.index');
    }
}
