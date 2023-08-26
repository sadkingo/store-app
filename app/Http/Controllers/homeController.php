<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()
        ->limit(6)
        ->get();
        $newProducts = Product::latest()
        ->limit(4)
        ->get();

        // todo
        // select fetured products
        $featuredProducts = $products->take(3);
        // todo get the best product
        $homeProduct = $newProducts->first();
        return view('home' , compact('products','newProducts','featuredProducts'  ,'homeProduct'));
    }
}
