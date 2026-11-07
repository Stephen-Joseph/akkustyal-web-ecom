<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $APP_NAME ?? 'CodeLuxeStudio Admin' }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  @vite([
    'resources/css/admin/common.css',
    'resources/css/admin/layout.css',
    'resources/css/admin/components.css',
    'resources/js/admin/common.js',
    'resources/js/admin/layout.js',
    'resources/js/admin/components.js',
  ])
  @stack('styles')
</head>
<body>
  <div class="dashboard-container">
    @include('admin.layouts.header')

    <!-- Mobile Navigation Drawer -->
    <nav id="mobileNav" class="mobile-nav" aria-label="Mobile Navigation">
      <a href="{{ route('admin.dashboard') }}" @class(['nav-pill', 'active' => request()->routeIs('admin.dashboard')])>Dashboard</a>
      <a href="{{ route('admin.catalog.index') }}" @class(['nav-pill', 'active' => request()->routeIs('admin.catalog.*', 'admin.products.*')])>Products & Categories</a>
      @if (auth('admin')->user()?->role === 'admin')
        <a href="{{ route('admin.settings') }}" @class(['nav-pill', 'active' => request()->routeIs('admin.settings', 'admin.hero.*')])>Settings</a>
      @endif
    </nav>

    <main>
      @yield('content')
    </main>
  </div>

  @stack('scripts')
</body>
</html>
