<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTranslationRequest;
use App\Models\ProductTranslation;

class ProductTranslationController extends Controller
{
    public function index()
    {
        return ProductTranslation::all();
    }

    public function store(ProductTranslationRequest $request)
    {
        return ProductTranslation::create($request->validated());
    }

    public function show(ProductTranslation $productTranslation)
    {
        return $productTranslation;
    }

    public function update(ProductTranslationRequest $request, ProductTranslation $productTranslation)
    {
        $productTranslation->update($request->validated());

        return $productTranslation;
    }

    public function destroy(ProductTranslation $productTranslation)
    {
        $productTranslation->delete();

        return response()->json();
    }
}
