<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('backend.order.index', get_defined_vars());
    }

    public function read($id)
    {
        $order = Order::find($id);
        return view('backend.order.read', get_defined_vars());
    }

    public function delete($id)
    {
        try {
            Order::find($id)->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.orders'));
        } catch (Exception $e) {
            alert()->error(__('backend.error'));
            return redirect(route('backend.orders'));
        }
    }
}
