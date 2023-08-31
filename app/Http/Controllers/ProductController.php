<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
        $products = Product::paginate(12);
        return view('products.index', compact('products'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
        //
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
        {
        //
        }

    /**
     * Display the specified resource.
     */
    public function show($id)
        {
        $product = Product::with('images')->findOrFail($id);
        $randomProducts = Product::with('images')
            ->inRandomOrder()
            ->where('id', '!=', $id)
            ->take(5)
            ->get();
        return view('products.show', compact('product','randomProducts'));
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
        {
        //
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
        {
        //
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
        {
        //
        }
    }
