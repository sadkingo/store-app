<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
        //
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
    public function store(Request $request)
        {
            // validate
        $rule = [
            'id'            => 'required|numeric|exists:products,id',
            'numberOfUnits' => 'required|numeric|min:0',
        ];
        foreach ($request->input() as $product)
            {
            Validator::validate($product, $rule);
            }
            // check if empty and the user loged in
        if (blank($request->input('0')) && authUser()->id !== null)
            {
            return 'Error';
            }

        // regulate product for sending
        $products = array_map(function ($product)
            {
            $tempProduct['product_id'] = $product['id'];
            $tempProduct['quantity'] = $product['numberOfUnits'];

            return $tempProduct;
            }, $request->input());

        $cart = Cart::create([
            'user_id' => authUser()->id
        ]);

        foreach ($products as $product)
            {
            $cart->items()->create([
                'product_id' => $product['product_id'],
                'quantity'   => $product['quantity'],
            ]);
            }

        return 'cart has ben added:' . $cart->id;
        }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
        {
        //
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
        {
        //
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
        {
        //
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
        {
            // dd($id);
        }
    }
