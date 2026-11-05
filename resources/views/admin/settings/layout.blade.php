{{-- Shell for individual settings pages: breadcrumb + settings sidebar + page content. --}}
@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/settings.css')
@endpush

@section('content')
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="{{ route('admin.settings') }}">Settings</a>
    @include('admin.settings.partials.icon', ['name' => 'chevron'])
    <span aria-current="page">@yield('settings-title')</span>
  </nav>

  <div class="settings-shell">
    <aside class="settings-sidebar">
      @include('admin.settings.partials.nav')
    </aside>

    <div class="settings-content">
      @yield('settings-content')
    </div>
  </div>
@endsection
