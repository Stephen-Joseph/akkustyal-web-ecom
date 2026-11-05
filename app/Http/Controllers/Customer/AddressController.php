<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AddressController extends Controller
{
    public function index(): View
    {
        $addresses = Auth::guard('customer')->user()
            ->addresses()
            ->orderByDesc('is_default')
            ->get();

        return view('pages.account.addresses', compact('addresses'));
    }

    public function store(StoreAddressRequest $request): RedirectResponse
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        if ($request->boolean('is_default')) {
            $customer->addresses()
                ->where('address_type', $request->address_type)
                ->update(['is_default' => false]);
        }

        $customer->addresses()->create($request->validated());

        return redirect()->route('customer.addresses.index')
            ->with('success', 'Address saved.');
    }

    public function destroy(Address $address): RedirectResponse
    {
        /** @var Customer $customer */
        $customer = Auth::guard('customer')->user();

        abort_if($address->customer_id !== $customer->id, 403);

        $address->delete();

        return redirect()->route('customer.addresses.index')
            ->with('success', 'Address removed.');
    }
}
