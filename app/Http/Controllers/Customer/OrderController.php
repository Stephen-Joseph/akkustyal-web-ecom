<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Auth::guard('customer')->user()
            ->orders()
            ->with(['items.variant.product', 'payment'])
            ->latest()
            ->paginate(10);

        return view('pages.account.orders', compact('orders'));
    }

    public function show(Order $order): View
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        abort_if($order->customer_id !== $customer->id, 403);

        $order->load(['items.variant.product', 'shippingAddress', 'billingAddress', 'payment']);

        return view('pages.account.order-detail', compact('order'));
    }

    public function store(StoreOrderRequest $request): RedirectResponse
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        /** @var Cart|null $cart */
        $cart = Cart::where('customer_id', $customer->id)
            ->with('items.variant')
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('pages.cart.index')
                ->with('error', 'Your cart is empty.');
        }

        /** @var Order $order */
        $order = DB::transaction(function () use ($customer, $cart, $request): Order {
            $total = $cart->items->sum(fn ($item) => $item->variant->price * $item->quantity);

            $order = Order::create([
                'customer_id' => $customer->id,
                'status' => 'pending',
                'total_amount' => $total,
                'shipping_address_id' => $request->shipping_address_id,
                'billing_address_id' => $request->billing_address_id,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'price_at_purchase' => $item->variant->price,
                ]);

                $item->variant->decrement('stock_quantity', $item->quantity);
            }

            $cart->items()->delete();

            return $order;
        });

        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'Order placed successfully!');
    }
}
