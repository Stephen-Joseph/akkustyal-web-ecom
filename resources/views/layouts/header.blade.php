<!-- TOP ANNOUNCEMENT BAR -->
  <div class="bg-black text-white dark:bg-white dark:text-black text-[11px] sm:text-xs font-semibold tracking-[0.16em] uppercase py-2.5 px-4 flex items-center justify-between border-b border-neutral-800 dark:border-neutral-200 transition-colors">
    <button id="prevPromoBtn" class="p-1 opacity-60 hover:opacity-100 transition" aria-label="Previous announcement">
      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <div id="promoBannerText" class="text-center truncate px-2">
      ⚡ ORDER TODAY, DISPATCHED TODAY! • PAY ONLINE &amp; SAVE ₹100 ON YOUR ORDER!
    </div>
    <button id="nextPromoBtn" class="p-1 opacity-60 hover:opacity-100 transition" aria-label="Next announcement">
      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>
  </div>

  <!-- STICKY HEADER -->
  <header class="sticky top-0 z-30 bg-white/95 dark:bg-[#070707]/95 backdrop-blur-md border-b border-neutral-200 dark:border-neutral-800 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
      <!-- Left: Menu Button & Desktop Quick Links -->
      <div class="flex items-center gap-4 lg:gap-7">
        <button id="openMenuBtn" class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-neutral-100 dark:hover:bg-neutral-900 transition" aria-label="Open Navigation Menu">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h12m-12 5.25h16.5"/>
          </svg>
        </button>
        <nav class="hidden md:flex items-center gap-6 text-xs font-semibold uppercase tracking-[0.14em]">
          <button data-nav-section="showcaseSection" class="nav-scroll-btn hover:opacity-60 transition">Home</button>
        </nav>
      </div>

      <!-- Center: Akku Emblem + Brand Wordmark -->
      <button id="brandHomeBtn" class="flex items-center gap-2.5 group focus:outline-none" aria-label="Go to top">
        
        <span class="font-display text-2xl sm:text-[26px] font-bold tracking-tight uppercase">AkkuStyle</span>
      </button>

      <!-- Right: Theme Switcher, Search, Wishlist, Bag -->
      <div class="flex items-center gap-1.5 sm:gap-2.5">
        

        <!-- Search Button -->
        <button id="openSearchBtn" class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-neutral-200 dark:border-neutral-800 flex items-center justify-center hover:bg-neutral-100 dark:hover:bg-neutral-900 transition" aria-label="Search Products">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="M20 20l-3.5-3.5"/>
          </svg>
        </button>

        <!-- Wishlist Button -->
        <button id="openWishlistBtn" class="relative w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-neutral-200 dark:border-neutral-800 flex items-center justify-center hover:bg-neutral-100 dark:hover:bg-neutral-900 transition" aria-label="Open Wishlist">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
          </svg>
          <span id="wishlistBadge" class="hidden absolute -top-1 -right-1 w-4 h-4 rounded-full bg-black text-white dark:bg-white dark:text-black text-[10px] font-bold flex items-center justify-center">0</span>
        </button>

        <!-- Shopping Bag Button -->
        <button id="openCartBtn" class="relative w-9 h-9 sm:w-10 sm:h-10 rounded-full border border-neutral-200 dark:border-neutral-800 flex items-center justify-center hover:bg-neutral-100 dark:hover:bg-neutral-900 transition" aria-label="Open Shopping Bag">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
          <span id="cartBadge" class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-black text-white dark:bg-white dark:text-black text-[10px] font-bold flex items-center justify-center">1</span>
        </button>
      </div>
    </div>

    <!-- Collapsible Search Bar -->
    <div id="searchBarPanel" class="hidden border-t border-neutral-200 dark:border-neutral-800 bg-neutral-50/95 dark:bg-neutral-950/95 px-4 py-3">
      <div class="max-w-3xl mx-auto flex items-center gap-2">
        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="M20 20l-3.5-3.5"/>
        </svg>
        <input id="searchInput" type="text" placeholder="Search Raglan Tee, Ribbed Vest, Compression, Sweats, Shaker..." class="w-full bg-transparent text-sm focus:outline-none placeholder:text-neutral-400" />
        <button id="clearSearchBtn" class="text-xs uppercase tracking-wider font-semibold text-neutral-500 hover:text-black dark:hover:text-white px-2 py-1">Clear</button>
      </div>
    </div>
  </header>