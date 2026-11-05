@extends('admin.layouts.app')

@push('styles')
  @vite('resources/css/admin/dashboard.css')
@endpush

@section('content')
  <!-- Welcome Banner -->
  <section class="welcome-row" aria-label="Welcome Banner">
    <div>
      <h1 class="welcome-title">
        <span aria-hidden="true">👋</span>
        <span>Welcome, {{ auth('admin')->user()->name }}</span>
      </h1>
      <p class="welcome-subtitle">Overview of customer insights, sales performance, and revenue analytics.</p>
    </div>

    <button type="button" id="exportBtn" class="export-btn">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
      <span>Export Report</span>
    </button>
  </section>

  <!-- ==================== 4 KPI CARDS ==================== -->
  <section class="kpi-grid" aria-label="Key Performance Metrics">
    
    <!-- Card 1: Total Sales (Highlighted Coral Orange) -->
    <article class="kpi-card primary">
      <div class="kpi-top">
        <div class="kpi-label-group">
          <span class="kpi-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          </span>
          <h2 class="kpi-title">Total Sales</h2>
        </div>
        <button type="button" class="kpi-arrow-btn" aria-label="View Total Sales">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
        </button>
      </div>
      <div class="kpi-bottom">
        <p class="kpi-value">12,847</p>
        <span class="kpi-delta">+8.2% VS Last Week</span>
      </div>
    </article>

    <!-- Card 2: Active Customer -->
    <article class="kpi-card">
      <div class="kpi-top">
        <div class="kpi-label-group">
          <span class="kpi-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </span>
          <h2 class="kpi-title">Active Customer</h2>
        </div>
        <button type="button" class="kpi-arrow-btn" aria-label="View Active Customer">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
        </button>
      </div>
      <div class="kpi-bottom">
        <p class="kpi-value">5,689</p>
        <span class="kpi-delta">+2.2% New Customer</span>
      </div>
    </article>

    <!-- Card 3: Total Revenue -->
    <article class="kpi-card">
      <div class="kpi-top">
        <div class="kpi-label-group">
          <span class="kpi-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17"/><path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9"/><path d="m2 16 6 6"/><circle cx="16" cy="9" r="2.9"/><circle cx="6" cy="5" r="3"/></svg>
          </span>
          <h2 class="kpi-title">Total Revenue</h2>
        </div>
        <button type="button" class="kpi-arrow-btn" aria-label="View Total Revenue">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
        </button>
      </div>
      <div class="kpi-bottom">
        <p class="kpi-value">$87,632</p>
        <span class="kpi-delta">+8.2% VS Last Week</span>
      </div>
    </article>

    <!-- Card 4: Refund Requests -->
    <article class="kpi-card">
      <div class="kpi-top">
        <div class="kpi-label-group">
          <span class="kpi-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
          </span>
          <h2 class="kpi-title">Refund Requests</h2>
        </div>
        <button type="button" class="kpi-arrow-btn" aria-label="View Refund Requests">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
        </button>
      </div>
      <div class="kpi-bottom">
        <p class="kpi-value">274</p>
        <span class="kpi-delta">+1.0% VS Last Week</span>
      </div>
    </article>

  </section>

  <!-- ==================== MIDDLE ROW ==================== -->
  <section class="middle-grid" aria-label="Profit Overview and Top Products">
    
    <!-- Total Profit Overview -->
    <article class="card-panel">
      <div>
        <div class="card-header">
          <h2 class="card-title">Total Profit Overview</h2>
          <button type="button" class="more-btn" aria-label="More options">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
          </button>
        </div>

        <div class="profit-meta-row">
          <div class="profit-main-figure">
            <span class="big-number">55,8754</span>
            <span class="badge-pill purple">
              +8.2%
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
            </span>
          </div>

          <div class="profit-channels">
            <div class="chart-legend">
              <div class="legend-item">
                <span class="legend-dot sales"></span>
                <span>Total Sales</span>
              </div>
              <div class="legend-item">
                <span class="legend-dot revenue"></span>
                <span>Total Revenue</span>
              </div>
            </div>

            <div class="channel-item">
              <div class="channel-icon shopify">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M15.5 6.5C15.3 4.5 13.9 3 12 3s-3.3 1.5-3.5 3.5H5v13a2 2 0 002 2h10a2 2 0 002-2v-13h-3.5zm-3.5-2c1.1 0 1.9.8 2 2h-4c.1-1.2.9-2 2-2z"/></svg>
              </div>
              <div>
                <p class="channel-label">Shopify</p>
                <p class="channel-val">308 payment</p>
              </div>
            </div>

            <div class="channel-item">
              <div class="channel-icon">a</div>
              <div>
                <p class="channel-label">Amazon</p>
                <p class="channel-val">308 payment</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bar Chart -->
      <div class="bar-chart-wrap">
        <div class="y-axis">
          <span>100k</span>
          <span>80k</span>
          <span>60k</span>
          <span>40k</span>
          <span>20k</span>
          <span>0k</span>
        </div>

        <div class="bars-stage">
          <div class="grid-lines">
            <div class="grid-line"></div>
            <div class="grid-line"></div>
            <div class="grid-line"></div>
            <div class="grid-line"></div>
            <div class="grid-line"></div>
            <div class="grid-line"></div>
          </div>

          <div id="barsRow" class="bars-row"></div>
        </div>
      </div>
    </article>

    <!-- Top Product -->
    <article class="card-panel">
      <div class="card-header">
        <h2 class="card-title">Top Product</h2>
        <button type="button" class="more-btn" aria-label="More options">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
        </button>
      </div>

      <ul class="product-list">
        <li class="product-item">
          <div class="product-left">
            <img class="product-thumb" src="https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=120&q=80" alt="Wellet" />
            <div>
              <p class="product-name">Wellet</p>
              <p class="product-cat">Wellet</p>
            </div>
          </div>
          <span class="product-price">$310</span>
        </li>

        <li class="product-item">
          <div class="product-left">
            <img class="product-thumb" src="https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=120&q=80" alt="Sungless" />
            <div>
              <p class="product-name">Sungless</p>
              <p class="product-cat">Sungless</p>
            </div>
          </div>
          <span class="product-price">$210</span>
        </li>

        <li class="product-item">
          <div class="product-left">
            <img class="product-thumb" src="https://images.unsplash.com/photo-1584917865442-de89df76afd3?auto=format&fit=crop&w=120&q=80" alt="Bag" />
            <div>
              <p class="product-name">Bag</p>
              <p class="product-cat">Woman</p>
            </div>
          </div>
          <span class="product-price">$170</span>
        </li>

        <li class="product-item">
          <div class="product-left">
            <img class="product-thumb" src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=120&q=80" alt="brand new t shirt" />
            <div>
              <p class="product-name">brand new t shirt</p>
              <p class="product-cat">New t shirt</p>
            </div>
          </div>
          <span class="product-price">$170</span>
        </li>

        <li class="product-item">
          <div class="product-left">
            <img class="product-thumb" src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=120&q=80" alt="Samsung Galaxy Watch 6" />
            <div>
              <p class="product-name">Samsung Galaxy Watch 6</p>
              <p class="product-cat">Smartwatch</p>
            </div>
          </div>
          <span class="product-price">$299</span>
        </li>

        <li class="product-item">
          <div class="product-left">
            <img class="product-thumb" src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=120&q=80" alt="Adidas Ultraboost 22" />
            <div>
              <p class="product-name">Adidas Ultraboost 22</p>
              <p class="product-cat">Running Sheos</p>
            </div>
          </div>
          <span class="product-price">$170</span>
        </li>
      </ul>
    </article>

  </section>

  <!-- ==================== BOTTOM ROW ==================== -->
  <section class="bottom-grid" aria-label="Customer Orders and Sales by Countries">
    
    <!-- Customer Orders -->
    <article class="card-panel orders-card">
      <div>
        <div class="card-header">
          <div>
            <h2 class="card-title">Customer Orders</h2>
            <p class="card-subtitle">5 Feb - Oct 2026</p>
          </div>
          <button type="button" class="more-btn" aria-label="More options">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
          </button>
        </div>

        <div class="orders-metric-wrap">
          <p class="big-number">55,8754</p>
          <div class="orders-delta-row">
            <span class="badge-pill green">
              +8.2%
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg>
            </span>
            <span class="orders-extra">+322</span>
          </div>
        </div>
      </div>

      <div class="area-chart-box">
        <div class="floating-order-pill">43,365</div>
        <svg class="area-svg" viewBox="0 0 400 120" preserveAspectRatio="none" aria-label="Customer Orders Trend">
          <defs>
            <linearGradient id="coralAreaGrad" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="#F47E52" stop-opacity="0.28" />
              <stop offset="100%" stop-color="#F47E52" stop-opacity="0.0" />
            </linearGradient>
          </defs>
          <path fill="url(#coralAreaGrad)" d="M0,98 C25,96 40,86 65,88 C90,90 110,74 135,78 C160,82 180,66 205,68 C230,70 250,50 280,55 C305,60 325,38 355,44 C375,48 390,32 400,30 L400,120 L0,120 Z" />
          <path fill="none" stroke="#EA845E" stroke-width="2.5" stroke-linecap="round" d="M0,98 C25,96 40,86 65,88 C90,90 110,74 135,78 C160,82 180,66 205,68 C230,70 250,50 280,55 C305,60 325,38 355,44 C375,48 390,32 400,30" />
          <line x1="280" y1="55" x2="280" y2="120" stroke="#EA845E" stroke-opacity="0.45" stroke-width="1.2" stroke-dasharray="3 3" />
          <circle cx="280" cy="55" r="4.5" fill="#F47E52" stroke="#FFFFFF" stroke-width="2" />
        </svg>
      </div>
    </article>

    <!-- Sales by Countries -->
    <article class="card-panel">
      <div class="card-header">
        <div>
          <h2 class="card-title">Sales by Countries</h2>
          <p class="card-subtitle">Keep track of all orders here</p>
        </div>

        <div class="countries-filters">
          <div class="select-wrap">
            <select class="filter-select" aria-label="Filter by product">
              <option>All Product</option>
              <option>Wellet</option>
              <option>Sungless</option>
              <option>Smartwatch</option>
            </select>
            <svg class="select-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </div>

          <div class="select-wrap">
            <select class="filter-select" aria-label="Filter by country">
              <option>Top country</option>
              <option>United State</option>
              <option>Bangladesh</option>
            </select>
            <svg class="select-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
        </div>
      </div>

      <div class="countries-body">
        <div>
          <div class="country-stat-block">
            <p class="stat-caption">Top Performing Country</p>
            <p class="stat-amount">$2,20,000</p>
            <p class="stat-loc">United State</p>
          </div>

          <div class="country-stat-block">
            <p class="stat-caption">Revenue Growth</p>
            <p class="stat-amount">$2,20,000</p>
          </div>
        </div>

        <div class="world-map-stage">
          <svg class="world-map-svg" viewBox="0 0 650 300" fill="none" aria-label="World Map">
            <!-- Highlighted Royal Blue Americas -->
            <path class="map-continent-blue" d="M45,55 L95,42 L155,48 L195,75 L175,115 L145,132 L130,158 L150,175 L195,198 L215,235 L185,285 L155,275 L145,230 L125,185 L105,152 L75,118 L52,85 Z" />
            <path class="map-continent-blue" d="M195,22 L255,18 L270,48 L225,62 L195,45 Z" />
            <!-- Neutral Warm Grey Continents -->
            <path class="map-continent-grey" d="M295,52 L355,38 L445,35 L545,45 L605,72 L585,128 L535,155 L465,165 L415,142 L365,135 L315,115 L288,85 Z" />
            <path class="map-continent-grey" d="M295,128 L355,125 L395,155 L405,215 L372,268 L335,262 L315,212 L285,168 Z" />
            <path class="map-continent-grey" d="M505,185 L565,195 L595,235 L575,272 L520,268 L498,232 Z" />
          </svg>

          <!-- Pin 1: Top Center -->
          <div class="map-pin-card pin-top-mid">
            <span class="map-pin-flag">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="12" fill="#16A34A"/>
                <polygon points="12,4 20,12 12,20 4,12" fill="#FACC15"/>
                <circle cx="12" cy="12" r="4" fill="#1D4ED8"/>
              </svg>
            </span>
            <div>
              <p class="pin-country">Bangladesh</p>
              <p class="pin-value">$2,365,423</p>
            </div>
          </div>

          <!-- Pin 2: Bottom Left (United State) -->
          <div class="map-pin-card pin-bottom-left">
            <span class="map-pin-flag">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="12" fill="#FFFFFF"/>
                <rect y="2" width="24" height="3" fill="#DC2626"/>
                <rect y="8" width="24" height="3" fill="#DC2626"/>
                <rect y="14" width="24" height="3" fill="#DC2626"/>
                <rect y="20" width="24" height="3" fill="#DC2626"/>
                <rect width="12" height="12" fill="#1D4ED8"/>
              </svg>
            </span>
            <div>
              <p class="pin-country">United State</p>
              <p class="pin-value">$2,365,423</p>
            </div>
          </div>

          <!-- Pin 3: Right (Bangladesh) -->
          <div class="map-pin-card pin-right">
            <span class="map-pin-flag">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="12" fill="#15803D"/>
                <circle cx="11" cy="12" r="5.5" fill="#DC2626"/>
              </svg>
            </span>
            <div>
              <p class="pin-country">Bangladesh</p>
              <p class="pin-value">$2,365,423</p>
            </div>
          </div>
        </div>
      </div>
    </article>

  </section>
@endsection

@push('scripts')
  @vite('resources/js/admin/dashboard.js')
@endpush
