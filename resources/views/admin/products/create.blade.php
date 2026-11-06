@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/catalog.css')
@endpush

@section('content')
  <!-- Header -->
  <div class="page-header-row">
    <div>
      <div style="margin-bottom: 6px;">
        <a href="{{ route('admin.products.index') }}" style="font-size: 13px; color: var(--text-muted); text-decoration: none;">&larr; Back to Products</a>
      </div>
      <h1 class="page-title">Add New Product</h1>
      <p class="page-subtitle">Create a new product in the catalog with categories and search attributes.</p>
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

  <form method="POST" action="{{ route('admin.products.store') }}">
    @csrf

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
            value="{{ old('name') }}"
            placeholder="e.g. Classic Cotton Kurta"
            required
            class="form-input-text"
          />
        </div>

        <div class="form-group">
          <label for="slug" class="form-label">URL Slug</label>
          <input
            type="text"
            id="slug"
            name="slug"
            value="{{ old('slug') }}"
            placeholder="e.g. classic-cotton-kurta (leave blank to auto-generate)"
            class="form-input-text"
          />
          <span class="form-help">Auto-generated from name if left empty.</span>
        </div>
      </div>

      <div class="form-grid-2">
        <div class="form-group">
          <label for="brand_id" class="form-label">Brand</label>
          <select id="brand_id" name="brand_id" class="form-select-field">
            <option value="">-- No Brand / In-house --</option>
            @foreach ($brands as $brand)
              <option value="{{ $brand->id }}" @selected(old('brand_id') === $brand->id)>
                {{ $brand->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="status" class="form-label">Publishing Status *</label>
          <select id="status" name="status" class="form-select-field">
            @foreach ($statuses as $status)
              <option value="{{ $status->value }}" @selected(old('status', 'draft') === $status->value)>
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
              <option value="{{ $type->value }}" @selected(old('product_type', 'configurable') === $type->value)>
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
            value="{{ old('published_at') }}"
            class="form-input-text"
          />
        </div>
      </div>

      <div class="form-group">
        <label for="short_description" class="form-label">Short Description</label>
        <textarea id="short_description" name="short_description" rows="2" placeholder="Brief summary for listings..." class="form-textarea-field">{{ old('short_description') }}</textarea>
      </div>

      <div class="form-group">
        <label for="description" class="form-label">Full Description</label>
        <textarea id="description" name="description" rows="5" placeholder="Detailed product specifications, care instructions, and materials..." class="form-textarea-field">{{ old('description') }}</textarea>
      </div>
    </div>

    <!-- Categories & Attributes Panel -->
    <div class="form-panel">
      <h2 class="form-panel-title">Categories & Facets</h2>
      <p class="form-panel-desc">Assign catalog categorization and structured search facets.</p>

      @php
        $selectedCatIds = old('category_ids', []);
        $primaryCatId = old('primary_category_id');
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
            value="{{ old('fabric') }}"
            placeholder="e.g. Cotton, Silk, Chanderi"
            class="form-input-text"
          />
        </div>

        <div class="form-group">
          <label for="occasion" class="form-label">Occasions (comma-separated)</label>
          <input
            type="text"
            id="occasion"
            name="occasion"
            value="{{ old('occasion') }}"
            placeholder="e.g. Casual, Festive, Wedding"
            class="form-input-text"
          />
        </div>
      </div>
    </div>

    <!-- Form Actions -->
    <div class="form-actions">
      <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">Create Product</button>
    </div>
  </form>
@endsection
