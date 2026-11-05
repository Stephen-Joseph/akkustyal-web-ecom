<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login · {{ config('app.name') }}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  @vite(['resources/css/admin/common.css', 'resources/css/admin/login.css', 'resources/js/admin/common.js', 'resources/js/admin/login.js'])
</head>
<body>
  <div class="auth-page">

    <!-- ==================== HEADER ==================== -->
    <header class="auth-header">
      <a href="{{ route('home') }}" class="brand-logo" aria-label="{{ config('app.name') }} Home">
        <span class="brand-icon">
          <span class="brand-icon-inner">
            <span class="brand-icon-dot"></span>
          </span>
        </span>
        <span>{{ config('app.name') }}</span>
      </a>

      <div class="theme-switch" role="group" aria-label="Color Theme">
        <button type="button" id="lightBtn" class="theme-btn active" aria-label="Light Mode">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
        </button>
        <button type="button" id="darkBtn" class="theme-btn" aria-label="Dark Mode">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
        </button>
      </div>
    </header>

    <!-- ==================== MAIN ==================== -->
    <main class="auth-main">
      <div class="auth-card">

        <!-- Promo Panel -->
        <aside class="auth-promo" aria-hidden="true">
          <span class="promo-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Admin Panel
          </span>

          <div>
            <h2 class="promo-title">Manage your store with clarity.</h2>
            <p class="promo-text">Track sales, orders and customers, and keep your storefront content up to date from one place.</p>
          </div>

          <div class="promo-stats">
            <div class="promo-stat">
              <span class="promo-stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
              </span>
              <p class="promo-stat-label">Sales</p>
            </div>
            <div class="promo-stat">
              <span class="promo-stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
              </span>
              <p class="promo-stat-label">Orders</p>
            </div>
            <div class="promo-stat">
              <span class="promo-stat-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </span>
              <p class="promo-stat-label">Customers</p>
            </div>
          </div>
        </aside>

        <!-- Form Panel -->
        <section class="auth-form-panel" aria-labelledby="loginTitle">
          <h1 id="loginTitle" class="form-title">
            <span aria-hidden="true">👋</span>
            <span>Welcome back</span>
          </h1>
          <p class="form-subtitle">Sign in to access your admin dashboard.</p>

          @if ($errors->has('login'))
            <div class="alert-error" role="alert">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
              <span>{{ $errors->first('login') }}</span>
            </div>
          @endif

          <form id="loginForm" method="POST" action="{{ route('admin.login.submit') }}" novalidate>
            @csrf

            <div class="form-group">
              <label for="login" class="form-label">Username or Email</label>
              <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <input
                  id="login"
                  type="text"
                  name="login"
                  value="{{ old('login') }}"
                  class="form-input @error('login') is-invalid @enderror"
                  placeholder="Enter username or email"
                  autocomplete="username"
                  maxlength="255"
                  required
                  autofocus
                  @error('login') aria-invalid="true" @enderror
                >
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="form-label">Password</label>
              <div class="input-wrap">
                <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input
                  id="password"
                  type="password"
                  name="password"
                  class="form-input has-toggle @error('password') is-invalid @enderror"
                  placeholder="Enter password"
                  autocomplete="current-password"
                  required
                  @error('password') aria-invalid="true" aria-describedby="passwordError" @enderror
                >
                <button type="button" id="passwordToggle" class="password-toggle" aria-label="Show password" aria-pressed="false">
                  <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                  <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" hidden><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" y1="2" x2="22" y2="22"/></svg>
                </button>
              </div>
              @error('password')
                <p id="passwordError" class="field-error">{{ $message }}</p>
              @enderror
            </div>

            <div class="form-row">
              <label class="remember">
                <input type="checkbox" name="remember" value="1" @checked(old('remember'))>
                <span>Remember me</span>
              </label>
            </div>

            <button type="submit" id="submitBtn" class="submit-btn">
              <span class="spinner" aria-hidden="true"></span>
              <span class="btn-label">Sign In</span>
              <svg class="btn-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>

            <p class="secure-note">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
              Authorized personnel only
            </p>
          </form>
        </section>

      </div>
    </main>

    <footer class="auth-footer">
      &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>
  </div>
</body>
</html>
