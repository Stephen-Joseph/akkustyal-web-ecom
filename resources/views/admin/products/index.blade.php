@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/catalog.css')
@endpush

@section('content')
  <!-- Header -->
  <div class="page-header-row">
    <div>
      <div style="margin-bottom: 6px;">
        <a href="{{ route('admin.catalog.index') }}" style="font-size: 13px; color: var(--text-muted); text-decoration: none;">&larr; Back to Catalog Overview</a>
      </div>
      <h1 class="page-title">Products</h1>
      <p class="page-subtitle">Manage catalog items, pricing, SKUs, and inventory allocations.</p>
    </div>
    <div>
      <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>New Product</span>
      </a>
    </div>
  </div>

  @if (session('success'))
    <div class="alert-box alert-box-success" role="status">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  <!-- Filter & Search Toolbar -->
  <form method="GET" action="{{ route('admin.products.index') }}" class="filter-bar">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Search by product name or slug..."
      class="filter-input"
    />

    <select name="status" class="filter-select">
      <option value="">All Statuses</option>
      @foreach ($statuses as $status)
        <option value="{{ $status->value }}" @selected(request('status') === $status->value)>
          {{ ucfirst($status->value) }}
        </option>
      @endforeach
    </select>

    <select name="brand_id" class="filter-select">
      <option value="">All Brands</option>
      @foreach ($brands as $brand)
        <option value="{{ $brand->id }}" @selected(request('brand_id') === $brand->id)>
          {{ $brand->name }}
        </option>
      @endforeach
    </select>

    <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
    @if (request()->hasAny(['search', 'status', 'brand_id']))
      <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm" style="color: var(--text-muted);">Reset</a>
    @endif
  </form>

  <!-- Products Data Table -->
  <div class="table-card">
    <div class="table-responsive">
      <table class="data-table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Brand</th>
            <th>Categories</th>
            <th>Type</th>
            <th>Status</th>
            <th>Variants / SKUs</th>
            <th>Price (INR)</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td>
                <a href="{{ route('admin.products.show', $product) }}" class="product-row-title">
                  {{ $product->name }}
                </a>
                <div class="product-row-sub">slug: {{ $product->slug }}</div>
              </td>
              <td>
                @if ($product->brand)
                  <span style="font-weight: 500;">{{ $product->brand->name }}</span>
                @else
                  <span style="color: var(--text-muted);">&mdash;</span>
                @endif
              </td>
              <td>
                @forelse ($product->categories as $category)
                  <span class="badge badge-muted" style="margin-right: 4px;">{{ $category->name }}</span>
                @empty
                  <span style="color: var(--text-muted);">&mdash;</span>
                @endforelse
              </td>
              <td>
                <span class="badge badge-muted">{{ ucfirst($product->product_type?->value ?? 'Simple') }}</span>
              </td>
              <td>
                @php
                  $badgeClass = match ($product->status?->value) {
                    'active' => 'badge-green',
                    'draft' => 'badge-purple',
                    'archived' => 'badge-muted',
                    default => 'badge-muted',
                  };
                @endphp
                <span class="badge {{ $badgeClass }}">{{ ucfirst($product->status?->value ?? 'Draft') }}</span>
              </td>
              <td>
                <span style="font-weight: 600;">{{ $product->variants->count() }}</span>
                <span style="font-size: 11px; color: var(--text-muted);">SKUs</span>
              </td>
              <td>
                @php
                  $firstVariantPrice = $product->variants->first()?->prices->first()?->retail_price;
                @endphp
                @if ($firstVariantPrice)
                  <span style="font-weight: 600;">₹{{ number_format((float) $firstVariantPrice, 2) }}</span>
                @else
                  <span style="color: var(--text-muted); font-size: 12px;">Not set</span>
                @endif
              </td>
              <td style="text-align: right; white-space: nowrap;">
                <div style="display: inline-flex; align-items: center; gap: 8px;">
                  <!-- View Link -->
                  <a href="{{ route('admin.products.show', $product) }}" class="btn btn-secondary btn-sm" title="View details">
                    View
                  </a>

                  <!-- Edit Link -->
                  <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm" title="Edit product">
                    Edit
                  </a>

                  <!-- Delete Form -->
                  <form
                    method="POST"
                    action="{{ route('admin.products.destroy', $product) }}"
                    onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($product->name) }}\'? This will soft-delete the product.');"
                    style="display: inline;"
                  >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" title="Delete product">
                      Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-muted);">
                <p style="margin: 0 0 10px 0; font-size: 15px;">No products found.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">Create the first product</a>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if ($products->hasPages())
      <div style="padding: 16px 20px; border-top: 1px solid var(--border-color);">
        {{ $products->links() }}
      </div>
    @endif
  </div>
@endsection
