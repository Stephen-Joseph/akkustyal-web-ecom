<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Resolve or create the active cart for the authenticated customer.
     */
    private function resolveCart(): Cart
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        return Cart::firstOrCreate(['customer_id' => $customer->id]);
    }

    public function index(): View
    {
        $cart = $this->resolveCart();
        $cart->load('items.variant.product');

        return view('pages.cart.index', compact('cart'));
    }

    public function store(StoreCartItemRequest $request): RedirectResponse
    {
        $cart = $this->resolveCart();
        $variant = ProductVariant::findOrFail($request->variant_id);

        abort_if($variant->stock_quantity < $request->quantity, 422);

        /** @var CartItem $item */
        $item = $cart->items()->firstOrNew(['variant_id' => $variant->id]);
        $item->quantity = ($item->quantity ?? 0) + $request->quantity;
        $item->save();

        return redirect()->route('pages.cart.index')
            ->with('success', 'Item added to cart.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $cart = $this->resolveCart();

        $cart->items()->where('id', $id)->delete();

        return redirect()->route('pages.cart.index')
            ->with('success', 'Item removed from cart.');
    }
}
