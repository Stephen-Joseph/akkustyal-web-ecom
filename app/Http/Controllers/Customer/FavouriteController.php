<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index()
    {
        // Logic to display the favorite items
        return view('pages.fav.index');
    }

    public function store(Request $request)
    {
        // Logic to add an item to the favorites
        // Validate and process the request data
        return redirect()->route('pages.fav.index')->with('success', 'Item added to favorites.');
    }

    public function destroy($id)
    {
        // Logic to remove an item from the favorites
        return redirect()->route('pages.fav.index')->with('success', 'Item removed from favorites.');
    }
}
