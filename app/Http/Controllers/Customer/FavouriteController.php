<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavouriteController extends Controller
{
    public function index(): View
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        $wishlist = $customer->wishlist()
            ->with('product.images', 'product.variants')
            ->latest()
            ->get();

        return view('pages.fav.fav', compact('wishlist'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        Wishlist::firstOrCreate([
            'customer_id' => $customer->id,
            'product_id' => $request->product_id,
        ]);

        return back()->with('success', 'Added to wishlist.');
    }

    public function destroy(int $id): RedirectResponse
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        $customer->wishlist()->where('id', $id)->delete();

        return back()->with('success', 'Removed from wishlist.');
    }
}
