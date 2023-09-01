<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OrderItem;

class OrderController extends Controller
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
    public function store(StoreOrderRequest $request, $id)
    {

        $requestValidated = $request->validated();
        // split the state city
        $stateCityArray = explode('-', $requestValidated['city']);
        $requestValidated['state_id'] = $stateCityArray[0];
        $requestValidated['city_id'] = $stateCityArray[1];

        // grab the cart by the checkout id
        $cart = Cart::with(['items.product', 'user'])->findOrFail($id);
        // check if the user is the owner of the cart
        if (authUser()->id != $cart->user_id) {
            abort(403);
        }

        // calc cart total
        $cartTotal = 0;
        foreach ($cart->items as $item) {
            $cartTotal += $item->product->price * $item->quantity;
        }

        // creating order
        $order =  Order::create([
            'user_id' => $cart->user->id,
            'total_amount' => $cartTotal,
            'address' => $requestValidated['address'],
            'city_id' => $requestValidated['city_id'],
            'phone' => $requestValidated['phone'],
        ]);
        foreach ($cart->items as $item) {
            $order->items()->create($item->toArray());
        }

        $cart->delete();
        return to_route('filament.dashboard.resources.orders.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
