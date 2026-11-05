@include('layouts.app')
<body class="bg-white text-black dark:bg-[#070707] dark:text-white font-sans antialiased selection:bg-black selection:text-white dark:selection:bg-white dark:selection:text-black transition-colors duration-300 overflow-x-hidden">

  @include('layouts.header')

  <main>

    <!-- PAGE HEADER -->
    <section class="border-b border-neutral-200 dark:border-neutral-800 py-10 px-4 sm:px-6">
      <div class="max-w-7xl mx-auto flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
          <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-neutral-400">Your Collection</span>
          <h1 class="font-display text-3xl sm:text-4xl font-bold uppercase tracking-tight mt-1">Wishlist</h1>
          <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 mt-1.5">
            <span id="wishlistCount">4</span> items saved — ready when you are.
          </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center gap-2">
          <button onclick="clearAll()"
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl border border-neutral-200 dark:border-neutral-800 text-xs font-semibold uppercase tracking-wider hover:bg-neutral-50 dark:hover:bg-neutral-900 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Clear All
          </button>
          <button
            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-black text-white dark:bg-white dark:text-black text-xs font-semibold uppercase tracking-wider hover:opacity-90 transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            Add All to Bag
          </button>
        </div>
      </div>
    </section>

    <!-- FILTER / SORT BAR -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex flex-wrap items-center gap-2 border-b border-neutral-100 dark:border-neutral-900">
      <div class="flex items-center gap-1.5 flex-wrap">
        <button onclick="filterItems(this, 'all')" class="fav-filter-btn active-filter px-3.5 py-1.5 rounded-full text-xs font-semibold border border-black dark:border-white bg-black text-white dark:bg-white dark:text-black transition">All</button>
        <button onclick="filterItems(this, 'T-shirt')" class="fav-filter-btn px-3.5 py-1.5 rounded-full text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">T-Shirts</button>
        <button onclick="filterItems(this, 'Shirt')" class="fav-filter-btn px-3.5 py-1.5 rounded-full text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">Shirts</button>
        <button onclick="filterItems(this, 'Jacket')" class="fav-filter-btn px-3.5 py-1.5 rounded-full text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">Jackets</button>
        <button onclick="filterItems(this, 'Blazer')" class="fav-filter-btn px-3.5 py-1.5 rounded-full text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">Blazers</button>
      </div>
      <div class="ml-auto">
        <select id="favSortSelect" class="px-3 py-2 rounded-xl text-xs font-semibold bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 focus:outline-none">
          <option value="default">Sort: Recently Added</option>
          <option value="price-asc">Price: Low to High</option>
          <option value="price-desc">Price: High to Low</option>
        </select>
      </div>
    </div>

    <!-- WISHLIST GRID -->
    <section class="py-10 px-4 sm:px-6 max-w-7xl mx-auto">

      <!-- Empty State (hidden when items exist) -->
      <div id="emptyWishlist" class="hidden flex flex-col items-center justify-center text-center py-24 gap-5">
        <div class="w-20 h-20 rounded-2xl bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 flex items-center justify-center">
          <svg class="w-9 h-9 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
          </svg>
        </div>
        <div>
          <h2 class="font-display text-2xl font-bold uppercase tracking-tight">Your Wishlist is Empty</h2>
          <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1.5">Save items you love and come back to them anytime.</p>
        </div>
        <a href="/" class="mt-2 px-7 py-3 rounded-xl bg-black text-white dark:bg-white dark:text-black font-semibold text-xs uppercase tracking-[0.14em] hover:opacity-90 transition">
          Explore Collection
        </a>
      </div>

      <!-- Items Grid -->
      <div id="wishlistGrid" class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">

        <!-- Wishlist Item Card -->
        <div class="fav-card group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50" data-category="T-shirt" data-price="1099">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <!-- Discount Badge -->
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">15% OFF</span>
            <!-- Remove from Wishlist -->
            <button onclick="removeItem(this)"
              class="remove-btn absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/25 hover:bg-red-500 backdrop-blur-sm text-white flex items-center justify-center transition"
              aria-label="Remove from wishlist">
              <svg class="w-3.5 h-3.5" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
            <!-- Date Saved -->
            <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-black/60 backdrop-blur-sm text-white">Saved 2d ago</span>
          </div>
          <div class="p-3 flex flex-col flex-1">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Old Skool — Red Raglan Tee</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">T-Shirt • Red / White</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹1,099</span>
              <span class="text-xs text-red-500 line-through">₹1,299</span>
            </div>
            <!-- Size Selector inline -->
            <div class="mt-2.5 grid grid-cols-5 gap-1">
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-black dark:border-white bg-black text-white dark:bg-white dark:text-black">S</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">M</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">L</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">XL</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 opacity-40 cursor-not-allowed line-through" disabled>2XL</button>
            </div>
            <button class="mt-2.5 w-full py-2.5 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 active:scale-[0.98] transition">
              Add to Bag
            </button>
          </div>
        </div>

        <!-- Wishlist Item Card 2 -->
        <div class="fav-card group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50" data-category="Shirt" data-price="1299">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">New In</span>
            <button onclick="removeItem(this)"
              class="remove-btn absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/25 hover:bg-red-500 backdrop-blur-sm text-white flex items-center justify-center transition"
              aria-label="Remove from wishlist">
              <svg class="w-3.5 h-3.5" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
            <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-black/60 backdrop-blur-sm text-white">Saved 5d ago</span>
          </div>
          <div class="p-3 flex flex-col flex-1">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Plum Solid Shirt</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">Shirt • Plum</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹1,299</span>
              <span class="text-xs text-red-500 line-through">₹1,599</span>
            </div>
            <div class="mt-2.5 grid grid-cols-5 gap-1">
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">S</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-black dark:border-white bg-black text-white dark:bg-white dark:text-black">M</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">L</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">XL</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">2XL</button>
            </div>
            <button class="mt-2.5 w-full py-2.5 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 active:scale-[0.98] transition">
              Add to Bag
            </button>
          </div>
        </div>

        <!-- Wishlist Item Card 3 -->
        <div class="fav-card group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50" data-category="Jacket" data-price="2199">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">10% OFF</span>
            <button onclick="removeItem(this)"
              class="remove-btn absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/25 hover:bg-red-500 backdrop-blur-sm text-white flex items-center justify-center transition"
              aria-label="Remove from wishlist">
              <svg class="w-3.5 h-3.5" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
            <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-black/60 backdrop-blur-sm text-white">Saved 1w ago</span>
          </div>
          <div class="p-3 flex flex-col flex-1">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Classic Formal Jacket</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">Jacket • Navy</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹2,199</span>
              <span class="text-xs text-red-500 line-through">₹2,499</span>
            </div>
            <div class="mt-2.5 grid grid-cols-5 gap-1">
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">S</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">M</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-black dark:border-white bg-black text-white dark:bg-white dark:text-black">L</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">XL</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">2XL</button>
            </div>
            <button class="mt-2.5 w-full py-2.5 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 active:scale-[0.98] transition">
              Add to Bag
            </button>
          </div>
        </div>

        <!-- Wishlist Item Card 4 -->
        <div class="fav-card group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50" data-category="Blazer" data-price="2799">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://user52064.na.imgto.link/public/20261105/681688e9ef6f7da8af1cb7bf-effortless-minimalist-streetwear-outfit-removebg-preview.avif" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-black text-white shadow-sm">Trending</span>
            <button onclick="removeItem(this)"
              class="remove-btn absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/25 hover:bg-red-500 backdrop-blur-sm text-white flex items-center justify-center transition"
              aria-label="Remove from wishlist">
              <svg class="w-3.5 h-3.5" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>
            <span class="absolute bottom-2.5 left-2.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-black/60 backdrop-blur-sm text-white">Saved today</span>
          </div>
          <div class="p-3 flex flex-col flex-1">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Streetwear Oversized Tee</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">T-Shirt • Ecru</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹2,799</span>
              <span class="text-xs text-red-500 line-through">₹3,299</span>
            </div>
            <div class="mt-2.5 grid grid-cols-5 gap-1">
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">S</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">M</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">L</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-black dark:border-white bg-black text-white dark:bg-white dark:text-black">XL</button>
              <button class="inline-size-btn py-1 rounded-lg text-[10px] font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">2XL</button>
            </div>
            <button class="mt-2.5 w-full py-2.5 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 active:scale-[0.98] transition">
              Add to Bag
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- MARQUEE RIBBON -->
    <div class="ribbon-tilt-right bg-black text-white dark:bg-white dark:text-black py-3.5 shadow-lg border-y border-neutral-800 dark:border-neutral-200 overflow-hidden my-10">
      <div class="flex whitespace-nowrap animate-marquee font-display text-sm font-bold tracking-[0.22em] uppercase">
        <span class="mx-6">YOUR STYLE</span><span>•</span>
        <span class="mx-6">YOUR PICKS</span><span>•</span>
        <span class="mx-6">DEFINE YOUR JOURNEY</span><span>•</span>
        <span class="mx-6">OWN YOUR LOOK</span><span>•</span>
        <span class="mx-6">YOUR STYLE</span><span>•</span>
        <span class="mx-6">YOUR PICKS</span><span>•</span>
        <span class="mx-6">DEFINE YOUR JOURNEY</span><span>•</span>
        <span class="mx-6">OWN YOUR LOOK</span><span>•</span>
      </div>
    </div>

    <!-- YOU MIGHT ALSO LIKE -->
    <section class="py-14 px-4 sm:px-6 max-w-7xl mx-auto border-t border-neutral-200 dark:border-neutral-800">
      <div class="flex items-center justify-between mb-6">
        <div>
          <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-neutral-400">Discover More</span>
          <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight mt-1">Recommended For You</h2>
        </div>
        <a href="/" class="text-xs font-semibold uppercase tracking-wider text-neutral-500 hover:text-black dark:hover:text-white underline underline-offset-4 transition">View All</a>
      </div>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">

        <div class="group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50 hover:shadow-lg transition-shadow">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">New In</span>
            <button class="absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/20 hover:bg-black/50 backdrop-blur-sm text-white flex items-center justify-center transition" aria-label="Wishlist">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            </button>
          </div>
          <div class="p-3">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Plum Solid Shirt</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">Shirt • Plum</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹1,299</span>
              <span class="text-xs text-red-500 line-through">₹1,599</span>
            </div>
            <button class="mt-2.5 w-full py-2 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 transition">Quick Add</button>
          </div>
        </div>

        <div class="group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50 hover:shadow-lg transition-shadow">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">Collector</span>
            <button class="absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/20 hover:bg-black/50 backdrop-blur-sm text-white flex items-center justify-center transition" aria-label="Wishlist">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            </button>
          </div>
          <div class="p-3">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Classic Formal Jacket</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">Jacket • Navy</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹2,199</span>
              <span class="text-xs text-red-500 line-through">₹2,499</span>
            </div>
            <button class="mt-2.5 w-full py-2 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 transition">Quick Add</button>
          </div>
        </div>

        <div class="group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50 hover:shadow-lg transition-shadow">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-black text-white shadow-sm">Trending</span>
            <button class="absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/20 hover:bg-black/50 backdrop-blur-sm text-white flex items-center justify-center transition" aria-label="Wishlist">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            </button>
          </div>
          <div class="p-3">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Core Formal Blazer</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">Blazer • Charcoal</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹2,799</span>
              <span class="text-xs text-red-500 line-through">₹3,299</span>
            </div>
            <button class="mt-2.5 w-full py-2 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 transition">Quick Add</button>
          </div>
        </div>

        <div class="group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50 hover:shadow-lg transition-shadow">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://user52064.na.imgto.link/public/20261105/681688e9ef6f7da8af1cb7bf-effortless-minimalist-streetwear-outfit-removebg-preview.avif" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">15% OFF</span>
            <button class="absolute top-2.5 right-2.5 w-7 h-7 rounded-lg bg-black/20 hover:bg-black/50 backdrop-blur-sm text-white flex items-center justify-center transition" aria-label="Wishlist">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            </button>
          </div>
          <div class="p-3">
            <h3 class="text-xs font-bold uppercase tracking-wide truncate">Streetwear Oversized Tee</h3>
            <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">T-Shirt • Ecru</p>
            <div class="flex items-center justify-between mt-2">
              <span class="font-bold text-sm">₹999</span>
              <span class="text-xs text-red-500 line-through">₹1,299</span>
            </div>
            <button class="mt-2.5 w-full py-2 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-semibold uppercase tracking-wider hover:opacity-90 transition">Quick Add</button>
          </div>
        </div>

      </div>
    </section>

  </main>

  @include('layouts.footer')

  <script>
    // Remove item from wishlist
    function removeItem(btn) {
      var card = btn.closest('.fav-card');
      if (card) {
        card.remove();
        updateCount();
        checkEmpty();
      }
    }

    // Clear all wishlist items
    function clearAll() {
      document.querySelectorAll('.fav-card').forEach(function(c) { c.remove(); });
      updateCount();
      checkEmpty();
    }

    // Update count label
    function updateCount() {
      var count = document.querySelectorAll('.fav-card').length;
      document.getElementById('wishlistCount').textContent = count;
    }

    // Show empty state if no items remain
    function checkEmpty() {
      var count = document.querySelectorAll('.fav-card').length;
      var empty = document.getElementById('emptyWishlist');
      var grid = document.getElementById('wishlistGrid');
      if (count === 0) {
        empty.classList.remove('hidden');
        empty.classList.add('flex');
        grid.classList.add('hidden');
      } else {
        empty.classList.add('hidden');
        empty.classList.remove('flex');
        grid.classList.remove('hidden');
      }
    }

    // Filter by category
    function filterItems(btn, category) {
      document.querySelectorAll('.fav-filter-btn').forEach(function(b) {
        b.classList.remove('bg-black', 'text-white', 'dark:bg-white', 'dark:text-black', 'border-black', 'dark:border-white', 'active-filter');
        b.classList.add('border-neutral-200', 'dark:border-neutral-800');
      });
      btn.classList.add('bg-black', 'text-white', 'dark:bg-white', 'dark:text-black', 'border-black', 'dark:border-white', 'active-filter');
      btn.classList.remove('border-neutral-200', 'dark:border-neutral-800');

      document.querySelectorAll('.fav-card').forEach(function(card) {
        if (category === 'all' || card.dataset.category === category) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }
  </script>

</body>
</html>

