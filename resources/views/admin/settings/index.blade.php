@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/settings.css')
@endpush

@section('content')
  <section class="welcome-row" aria-label="Page Header">
    <div>
      <h1 class="welcome-title">Settings</h1>
      <p class="welcome-subtitle">Manage your storefront content, store preferences and admin access.</p>
    </div>
  </section>

  <div class="settings-overview">
    @foreach (config('admin_settings.groups', []) as $group)
      <section class="settings-group" aria-labelledby="settings-group-{{ $loop->index }}">
        <header class="settings-group-header">
          <h2 id="settings-group-{{ $loop->index }}" class="settings-group-title">{{ $group['label'] }}</h2>
          <p class="settings-group-desc">{{ $group['description'] }}</p>
        </header>

        <div class="settings-grid">
          @foreach ($group['items'] as $item)
            @include('admin.settings.partials.card', ['item' => $item])
          @endforeach
        </div>
      </section>
    @endforeach
  </div>
@endsection
