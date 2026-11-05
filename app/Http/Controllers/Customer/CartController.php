<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Logic to display the cart items
        return view('pages.cart.index');
    }

    public function store(Request $request)
    {
        // Logic to add an item to the cart
        // Validate and process the request data
        return redirect()->route('pages.cart.index')->with('success', 'Item added to cart.');
    }

    public function destroy($id)
    {
        // Logic to remove an item from the cart
        return redirect()->route('pages.cart.index')->with('success', 'Item removed from cart.');
    }
}
