@extends('admin.settings.layout')

@section('settings-title', 'Homepage Hero')

@section('settings-content')

<div class="form-page">

    <section class="welcome-row" aria-label="Page Header">
        <div>
            <h1 class="welcome-title">Homepage Hero</h1>
            <p class="welcome-subtitle">Manage your homepage hero section.</p>
        </div>
    </section>

    @if (session('success'))
        <div class="alert alert-success" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.hero.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        {{-- HERO IMAGE --}}
        <div class="panel-card">
            <h2 class="panel-title">Hero Image</h2>

            <img
                src="{{ $hero->image_path
                    ? asset('storage/'.$hero->image_path)
                    : 'https://user52064.na.imgto.link/public/20261105/681688e9ef6f7da8af1cb7bf-effortless-minimalist-streetwear-outfit-removebg-preview.avif' }}"
                class="image-preview"
                alt="Current hero image"
            >

            <div class="form-field">
                <label for="image" class="form-label">Upload New Image</label>

                <input
                    id="image"
                    type="file"
                    name="image"
                    accept="image/jpeg,image/png,image/webp,image/avif"
                    class="form-input"
                >

                <p class="form-help">
                    JPG, PNG, WEBP or AVIF. Maximum 5 MB.
                    Leave empty to keep the current image.
                </p>
            </div>
        </div>

        {{-- TEXT CONTENT --}}
        <div class="panel-card">
            <h2 class="panel-title">Hero Content</h2>

            <div class="form-stack">
                <div class="form-field">
                    <label for="headline" class="form-label">Headline</label>

                    <input
                        id="headline"
                        type="text"
                        name="headline"
                        value="{{ old('headline', $hero->headline) }}"
                        class="form-input"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="description" class="form-label">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="form-input"
                        required
                    >{{ old('description', $hero->description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- BUTTONS --}}
        <div class="panel-card">
            <h2 class="panel-title">Hero Buttons</h2>

            <div class="form-grid">
                <div class="form-field">
                    <label for="primary_button_text" class="form-label">Primary Button Text</label>

                    <input
                        id="primary_button_text"
                        type="text"
                        name="primary_button_text"
                        value="{{ old('primary_button_text', $hero->primary_button_text) }}"
                        class="form-input"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="primary_button_url" class="form-label">Primary Button Link</label>

                    <input
                        id="primary_button_url"
                        type="text"
                        name="primary_button_url"
                        value="{{ old('primary_button_url', $hero->primary_button_url) }}"
                        class="form-input"
                        placeholder="#shop or /collections"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="secondary_button_text" class="form-label">Secondary Button Text</label>

                    <input
                        id="secondary_button_text"
                        type="text"
                        name="secondary_button_text"
                        value="{{ old('secondary_button_text', $hero->secondary_button_text) }}"
                        class="form-input"
                        required
                    >
                </div>

                <div class="form-field">
                    <label for="secondary_button_url" class="form-label">Secondary Button Link</label>

                    <input
                        id="secondary_button_url"
                        type="text"
                        name="secondary_button_url"
                        value="{{ old('secondary_button_url', $hero->secondary_button_url) }}"
                        class="form-input"
                        placeholder="#spotlight or /drops"
                        required
                    >
                </div>
            </div>
        </div>

        {{-- STATISTICS --}}
        <div class="panel-card">
            <h2 class="panel-title">Hero Statistics</h2>

            <div class="form-grid">
                @foreach ([1, 2, 3] as $number)
                    <div class="form-field">
                        <label for="stat_{{ $number }}_value" class="form-label">
                            Statistic {{ $number }} Value
                        </label>

                        <input
                            id="stat_{{ $number }}_value"
                            type="text"
                            name="stat_{{ $number }}_value"
                            value="{{ old('stat_'.$number.'_value', $hero->{'stat_'.$number.'_value'}) }}"
                            class="form-input"
                            required
                        >
                    </div>

                    <div class="form-field">
                        <label for="stat_{{ $number }}_label" class="form-label">
                            Statistic {{ $number }} Label
                        </label>

                        <input
                            id="stat_{{ $number }}_label"
                            type="text"
                            name="stat_{{ $number }}_label"
                            value="{{ old('stat_'.$number.'_label', $hero->{'stat_'.$number.'_label'}) }}"
                            class="form-input"
                            required
                        >
                    </div>
                @endforeach
            </div>
        </div>

        {{-- SAVE --}}
        <div class="form-actions">
            <button type="submit" class="export-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                <span>Save Hero Changes</span>
            </button>
        </div>

    </form>

</div>

@endsection
