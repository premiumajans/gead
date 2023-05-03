<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', get_defined_vars());
    }

    public function create()
    {
        return view('backend.products.create');
    }

    public function store(ProductRequest $request)
    {
        try {
            $category = Category::find($request->category);
            $product = new Product();
            $product->photo = upload('products', $request->file('photo'));
            $product->status = 1;
            $product->alt = $request->alt;
            $category->product()->save($product);
            foreach (active_langs() as $lang) {
                $productTranslation = new ProductTranslation();
                $productTranslation->product_id = $product->id;
                $productTranslation->locale = $lang->code;
                $productTranslation->name = $request->name[$lang->code];
                $productTranslation->save();
            }
            alert()->success(__('messages.success'));
            return redirect(route('backend.products.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.products.index'));
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('backend.products.edit', get_defined_vars());
    }

    public function update(ProductRequest $request,$id)
    {
        $product = Product::find($id);
        try {
            DB::transaction(function () use ($request, $product) {
                if ($request->hasFile('photo')) {
                    if(file_exists($product->photo)){
                        unlink(public_path($product->photo));
                    }
                    $product->photo = upload('products', $request->file('photo'));
                }
                $product->category_id = $request->category;
                $product->alt = $request->alt;
                foreach (active_langs() as $lang) {
                    $product->translate($lang->code)->name = $request->name[$lang->code];
                }
                $product->save();
            });
            alert()->success(__('messages.success'));
            return redirect(route('backend.products.index'));
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.products.index'));
        }
    }

    public function status($id)
    {
        $status = Product::where('id', $id)->value('status');
        if ($status == 1) {
            Product::where('id', $id)->update(['status' => 0]);
        } else {
            Product::where('id', $id)->update(['status' => 1]);
        }
        alert()->success(__('messages.success'));
        return redirect()->route('backend.products.index', $id);
    }

    public function delete($id)
    {
        try {
            $product = Product::find($id);
            if (file_exists($product->photo)) {
                unlink(public_path($product->photo));
            }
            $product->delete();
            alert()->success(__('messages.success'));
            return redirect(route('backend.products.index'));
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect(route('backend.products.index'));
        }
    }
}
