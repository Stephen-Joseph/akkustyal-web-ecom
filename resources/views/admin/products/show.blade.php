@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/catalog.css')
@endpush

@section('content')
  <!-- Header with Actions -->
  <div class="page-header-row">
    <div>
      <div style="margin-bottom: 6px;">
        <a href="{{ route('admin.products.index') }}" style="font-size: 13px; color: var(--text-muted); text-decoration: none;">&larr; Back to Products</a>
      </div>
      <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
        <h1 class="page-title">{{ $product->name }}</h1>
        @php
          $badgeClass = match ($product->status?->value) {
            'active' => 'badge-green',
            'draft' => 'badge-purple',
            'archived' => 'badge-muted',
            default => 'badge-muted',
          };
        @endphp
        <span class="badge {{ $badgeClass }}">{{ ucfirst($product->status?->value ?? 'Draft') }}</span>
        <span class="badge badge-muted">{{ ucfirst($product->product_type?->value ?? 'Simple') }}</span>
      </div>
      <p class="page-subtitle">Product ID: <code>{{ $product->id }}</code></p>
    </div>

    <div style="display: flex; align-items: center; gap: 10px;">
      <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        <span>Edit Product</span>
      </a>

      <form
        method="POST"
        action="{{ route('admin.products.destroy', $product) }}"
        onsubmit="return confirm('Are you sure you want to delete this product?');"
      >
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
          <span>Delete</span>
        </button>
      </form>
    </div>
  </div>

  @if (session('success'))
    <div class="alert-box alert-box-success" role="status">
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  <!-- Detail Layout -->
  <div class="detail-layout">
    <!-- Left Main Column -->
    <div>
      <!-- Product Overview Panel -->
      <div class="form-panel">
        <h2 class="form-panel-title">Product Details</h2>
        <p class="form-panel-desc">Core descriptive information and marketing copy.</p>

        <div class="detail-attr-list">
          <div class="detail-attr-row">
            <span class="detail-attr-name">Product Name</span>
            <span class="detail-attr-val">{{ $product->name }}</span>
          </div>

          <div class="detail-attr-row">
            <span class="detail-attr-name">URL Slug</span>
            <span class="detail-attr-val"><code>{{ $product->slug }}</code></span>
          </div>

          <div class="detail-attr-row">
            <span class="detail-attr-name">Brand</span>
            <span class="detail-attr-val">
              @if ($product->brand)
                {{ $product->brand->name }}
              @else
                <span style="color: var(--text-muted);">&mdash;</span>
              @endif
            </span>
          </div>

          <div class="detail-attr-row">
            <span class="detail-attr-name">Short Description</span>
            <span class="detail-attr-val" style="max-width: 60%; text-align: right; font-weight: 400;">
              {{ $product->short_description ?: 'None provided' }}
            </span>
          </div>
        </div>

        @if ($product->description)
          <div style="margin-top: 18px; padding-top: 14px; border-top: 1px solid var(--border-color);">
            <div style="font-size: 12px; font-weight: 600; color: var(--text-muted); margin-bottom: 6px;">Full Description</div>
            <div style="font-size: 13px; color: var(--text-main); line-height: 1.6; white-space: pre-line;">{{ $product->description }}</div>
          </div>
        @endif
      </div>

      <!-- Media Gallery & Asset Management Panel -->
      <div class="form-panel">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; flex-wrap: wrap; gap: 8px;">
          <div>
            <h2 class="form-panel-title">Media & Visual Assets</h2>
            <p class="form-panel-desc" style="margin: 0;">Master DAM imagery, CDN deliveries, roles, and variant bindings.</p>
          </div>
          <span class="badge badge-muted">{{ $product->productImages->count() }} Assets</span>
        </div>

        @if ($product->productImages->isNotEmpty())
          <div class="gallery-grid">
            @foreach ($product->productImages as $pi)
              <div class="image-card {{ $pi->is_primary ? 'is-primary' : '' }}">
                <div class="image-preview-wrapper">
                  <img
                    src="{{ $pi->image->cdn_url }}"
                    alt="{{ $pi->alt_text ?: $product->name }}"
                    class="image-preview-img"
                    loading="lazy"
                    onerror="this.src='https://placehold.co/600x800?text=Image+Unavailable'"
                  />
                  <div class="image-badges-overlay">
                    @if ($pi->is_primary)
                      <span class="badge badge-green" style="box-shadow: 0 1px 3px rgba(0,0,0,0.2);">Primary</span>
                    @endif
                    <span class="badge badge-purple" style="box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                      {{ ucfirst($pi->image_role?->value ?? 'Gallery') }}
                    </span>
                    @if ($pi->variant)
                      <span class="badge badge-muted" style="box-shadow: 0 1px 3px rgba(0,0,0,0.2);">
                        {{ $pi->variant->sku }}
                      </span>
                    @endif
                  </div>
                </div>

                <div class="image-card-body">
                  <div class="image-card-alt" title="{{ $pi->alt_text }}">
                    {{ $pi->alt_text ?: 'No alt description' }}
                  </div>
                  <div class="image-card-meta">
                    <span>
                      @if ($pi->image->width_px && $pi->image->height_px)
                        {{ $pi->image->width_px }}&times;{{ $pi->image->height_px }}px
                      @else
                        {{ strtoupper($pi->image->extension ?: 'IMG') }}
                      @endif
                    </span>
                    <span>
                      @if ($pi->image->file_size_bytes > 0)
                        {{ round($pi->image->file_size_bytes / 1024) }} KB
                      @else
                        CDN Link
                      @endif
                    </span>
                  </div>

                  <div class="image-card-actions">
                    @if (!$pi->is_primary)
                      <form method="POST" action="{{ route('admin.products.images.primary', [$product, $pi]) }}" style="margin: 0; flex: 1;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-secondary" style="width: 100%; padding: 6px 10px; font-size: 11px;">
                          Make Primary
                        </button>
                      </form>
                    @else
                      <span style="font-size: 11px; font-weight: 600; color: var(--badge-green-text); flex: 1; text-align: center;">
                        &check; Primary Hero
                      </span>
                    @endif

                    <form
                      method="POST"
                      action="{{ route('admin.products.images.destroy', [$product, $pi]) }}"
                      onsubmit="return confirm('Remove this image from this product?');"
                      style="margin: 0;"
                    >
                      @csrf
                      @method('DELETE')
                      <button
                        type="submit"
                        class="btn btn-danger"
                        style="padding: 6px 10px; font-size: 11px;"
                        title="Delete image"
                      >
                        <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div style="text-align: center; padding: 28px; background-color: var(--bg-canvas); border-radius: 12px; margin-bottom: 20px;">
            <svg viewBox="0 0 24 24" width="36" height="36" fill="none" stroke="var(--text-muted)" stroke-width="1.5" style="margin-bottom: 8px;">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
              <circle cx="8.5" cy="8.5" r="1.5"/>
              <polyline points="21 15 16 10 5 21"/>
            </svg>
            <p style="font-size: 13px; color: var(--text-muted); margin: 0;">No visual assets attached to this product yet.</p>
          </div>
        @endif

        <!-- Add Image Uploader / Link Form -->
        <div class="uploader-panel">
          <h3 style="font-size: 14px; font-weight: 700; margin: 0 0 6px 0; color: var(--text-main);">Add Media Asset</h3>
          <p style="font-size: 12px; color: var(--text-muted); margin: 0 0 14px 0;">Upload a local file or link an external CDN URL (Cloudinary, AWS S3, Unsplash).</p>

          <form
            method="POST"
            action="{{ route('admin.products.images.store', $product) }}"
            enctype="multipart/form-data"
          >
            @csrf

            <div class="form-grid-2">
              <div class="form-group">
                <label for="image_file" class="form-label">Upload File (WebP, PNG, JPG &lt; 10MB)</label>
                <input
                  type="file"
                  id="image_file"
                  name="image_file"
                  accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml,image/avif"
                  class="form-input-text"
                  style="padding: 7px 12px;"
                />
              </div>

              <div class="form-group">
                <label for="image_url" class="form-label">OR External Image URL / CDN Link</label>
                <input
                  type="url"
                  id="image_url"
                  name="image_url"
                  placeholder="https://images.unsplash.com/... or https://cdn.example.com/..."
                  class="form-input-text"
                />
              </div>
            </div>

            <div class="form-grid-2" style="margin-top: 10px;">
              <div class="form-group">
                <label for="image_role" class="form-label">Image Role *</label>
                <select id="image_role" name="image_role" class="form-select-field" required>
                  @foreach ($imageRoles as $role)
                    <option value="{{ $role->value }}" @selected($role->value === 'gallery')>
                      {{ ucfirst($role->value) }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="variant_id" class="form-label">Assign to Variant (Optional)</label>
                <select id="variant_id" name="variant_id" class="form-select-field">
                  <option value="">-- Base Product (All Variants) --</option>
                  @foreach ($product->variants as $variant)
                    <option value="{{ $variant->id }}">
                      {{ $variant->sku }} &mdash; {{ $variant->name ?: 'Standard' }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-grid-2" style="margin-top: 10px;">
              <div class="form-group">
                <label for="alt_text" class="form-label">Alt Text (Accessibility & SEO)</label>
                <input
                  type="text"
                  id="alt_text"
                  name="alt_text"
                  placeholder="e.g. Front view of classic cotton kurta"
                  class="form-input-text"
                />
              </div>

              <div class="form-group" style="display: flex; align-items: flex-end; padding-bottom: 8px;">
                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 500; cursor: pointer;">
                  <input
                    type="checkbox"
                    name="is_primary"
                    value="1"
                    @checked($product->productImages->where('is_primary', true)->isEmpty())
                  />
                  <span>Mark as Primary Hero Image</span>
                </label>
              </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 14px;">
              <button type="submit" class="btn btn-primary" style="padding: 9px 20px; font-size: 13px;">
                <svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                <span>Upload & Attach Asset</span>
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Variants / SKUs Table Panel -->
      <div class="form-panel">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
          <div>
            <h2 class="form-panel-title">Physical Variants & SKUs</h2>
            <p class="form-panel-desc" style="margin: 0;">Purchasable variants, dimensions, pricing, and stock.</p>
          </div>
          <span class="badge badge-muted">{{ $product->variants->count() }} Variants</span>
        </div>

        <div class="table-responsive">
          <table class="data-table">
            <thead>
              <tr>
                <th>SKU</th>
                <th>Options / Name</th>
                <th>MRP (INR)</th>
                <th>Retail Price</th>
                <th>Stock / Warehouse</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($product->variants as $variant)
                @php
                  $price = $variant->prices->first();
                @endphp
                <tr>
                  <td><code>{{ $variant->sku }}</code></td>
                  <td>
                    <strong>{{ $variant->name ?: 'Standard' }}</strong>
                    @if (!empty($variant->variant_options))
                      <div style="font-size: 11px; color: var(--text-muted);">
                        @foreach ($variant->variant_options as $k => $v)
                          <span style="margin-right: 6px;">{{ ucfirst($k) }}: <strong>{{ is_array($v) ? implode(', ', $v) : $v }}</strong></span>
                        @endforeach
                      </div>
                    @endif
                  </td>
                  <td>
                    @if ($price && $price->msrp_price)
                      ₹{{ number_format((float) $price->msrp_price, 2) }}
                    @else
                      &mdash;
                    @endif
                  </td>
                  <td>
                    @if ($price && $price->retail_price)
                      <strong style="color: var(--primary);">₹{{ number_format((float) $price->retail_price, 2) }}</strong>
                    @else
                      &mdash;
                    @endif
                  </td>
                  <td>
                    @php
                      $totalOnHand = $variant->inventoryLevels->sum('quantity_on_hand');
                      $totalReserved = $variant->inventoryLevels->sum('quantity_reserved');
                      $totalAvailable = $totalOnHand - $totalReserved;
                    @endphp
                    <div>
                      <strong>{{ $totalAvailable }}</strong>
                      <span style="font-size: 11px; color: var(--text-muted);">avail</span>
                    </div>
                    @if ($variant->inventoryLevels->isNotEmpty())
                      <div style="font-size: 10px; color: var(--text-muted);">
                        @foreach ($variant->inventoryLevels as $level)
                          <span>{{ $level->warehouse?->code }}: {{ $level->quantity_on_hand }}</span>@if (!$loop->last), @endif
                        @endforeach
                      </div>
                    @endif
                  </td>
                  <td>
                    @if ($variant->is_active)
                      <span class="badge badge-green">Active</span>
                    @else
                      <span class="badge badge-muted">Inactive</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 24px;">
                    No variants created for this product yet.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Base Attributes Panel -->
      <div class="form-panel">
        <h2 class="form-panel-title">Base Attributes & Specifications</h2>
        <p class="form-panel-desc">Structured JSONB facets used for faceted search and filtering.</p>

        @if (!empty($product->base_attributes))
          <div class="detail-attr-list">
            @foreach ($product->base_attributes as $key => $val)
              <div class="detail-attr-row">
                <span class="detail-attr-name">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                <span class="detail-attr-val">
                  @if (is_array($val))
                    {{ implode(', ', $val) }}
                  @elseif (is_bool($val))
                    {{ $val ? 'Yes' : 'No' }}
                  @else
                    {{ $val }}
                  @endif
                </span>
              </div>
            @endforeach
          </div>
        @else
          <p style="font-size: 13px; color: var(--text-muted); margin: 0;">No dynamic base attributes recorded.</p>
        @endif
      </div>
    </div>

    <!-- Right Sidebar Column -->
    <div>
      <!-- Publishing & Status Card -->
      <div class="form-panel">
        <h3 class="form-panel-title">Publishing Status</h3>
        <p class="form-panel-desc">Visibility and scheduling settings.</p>

        <div class="detail-attr-list">
          <div class="detail-attr-row">
            <span class="detail-attr-name">Status</span>
            <span class="detail-attr-val">{{ ucfirst($product->status?->value ?? 'Draft') }}</span>
          </div>

          <div class="detail-attr-row">
            <span class="detail-attr-name">Published At</span>
            <span class="detail-attr-val">
              {{ $product->published_at ? $product->published_at->format('M d, Y H:i') : 'Draft / Unpublished' }}
            </span>
          </div>

          <div class="detail-attr-row">
            <span class="detail-attr-name">Created</span>
            <span class="detail-attr-val">{{ $product->created_at->format('M d, Y') }}</span>
          </div>

          <div class="detail-attr-row">
            <span class="detail-attr-name">Last Updated</span>
            <span class="detail-attr-val">{{ $product->updated_at->format('M d, Y H:i') }}</span>
          </div>
        </div>
      </div>

      <!-- Categories Card -->
      <div class="form-panel">
        <h3 class="form-panel-title">Category Associations</h3>
        <p class="form-panel-desc">Assigned catalog categories.</p>

        @if ($product->categories->isNotEmpty())
          <div style="display: flex; flex-direction: column; gap: 8px;">
            @foreach ($product->categories as $category)
              <div style="display: flex; justify-content: space-between; align-items: center; padding: 6px 0; border-bottom: 1px solid var(--border-color);">
                <span style="font-size: 13px; font-weight: 500;">{{ $category->name }}</span>
                @if ($category->pivot->is_primary)
                  <span class="badge badge-purple">Primary</span>
                @endif
              </div>
            @endforeach
          </div>
        @else
          <p style="font-size: 13px; color: var(--text-muted); margin: 0;">No categories assigned.</p>
        @endif
      </div>

      <!-- SEO Metadata Card -->
      <div class="form-panel">
        <h3 class="form-panel-title">SEO & Metadata</h3>
        <p class="form-panel-desc">Search engine indexing tags.</p>

        <div class="detail-attr-list">
          <div class="detail-attr-row">
            <span class="detail-attr-name">Title</span>
            <span class="detail-attr-val" style="font-weight: 400;">
              {{ $product->seo_metadata['title'] ?? $product->name }}
            </span>
          </div>

          <div class="detail-attr-row">
            <span class="detail-attr-name">Description</span>
            <span class="detail-attr-val" style="font-weight: 400; font-size: 12px;">
              {{ $product->seo_metadata['description'] ?? 'Default store description' }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
