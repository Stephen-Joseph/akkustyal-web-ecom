@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto px-6 py-8">

    <div class="mb-8">
        <h1 class="text-2xl font-bold">Homepage Hero</h1>
        <p class="text-gray-500 mt-1">
            Manage your homepage hero section.
        </p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.hero.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-8"
    >
        @csrf
        @method('PUT')

        {{-- HERO IMAGE --}}
        <div class="bg-white rounded-xl border p-6">
            <h2 class="font-bold text-lg mb-4">Hero Image</h2>

            <div class="mb-5">
                <img
                    src="{{ $hero->image_path
                        ? asset('storage/'.$hero->image_path)
                        : 'https://user52064.na.imgto.link/public/20261105/681688e9ef6f7da8af1cb7bf-effortless-minimalist-streetwear-outfit-removebg-preview.avif' }}"
                    class="w-64 h-64 object-contain bg-gray-100 rounded-lg"
                    alt="Current hero image"
                >
            </div>

            <label class="block text-sm font-semibold mb-2">
                Upload New Image
            </label>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/webp,image/avif"
                class="w-full border rounded-lg p-3"
            >

            <p class="text-xs text-gray-500 mt-2">
                JPG, PNG, WEBP or AVIF. Maximum 5 MB.
                Leave empty to keep the current image.
            </p>
        </div>

        {{-- TEXT CONTENT --}}
        <div class="bg-white rounded-xl border p-6">
            <h2 class="font-bold text-lg mb-5">Hero Content</h2>

            <label class="block font-semibold text-sm mb-2">
                Headline
            </label>

            <input
                type="text"
                name="headline"
                value="{{ old('headline', $hero->headline) }}"
                class="w-full border rounded-lg p-3 mb-5"
                required
            >

            <label class="block font-semibold text-sm mb-2">
                Description
            </label>

            <textarea
                name="description"
                rows="4"
                class="w-full border rounded-lg p-3"
                required
            >{{ old('description', $hero->description) }}</textarea>
        </div>

        {{-- BUTTONS --}}
        <div class="bg-white rounded-xl border p-6">
            <h2 class="font-bold text-lg mb-5">Hero Buttons</h2>

            <div class="grid md:grid-cols-2 gap-5">

                <div>
                    <label class="block font-semibold text-sm mb-2">
                        Primary Button Text
                    </label>

                    <input
                        type="text"
                        name="primary_button_text"
                        value="{{ old('primary_button_text', $hero->primary_button_text) }}"
                        class="w-full border rounded-lg p-3 mb-4"
                        required
                    >

                    <label class="block font-semibold text-sm mb-2">
                        Primary Button Link
                    </label>

                    <input
                        type="text"
                        name="primary_button_url"
                        value="{{ old('primary_button_url', $hero->primary_button_url) }}"
                        class="w-full border rounded-lg p-3"
                        placeholder="#shop or /collections"
                        required
                    >
                </div>

                <div>
                    <label class="block font-semibold text-sm mb-2">
                        Secondary Button Text
                    </label>

                    <input
                        type="text"
                        name="secondary_button_text"
                        value="{{ old('secondary_button_text', $hero->secondary_button_text) }}"
                        class="w-full border rounded-lg p-3 mb-4"
                        required
                    >

                    <label class="block font-semibold text-sm mb-2">
                        Secondary Button Link
                    </label>

                    <input
                        type="text"
                        name="secondary_button_url"
                        value="{{ old('secondary_button_url', $hero->secondary_button_url) }}"
                        class="w-full border rounded-lg p-3"
                        placeholder="#spotlight or /drops"
                        required
                    >
                </div>

            </div>
        </div>

        {{-- STATISTICS --}}
        <div class="bg-white rounded-xl border p-6">
            <h2 class="font-bold text-lg mb-5">Hero Statistics</h2>

            @foreach([1, 2, 3] as $number)
                <div class="grid md:grid-cols-2 gap-4 mb-5">

                    <div>
                        <label class="block font-semibold text-sm mb-2">
                            Statistic {{ $number }} Value
                        </label>

                        <input
                            type="text"
                            name="stat_{{ $number }}_value"
                            value="{{ old('stat_'.$number.'_value', $hero->{'stat_'.$number.'_value'}) }}"
                            class="w-full border rounded-lg p-3"
                            required
                        >
                    </div>

                    <div>
                        <label class="block font-semibold text-sm mb-2">
                            Statistic {{ $number }} Label
                        </label>

                        <input
                            type="text"
                            name="stat_{{ $number }}_label"
                            value="{{ old('stat_'.$number.'_label', $hero->{'stat_'.$number.'_label'}) }}"
                            class="w-full border rounded-lg p-3"
                            required
                        >
                    </div>

                </div>
            @endforeach
        </div>

        {{-- SAVE --}}
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-8 py-3 bg-black text-white rounded-lg font-bold hover:bg-gray-800 transition"
            >
                Save Hero Changes
            </button>
        </div>

    </form>

</div>

@endsection