<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\State;
use Illuminate\Http\Request;

class CheckoutController extends Controller
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
        abort(404);
        // return view('layout.checkout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $states = State::with('city')->get();
        $cart = Cart::with(['items.product', 'user.city', 'user.state'])->findOrFail($id);
        $cartTotal = 0;
        foreach ($cart->items as $item) {
            $cartTotal += $item->product->price * $item->quantity;
        }
        if (authUser()->id != $cart->user_id) {
            abort(403);
        }
        return view('layout.checkout.create', compact('cart', 'cartTotal','states'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
