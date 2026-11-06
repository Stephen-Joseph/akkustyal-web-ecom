@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/catalog.css')
@endpush

@section('content')
  <!-- Page Header -->
  <div class="page-header-row">
    <div>
      <h1 class="page-title">Products & Categories</h1>
      <p class="page-subtitle">Manage catalog items, category hierarchies, brand partners, and stock levels.</p>
    </div>
    <div>
      <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        <span>Add Product</span>
      </a>
    </div>
  </div>

  @if (session('success'))
    <div class="alert-box alert-box-success" role="status">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  <!-- Quick Metrics -->
  <div class="hub-stats-bar">
    <div class="hub-stat-item">
      <div class="hub-stat-number">{{ number_format($stats['products_count']) }}</div>
      <div class="hub-stat-label">Products</div>
    </div>
    <div class="hub-stat-item">
      <div class="hub-stat-number">{{ number_format($stats['variants_count']) }}</div>
      <div class="hub-stat-label">Product SKUs</div>
    </div>
    <div class="hub-stat-item">
      <div class="hub-stat-number">{{ number_format($stats['categories_count']) }}</div>
      <div class="hub-stat-label">Categories</div>
    </div>
    <div class="hub-stat-item">
      <div class="hub-stat-number">{{ number_format($stats['brands_count']) }}</div>
      <div class="hub-stat-label">Brands</div>
    </div>
  </div>

  <!-- SECTION 1: Catalog & Products -->
  <section class="hub-section">
    <h2 class="hub-section-title">Catalog Management</h2>
    <p class="hub-section-desc">Manage your products, variant configurations, and brand registries.</p>

    <div class="hub-grid">
      <!-- Products Card -->
      <a href="{{ route('admin.products.index') }}" class="hub-card">
        <div>
          <div class="hub-card-header">
            <div class="hub-card-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <span class="badge badge-green">Available</span>
          </div>
          <h3 class="hub-card-title">Products</h3>
          <p class="hub-card-text">View catalog products, edit details, manage variants, and delete obsolete entries.</p>
        </div>
        <div class="hub-card-footer">
          <span style="font-size: 12px; font-weight: 600; color: var(--primary);">Manage Products &rarr;</span>
          <span style="font-size: 12px; color: var(--text-muted);">{{ $stats['products_count'] }} items</span>
        </div>
      </a>

      <!-- Categories Card -->
      <div class="hub-card" style="cursor: default;">
        <div>
          <div class="hub-card-header">
            <div class="hub-card-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h7v7H3z"/><path d="M14 3h7v7h-7z"/><path d="M14 14h7v7h-7z"/><path d="M3 14h7v7H3z"/></svg>
            </div>
            <span class="badge badge-purple">API Ready</span>
          </div>
          <h3 class="hub-card-title">Categories</h3>
          <p class="hub-card-text">Hierarchical tree structure with PostgreSQL ltree materialized paths for rapid sub-tree searches.</p>
        </div>
        <div class="hub-card-footer">
          <span style="font-size: 12px; color: var(--text-muted);">REST API /api/v1/categories</span>
          <span style="font-size: 12px; color: var(--text-muted);">{{ $stats['categories_count'] }} categories</span>
        </div>
      </div>

      <!-- Brands Card -->
      <div class="hub-card" style="cursor: default;">
        <div>
          <div class="hub-card-header">
            <div class="hub-card-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
            </div>
            <span class="badge badge-purple">API Ready</span>
          </div>
          <h3 class="hub-card-title">Brands</h3>
          <p class="hub-card-text">Designer and brand registries including Fabindia, Manyavar, W for Woman, and Biba.</p>
        </div>
        <div class="hub-card-footer">
          <span style="font-size: 12px; color: var(--text-muted);">REST API /api/v1/brands</span>
          <span style="font-size: 12px; color: var(--text-muted);">{{ $stats['brands_count'] }} brands</span>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 2: Operations & Inventory -->
  <section class="hub-section">
    <h2 class="hub-section-title">Inventory & Merchandising</h2>
    <p class="hub-section-desc">Warehouse allocations, stock reservations, pricing tiers, and attributes.</p>

    <div class="hub-grid">
      <!-- Multi-Warehouse Stock -->
      <div class="hub-card" style="cursor: default;">
        <div>
          <div class="hub-card-header">
            <div class="hub-card-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
            </div>
            <span class="badge badge-purple">API Ready</span>
          </div>
          <h3 class="hub-card-title">Warehouse Inventory</h3>
          <p class="hub-card-text">Multi-warehouse stock tracking across Mumbai, Delhi, and Bangalore with generated availability columns.</p>
        </div>
        <div class="hub-card-footer">
          <span style="font-size: 12px; color: var(--text-muted);">REST API /api/v1/inventory</span>
          <span style="font-size: 12px; color: var(--badge-green-text);">Realtime DB</span>
        </div>
      </div>

      <!-- Attributes & Specs -->
      <div class="hub-card" style="cursor: default;">
        <div>
          <div class="hub-card-header">
            <div class="hub-card-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            </div>
            <span class="badge badge-purple">API Ready</span>
          </div>
          <h3 class="hub-card-title">Dynamic Attributes</h3>
          <p class="hub-card-text">JSONB indexed facets with GIN for fabrics, occasions, sizes, colors, and sleeve lengths.</p>
        </div>
        <div class="hub-card-footer">
          <span style="font-size: 12px; color: var(--text-muted);">attribute_definitions</span>
          <span style="font-size: 12px; color: var(--text-muted);">GIN Indexed</span>
        </div>
      </div>

      <!-- Pricing & Sales -->
      <div class="hub-card" style="cursor: default;">
        <div>
          <div class="hub-card-header">
            <div class="hub-card-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <span class="badge badge-purple">API Ready</span>
          </div>
          <h3 class="hub-card-title">Pricing & GST Rules</h3>
          <p class="hub-card-text">Multi-currency (INR), GST-inclusive rates, time-windowed sale promotions, and B2B tiered wholesale pricing.</p>
        </div>
        <div class="hub-card-footer">
          <span style="font-size: 12px; color: var(--text-muted);">variant_prices table</span>
          <span style="font-size: 12px; color: var(--badge-green-text);">Auto Computed View</span>
        </div>
      </div>
    </div>
  </section>
@endsection
