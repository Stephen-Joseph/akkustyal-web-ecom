@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/catalog.css')
@endpush

@section('content')
  <!-- Header -->
  <div class="page-header-row">
    <div>
      <div style="margin-bottom: 6px;">
        <a href="{{ route('admin.products.show', $product) }}" style="font-size: 13px; color: var(--text-muted); text-decoration: none;">&larr; Back to Product Details</a>
      </div>
      <h1 class="page-title">Edit Product: {{ $product->name }}</h1>
      <p class="page-subtitle">Update base marketing information, categories, and attributes.</p>
    </div>
  </div>

  @if (isset($errors) && $errors->any())
    <div class="alert-box alert-box-error" role="alert">
      <div>
        <strong>Please correct the following errors:</strong>
        <ul style="margin: 6px 0 0 16px; padding: 0;">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- General Info Panel -->
    <div class="form-panel">
      <h2 class="form-panel-title">General Information</h2>
      <p class="form-panel-desc">Core product identification and marketing copy.</p>

      <div class="form-grid-2">
        <div class="form-group">
          <label for="name" class="form-label">Product Name *</label>
          <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $product->name) }}"
            required
            class="form-input-text"
          />
        </div>

        <div class="form-group">
          <label for="slug" class="form-label">URL Slug *</label>
          <input
            type="text"
            id="slug"
            name="slug"
            value="{{ old('slug', $product->slug) }}"
            required
            class="form-input-text"
          />
          <span class="form-help">Lowercase letters, numbers, and hyphens only.</span>
        </div>
      </div>

      <div class="form-grid-2">
        <div class="form-group">
          <label for="brand_id" class="form-label">Brand</label>
          <select id="brand_id" name="brand_id" class="form-select-field">
            <option value="">-- No Brand / In-house --</option>
            @foreach ($brands as $brand)
              <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) === $brand->id)>
                {{ $brand->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="status" class="form-label">Publishing Status *</label>
          <select id="status" name="status" class="form-select-field">
            @foreach ($statuses as $status)
              <option value="{{ $status->value }}" @selected(old('status', $product->status?->value) === $status->value)>
                {{ ucfirst($status->value) }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-grid-2">
        <div class="form-group">
          <label for="product_type" class="form-label">Product Type *</label>
          <select id="product_type" name="product_type" class="form-select-field">
            @foreach ($types as $type)
              <option value="{{ $type->value }}" @selected(old('product_type', $product->product_type?->value) === $type->value)>
                {{ ucfirst($type->value) }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="published_at" class="form-label">Publish Date & Time</label>
          <input
            type="datetime-local"
            id="published_at"
            name="published_at"
            value="{{ old('published_at', $product->published_at ? $product->published_at->format('Y-m-d\TH:i') : '') }}"
            class="form-input-text"
          />
        </div>
      </div>

      <div class="form-group">
        <label for="short_description" class="form-label">Short Description</label>
        <textarea id="short_description" name="short_description" rows="2" class="form-textarea-field">{{ old('short_description', $product->short_description) }}</textarea>
        <span class="form-help">Concise summary displayed on product cards and category listings.</span>
      </div>

      <div class="form-group">
        <label for="description" class="form-label">Full Description</label>
        <textarea id="description" name="description" rows="5" class="form-textarea-field">{{ old('description', $product->description) }}</textarea>
      </div>
    </div>

    <!-- Categories & Attributes Panel -->
    <div class="form-panel">
      <h2 class="form-panel-title">Categories & Facets</h2>
      <p class="form-panel-desc">Assign catalog categorization and structured search facets.</p>

      @php
        $selectedCatIds = old('category_ids', $product->categories->pluck('id')->toArray());
        $primaryCatId = old('primary_category_id', $product->categories->firstWhere('pivot.is_primary', true)?->id);
      @endphp

      <div class="form-group">
        <label class="form-label">Categories</label>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 10px; max-height: 220px; overflow-y: auto; padding: 12px; background: var(--bg-canvas); border: 1px solid var(--border-color); border-radius: 10px;">
          @foreach ($categories as $category)
            <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; cursor: pointer;">
              <input
                type="checkbox"
                name="category_ids[]"
                value="{{ $category->id }}"
                @checked(in_array($category->id, $selectedCatIds))
              />
              <span>{{ $category->name }}</span>
            </label>
          @endforeach
        </div>
      </div>

      <div class="form-group">
        <label for="primary_category_id" class="form-label">Primary Category (for SEO & Breadcrumbs)</label>
        <select id="primary_category_id" name="primary_category_id" class="form-select-field">
          <option value="">-- Select Primary Category --</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected($primaryCatId === $category->id)>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-grid-2" style="margin-top: 14px;">
        <div class="form-group">
          <label for="fabric" class="form-label">Fabric / Material</label>
          <input
            type="text"
            id="fabric"
            name="fabric"
            value="{{ old('fabric', $product->base_attributes['fabric'] ?? '') }}"
            placeholder="e.g. Cotton, Silk, Chanderi"
            class="form-input-text"
          />
        </div>

        <div class="form-group">
          <label for="occasion" class="form-label">Occasions (comma-separated)</label>
          @php
            $occasionVal = is_array($product->base_attributes['occasion'] ?? null)
              ? implode(', ', $product->base_attributes['occasion'])
              : ($product->base_attributes['occasion'] ?? '');
          @endphp
          <input
            type="text"
            id="occasion"
            name="occasion"
            value="{{ old('occasion', $occasionVal) }}"
            placeholder="e.g. Casual, Festive, Wedding"
            class="form-input-text"
          />
        </div>
      </div>
    </div>

    <!-- Product Imagery & Media Panel -->
    <div class="form-panel">
      <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
        <div>
          <h2 class="form-panel-title">Product Imagery</h2>
          <p class="form-panel-desc" style="margin: 0;">Update primary image asset or manage the full visual gallery.</p>
        </div>
        <a href="{{ route('admin.products.show', $product) }}" class="btn btn-secondary" style="font-size: 12px; padding: 6px 14px;">
          Manage All Media Assets &rarr;
        </a>
      </div>

      @if ($product->primary_image)
        <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 18px; padding: 12px; background: var(--bg-canvas); border-radius: 12px;">
          <img
            src="{{ $product->primary_image }}"
            alt="{{ $product->name }}"
            style="width: 64px; height: 80px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);"
          />
          <div>
            <div style="font-size: 13px; font-weight: 600; color: var(--text-main);">Current Primary Image</div>
            <div style="font-size: 11px; color: var(--text-muted); word-break: break-all;">{{ $product->primary_image }}</div>
          </div>
        </div>
      @endif

      <div class="form-grid-2">
        <div class="form-group">
          <label for="primary_image_file" class="form-label">Upload New Primary Image</label>
          <input
            type="file"
            id="primary_image_file"
            name="primary_image_file"
            accept="image/png,image/jpeg,image/webp,image/gif,image/svg+xml,image/avif"
            class="form-input-text"
            style="padding: 7px 12px;"
          />
          <span class="form-help">Overwrites or sets the primary image.</span>
        </div>

        <div class="form-group">
          <label for="primary_image_url" class="form-label">OR External Image CDN URL</label>
          <input
            type="url"
            id="primary_image_url"
            name="primary_image_url"
            placeholder="https://images.unsplash.com/... or https://cdn.example.com/..."
            class="form-input-text"
          />
          <span class="form-help">Cloudinary, S3, or Unsplash direct URL.</span>
        </div>
      </div>

      <div class="form-group" style="margin-top: 10px;">
        <label for="primary_image_alt" class="form-label">Image Alt Description</label>
        <input
          type="text"
          id="primary_image_alt"
          name="primary_image_alt"
          placeholder="e.g. {{ $product->name }} front angle"
          class="form-input-text"
        />
      </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
      <a href="{{ route('admin.products.show', $product) }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>
@endsection
