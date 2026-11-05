@include('layouts.app')
<body class="bg-white text-black dark:bg-[#070707] dark:text-white font-sans antialiased selection:bg-black selection:text-white dark:selection:bg-white dark:selection:text-black transition-colors duration-300 overflow-x-hidden">

  <!-- TOP ANNOUNCEMENT BAR -->
  @include('layouts.header')

  <!-- MAIN CONTENT -->
  <main id="mainContent">

    <!-- HERO SECTION -->
    <section class="relative bg-[#050505] text-white overflow-hidden">
      <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 items-center min-h-[480px] sm:min-h-[560px]">
        <!-- Text Column -->
        <div class="lg:col-span-5 px-6 sm:px-10 py-12 lg:py-20 z-10 order-2 lg:order-1">
          <h1 class="font-display text-4xl sm:text-6xl font-bold uppercase tracking-tight leading-[0.95] mb-3">
            TAKE THE FIRST STEP.
          </h1>
          <p class="text-neutral-300 text-sm sm:text-base font-medium tracking-wide mb-7">
            Discover your style, embrace confidence, and move forward with essentials designed for every journey.
          </p>
          <div class="flex flex-wrap items-center gap-3">
            <button id="heroChaseBtn" class="px-8 py-3.5 rounded-full bg-white text-black font-bold text-xs uppercase tracking-[0.2em] hover:bg-neutral-200 transition shadow-lg">
              CHASE
            </button>
            <button id="heroExploreSpotlightBtn" class="px-6 py-3.5 rounded-full border border-white/30 text-white font-semibold text-xs uppercase tracking-[0.16em] hover:bg-white/10 transition">
              Explore Drops
            </button>
          </div>
          <div class="mt-10 pt-6 border-t border-white/10 flex items-center gap-8 text-xs text-neutral-400">
            <div><strong class="text-white text-base font-display block">0</strong> Style Community</div>
            <div><strong class="text-white text-base font-display block">0</strong> Fast & Reliable Delivery</div>
            <div><strong class="text-white text-base font-display block">0</strong> Comfort-First Fabrics</div>
          </div>
        </div>

        <!-- Hero Visual Image -->
        <div class="lg:col-span-7 relative h-[320px] sm:h-[440px] lg:h-[560px] w-full order-1 lg:order-2">
          <img src="https://user52064.na.imgto.link/public/20261105/681688e9ef6f7da8af1cb7bf-effortless-minimalist-streetwear-outfit-removebg-preview.avif" />
          <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-transparent lg:bg-gradient-to-r lg:from-[#050505] lg:via-transparent lg:to-transparent"></div>
        </div>
      </div>
    </section>

    <!-- INTERACTIVE SPOTLIGHT CAROUSEL (Matches Screenshot 3: 01/10 Card Deck + Quick Add) -->
    <section id="showcaseSection" class="py-12 sm:py-16 px-4 sm:px-6 max-w-5xl mx-auto border-b border-neutral-200 dark:border-neutral-800">
      <div class="flex flex-col items-center text-center mb-6">
        <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-neutral-400 mb-1">Interactive Lookbook</span>
        <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight">Featured Drop Deck</h2>
      </div>

      <!-- 3-Panel Peeking Carousel -->
      <div class="relative flex items-center justify-center gap-3 sm:gap-6 my-2">
        <!-- Left Peek Card -->
        <div id="spotlightPrevPreview" class="hidden sm:block w-1/4 max-w-[180px] aspect-[3/4] rounded-2xl overflow-hidden opacity-40 hover:opacity-75 cursor-pointer transition duration-300 scale-95 border border-neutral-200 dark:border-neutral-800">
          <img id="spotlightPrevImg" src="https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg" />
        </div>

        <!-- Center Active Card -->
        <div class="relative w-full max-w-[360px] aspect-[3/4] rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 shadow-xl">
          <img id="spotlightMainImg" src="https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp" />
          
          <!-- Discount / Trending Tag -->
          <span id="spotlightBadge" class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white text-black shadow">15% OFF</span>

          <!-- Wishlist Heart Button -->
          <button id="spotlightWishBtn" class="absolute top-3.5 right-3.5 w-9 h-9 rounded-xl bg-black/25 hover:bg-black/50 backdrop-blur-md text-white flex items-center justify-center transition" aria-label="Wishlist spotlight item">
            <svg id="spotlightWishIcon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
            </svg>
          </button>

          <!-- Mini Angle Thumbnail Switcher inside Bottom of Image -->
          <div id="spotlightThumbs" class="absolute bottom-3.5 left-1/2 -translate-x-1/2 flex items-center gap-1.5 p-1.5 rounded-xl bg-black/50 backdrop-blur-md">
            <!-- Rendered by JS -->
          </div>
        </div>

        <!-- Right Peek Card -->
        <div id="spotlightNextPreview" class="hidden sm:block w-1/4 max-w-[180px] aspect-[3/4] rounded-2xl overflow-hidden opacity-40 hover:opacity-75 cursor-pointer transition duration-300 scale-95 border border-neutral-200 dark:border-neutral-800">
          <img id="spotlightNextImg" src="https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562" />
        </div>
      </div>

      <!-- Active Spotlight Details -->
      <div class="max-w-[360px] mx-auto mt-5">
        <div class="flex items-start justify-between gap-2">
          <div>
            <h3 id="spotlightTitle" class="font-bold text-sm sm:text-base uppercase tracking-wide">OLD SKOOL - RED RAGLAN TEE</h3>
            <p id="spotlightSub" class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">T-Shirt • Red / White</p>
          </div>
          <div class="text-right shrink-0">
            <div id="spotlightPrice" class="font-bold text-sm sm:text-base">₹1,099</div>
            <div id="spotlightOldPrice" class="text-xs text-red-600 dark:text-red-400 line-through">₹1,299</div>
          </div>
        </div>

        <!-- Size Guide Trigger -->
        <div class="mt-3 flex items-center justify-between">
          <button id="openSizeGuideBtn" class="inline-flex items-center gap-1.5 text-xs font-medium text-neutral-600 dark:text-neutral-300 hover:text-black dark:hover:text-white underline underline-offset-4">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/></svg>
            Size Guide
          </button>
          <button id="spotlightViewDetailBtn" class="text-xs font-semibold uppercase tracking-wider text-neutral-500 hover:text-black dark:hover:text-white">
            Full Details →
          </button>
        </div>

        <!-- Size Pills (S M L XL 2XL 3XL) -->
        <div id="spotlightSizes" class="grid grid-cols-6 gap-1.5 mt-3">
          <!-- Rendered by JS -->
        </div>
        <!-- Full-width Add to Bag Button -->
        <button id="spotlightAddToBagBtn" class="mt-4 w-full py-3.5 px-5 rounded-xl bg-black text-white dark:bg-white dark:text-black font-semibold text-xs uppercase tracking-[0.14em] flex items-center justify-center gap-2 hover:opacity-90 active:scale-[0.99] transition shadow-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
          </svg>
          <span id="spotlightAddBtnLabel">Add to Bag — S</span>
        </button>

        <!-- Counter Pill (01/08) + Category Filter Pills + Arrows -->
        <div class="mt-6 flex flex-col items-center gap-4">
          <!-- Prev / Next Circle Arrows -->
          <div class="flex items-center gap-3 mt-1">
            <button id="spotlightPrevBtn" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 flex items-center justify-center hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition" aria-label="Previous spotlight product">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7"/></svg>
            </button>
            <button id="spotlightNextBtn" class="w-10 h-10 rounded-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 flex items-center justify-center hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black transition" aria-label="Next spotlight product">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-7-7l7 7-7 7"/></svg>
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- MEN'S COLLECTION GRID SECTION (Matches Screenshot 7: Product Grid with inline Size Pills) -->
    <section id="catalogSection" class="py-14 px-4 sm:px-6 max-w-7xl mx-auto">
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
        <div>
          <div class="flex items-center gap-3">
            <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight">MEN'S COLLECTION</h2>
            <button id="resetCatalogFiltersBtn" class="text-xs font-medium underline underline-offset-4 text-neutral-500 hover:text-black dark:hover:text-white">View All</button>
          </div>
          <p class="text-xs sm:text-sm text-neutral-500 dark:text-neutral-400 mt-1">Select your size directly on any piece for instant 1-tap bag addition.</p>
        </div>

        <!-- Sort & Filter Toolbar -->
        <div class="flex flex-wrap items-center gap-2">
          <div id="catalogCategoryTabs" class="flex flex-wrap items-center gap-1.5">
            <!-- Rendered by JS -->
          </div>
          <select id="sortSelect" aria-label="Sort products" class="ml-auto sm:ml-2 px-3 py-2 rounded-xl text-xs font-semibold bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 focus:outline-none">
            <option value="featured">Sort: Featured</option>
            <option value="price-asc">Price: Low to High</option>
            <option value="price-desc">Price: High to Low</option>
          </select>
        </div>
      </div>

      <!-- Product Grid -->
      <div id="productGrid" class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">
        <!-- Rendered by JS -->
      </div>
    </section>

    <!-- BRAND MANIFESTO & DIAGONAL MARQUEE RIBBONS (Matches Screenshot 4) -->
    <section id="manifestoSection" class="py-12 sm:py-20 overflow-hidden">
      <!-- Top Diagonal Marquee Ribbon -->
      <div class="ribbon-tilt-left bg-black text-white dark:bg-white dark:text-black py-3.5 shadow-lg border-y border-neutral-800 dark:border-neutral-200">
        <div class="flex whitespace-nowrap animate-marquee font-display text-sm sm:text-base font-bold tracking-[0.22em] uppercase">
          <span class="mx-6">PUSH LIMITS</span><span>•</span>
          <span class="mx-6">TAKE THE FIRST STEP</span><span>•</span>
          <span class="mx-6">PERFORM DAILY</span><span>•</span>
          <span class="mx-6">BUILT FOR DISCIPLINE</span><span>•</span>
          <span class="mx-6">PUSH LIMITS</span><span>•</span>
          <span class="mx-6">TAKE THE FIRST STEP</span><span>•</span>
          <span class="mx-6">PERFORM DAILY</span><span>•</span>
          <span class="mx-6">BUILT FOR DISCIPLINE</span><span>•</span>
        </div>
      </div>

      <!-- Center Manifesto Copy -->
      <div class="max-w-2xl mx-auto px-6 py-16 sm:py-24 text-center">
        <h2 class="text-2xl sm:text-4xl font-bold tracking-tight leading-snug mb-6">
          Every journey starts with confidence. Dress bold, stay true, and define your style.
        </h2>

        <p class="text-sm sm:text-base text-neutral-500 dark:text-neutral-400 leading-relaxed mb-12">
          <strong class="text-black dark:text-white font-semibold">Akku exists for every journey,</strong> creating versatile clothing for those who embrace individuality, express their style, and move forward with confidence.
        </p>

        <div class="text-[11px] font-semibold uppercase tracking-[0.28em] text-neutral-400 mb-2">
          THE DECISION IS YOURS,
        </div>
        <div class="font-script text-4xl sm:text-5xl font-bold">
          Define your style. Own your journey.
        </div>
      </div>
    </section>

    <!-- CRAFTED WITH CARE & CUSTOMER REVIEWS (Matches Screenshot 9 Editorial Craft + Testimonials) -->
    <section id="reviewsSection" class="py-14 px-4 sm:px-6 max-w-7xl mx-auto border-t border-neutral-200 dark:border-neutral-800">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-16">
        <div class="lg:col-span-5">
          <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-neutral-400">Our Craft</span>
          <h2 class="font-display text-3xl sm:text-4xl font-bold uppercase tracking-tight mt-1 mb-4">
            DESIGNED WITH PURPOSE, MADE FOR EVERYDAY STYLE.
          </h2>
          <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed mb-6">
            Every stitch, texture, and fabric is thoughtfully selected for lasting comfort and quality. Designed to retain its feel, fit, and style, wash after wash.
          </p>
          <div class="space-y-4">
            <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800">
              <span class="w-7 h-7 rounded-full bg-black text-white dark:bg-white dark:text-black text-xs font-bold flex items-center justify-center shrink-0">1</span>
              <div>
                <h3 class="text-xs font-bold uppercase tracking-wider">4-Way Stretch Compression</h3>
                <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">Engineered elastane blend that contours without restricting shoulder mobility.</p>
              </div>
            </div>
            <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800">
              <span class="w-7 h-7 rounded-full bg-black text-white dark:bg-white dark:text-black text-xs font-bold flex items-center justify-center shrink-0">2</span>
              <div>
                <h3 class="text-xs font-bold uppercase tracking-wider">Heavyweight 380 GSM French Terry</h3>
                <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-0.5">Structured drape on our Core Sweats and Oversized Tees for studio-to-street versatility.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Customer Testimonials Grid -->
        <div class="lg:col-span-7">
          <div class="flex items-center justify-between mb-5">
            <h3 class="font-display text-xl sm:text-2xl font-bold uppercase tracking-tight">What Our Customers Say's</h3>
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">4.9 ★ (1,420+ Reviews)</span>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 flex flex-col justify-between">
              <div>
                <div class="text-xs tracking-widest mb-2">★★★★★</div>
                <p class="text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">"Example of the reviews. "</p>
              </div>
              <div class="mt-4 pt-3 border-t border-neutral-200 dark:border-neutral-800 flex items-center justify-between text-[11px]">
                <span class="font-bold">Devkrishna</span>
                <span class="text-neutral-400">Verified </span>
              </div>
            </div>
        </div>
      </div>
    </section>

  </main>

  <!-- FOOTER (Matches Screenshot 5: KNOW MORE, Policies, Action Buttons, Huge AKKU™ + Crest) -->
  @include('layouts.footer')

  <!-- ==========================================
       SLIDE-OUT MENU DRAWER (Matches Screenshot 2)
       ========================================== -->
  <div id="menuDrawerBackdrop" class="fixed inset-0 z-40 bg-black/60 backdrop-blur-xs hidden transition-opacity"></div>
  <aside id="menuDrawer" class="fixed top-0 left-0 bottom-0 z-50 w-full max-w-sm bg-white dark:bg-[#0b0b0b] text-black dark:text-white flex flex-col justify-between p-6 transform -translate-x-full transition-transform duration-300 border-r border-neutral-200 dark:border-neutral-800">
    <div>
      <!-- Top Bar inside Menu -->
      <div class="flex items-center justify-between pb-6 border-b border-neutral-200 dark:border-neutral-800">
        <div class="flex items-center gap-2">
          <span class="font-display text-2xl font-bold tracking-tight uppercase">AkkuStyle</span>
          
        </div>
        <button id="closeMenuBtn" class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-neutral-100 dark:hover:bg-neutral-900 transition" aria-label="Close Menu">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Menu Navigation List -->
      <nav class="mt-8 space-y-5">
        <button data-menu-filter="All Products" class="menu-nav-item block text-2xl font-normal hover:opacity-70 transition text-left w-full">Home</button>

        <!-- Explore fits accordion -->
        <div>
          <button id="menuExploreFitsToggle" class="w-full flex items-center justify-between text-2xl font-normal text-neutral-500 dark:text-neutral-400 hover:text-black dark:hover:text-white transition">
            <span>Explore fits</span>
            <svg id="menuExploreFitsArrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div id="menuExploreFitsSub" class="hidden pl-4 mt-3 space-y-2.5 border-l border-neutral-200 dark:border-neutral-800 text-sm text-neutral-600 dark:text-neutral-300">
            <button data-menu-filter="T-shirt" class="menu-nav-item block hover:text-black dark:hover:text-white">Raglan &amp; Oversized Tees</button>
            <button data-menu-filter="Compression Fit" class="menu-nav-item block hover:text-black dark:hover:text-white">Second-Skin Compression</button>
            <button data-menu-filter="Gym Vest" class="menu-nav-item block hover:text-black dark:hover:text-white">Ribbed Training Vests</button>
            <button data-menu-filter="Track Pant" class="menu-nav-item block hover:text-black dark:hover:text-white">Heavyweight Sweats &amp; Track Pants</button>
          </div>
        </div>

        <!-- Seasonal Drops accordion -->
        <div>
          <button id="menuSeasonalToggle" class="w-full flex items-center justify-between text-2xl font-normal text-neutral-500 dark:text-neutral-400 hover:text-black dark:hover:text-white transition">
            <span>Seasonal Drops</span>
            <svg id="menuSeasonalArrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
          </button>
          <div id="menuSeasonalSub" class="hidden pl-4 mt-3 space-y-2.5 border-l border-neutral-200 dark:border-neutral-800 text-sm text-neutral-600 dark:text-neutral-300">
            <button data-menu-filter="All Products" class="menu-nav-item block hover:text-black dark:hover:text-white">Monochrome Winter '26</button>
            <button data-menu-filter="Gym Vest" class="menu-nav-item block hover:text-black dark:hover:text-white">Consistency Core Pack</button>
          </div>
        </div>

        <button data-menu-filter="New In" class="menu-nav-item block text-2xl font-normal text-neutral-500 dark:text-neutral-400 hover:text-black dark:hover:text-white transition text-left w-full">New In</button>
        <button data-menu-filter="Collector" class="menu-nav-item block text-2xl font-normal text-neutral-500 dark:text-neutral-400 hover:text-black dark:hover:text-white transition text-left w-full">Collector Series</button>
        <button id="menuAboutBtn" class="block text-2xl font-normal text-neutral-500 dark:text-neutral-400 hover:text-black dark:hover:text-white transition text-left w-full">About</button>
      </nav>
    </div>

    <!-- Bottom Profile & Wishlist Links -->
    <div class="pt-6 border-t border-neutral-200 dark:border-neutral-800 space-y-4 text-xs font-semibold uppercase tracking-[0.18em] text-neutral-500 dark:text-neutral-400">
      <button id="menuProfileBtn" class="flex items-center gap-3 hover:text-black dark:hover:text-white transition w-full">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <span>PROFILE</span>
      </button>
      <button id="menuWishlistBtn" class="flex items-center gap-3 hover:text-black dark:hover:text-white transition w-full">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
        <span>WISHLIST</span>
      </button>
    </div>
  </aside>

  <!-- ==========================================
       SLIDE-OUT CART DRAWER (Matches Screenshot 1)
       ========================================== -->
  <div id="cartDrawerBackdrop" class="fixed inset-0 z-40 bg-black/60 backdrop-blur-xs hidden transition-opacity"></div>
  <aside id="cartDrawer" class="fixed top-0 right-0 bottom-0 z-50 w-full max-w-md bg-white dark:bg-[#0b0b0b] text-black dark:text-white flex flex-col justify-between transform translate-x-full transition-transform duration-300 border-l border-neutral-200 dark:border-neutral-800">
    <!-- Top Cart Header -->
    <div class="p-5 border-b border-neutral-200 dark:border-neutral-800 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <span class="font-display text-2xl font-bold tracking-tight uppercase">AKKU<sup class="text-[10px] font-sans font-semibold">TM</sup></span>
        <svg class="w-6 h-6" viewBox="0 0 44 40" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 4L38 13V27L22 36L6 27V13Z" />
          <path d="M14 27L22 11L30 27" />
          <path d="M17 21H27" />
        </svg>
      </div>
      <!-- Pill Close Button like Screenshot 1 -->
      <button id="closeCartBtn" class="inline-flex items-center bg-neutral-500 hover:bg-neutral-600 text-white text-xs font-semibold rounded-lg overflow-hidden transition">
        <span class="px-2.5 py-2 border-r border-white/20">✕</span>
        <span class="px-3.5 py-2">Close</span>
      </button>
    </div>

    <!-- Scrollable Cart Body -->
    <div class="flex-1 overflow-y-auto p-5 space-y-6">
      <!-- Active Cart Items -->
      <div id="cartItemsContainer" class="space-y-4">
        <!-- Rendered by JS -->
      </div>

      <!-- YOU MIGHT ALSO LIKE (Akku Fuel Bottle ₹399) -->
      <div class="pt-4 border-t border-neutral-200 dark:border-neutral-800">
        <h4 class="text-[11px] font-bold uppercase tracking-[0.16em] text-neutral-400 mb-3">YOU MIGHT ALSO LIKE</h4>
        <div class="p-3.5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800 flex items-center gap-3.5">
          <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAcFBQYFBAcGBgYIBwcICxILCwoKCxYPEA0SGhYbGhkWGRgcICgiHB4mHhgZIzAkJiorLS4tGyIyNTEsNSgsLSz/2wBDAQcICAsJCxULCxUsHRkdLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCwsLCz/wAARCAMgAyADASIAAhEBAxEB/8QAHAABAQADAQEBAQAAAAAAAAAAAAECAwQFBgcI/8QAUhAAAgECBAMCCgQICwcEAgMAAAECAxEEBSExBhJBUWEHExQiMnGBkaGxI0JSwRUzQ2JykqLRCCQlNFNjgoOTsuEWNURVc8LSF0VUhDbwZHTx/8QAFgEBAQEAAAAAAAAAAAAAAAAAAAEC/8QAFhEBAQEAAAAAAAAAAAAAAAAAAAER/9oADAMBAAIRAxEAPwD9MA6F6FYB0AQURQABQAG5ClsUSxQCAClsrARIFIAKkQoDqAAABbXAhbFS7SgRKxSFAhQAAAKBCgCAoIAICigAAAABQthbUIgLYWCoCsbASwMmRICArWofYBAX6pLAANgAA2FiAAOgAhQABAAKAUCMoCIikKRUAARAChULYhbgS1kEVktqEAQoEAAUZj1MmRLtKIACALAAQFsR7hAABS2hDIltSiXHQW0AAdQAAAIAAAxRSMIqKigEUGw6ACgIoEKAAARQGxWQoRC2ACgAAAqVy2QBIWsykCKCAKFIUAAQooIUAQAAUDoQBa5dOwJWZURK5balAUJ1uUEEsUAAAAAAAAlygAAAZEikuAauLaWFxcINajpYAKWGmxSOwEat1IZMlgAFi+sIgACgBABSAACgCNAFAxBbEAq2KS5QI0Y9TK4dgjEFsQKAACW7CWMg1oBiCsgAligCFRGVAAABLa2IZEaKIAAAAIAAAltSgACkBQKkRbmQBKwAIAsWxegELYhQFgAAAC1AFSCVygUhQBAUgAFAAAgFIAABkkCgu0d5SBApCkUAAAAAAAAAAEGpQBCgAQoAEBSFC4KCCApLXAACwAhQBCgAAABLCxQBNCGRABCgAQpAAAAAACAoAgAACwKBjr1Bk0Y2AAdQAe5jYyZAICsgAAAQFsTYIXLcgCjJ1KS3eAAAAAAAAULlIVAUAEAttAtC3AguUBCwACgBbMBuVIJWKECFIABQFQpCgAAEBYtigY2FjIBUKQoQIUAASxQAACgACA6gBQAAAAAAAQAAUAAAABAdAAAACgACJYFAEAsLAALAKAAIlgUAQhkSwVAUAAAEAABiChoKhQAgAAMWCke4VLgAALIFCJoQrsQAAAqApAAACD7SFFu8KgAACwL0AIoAAtglYbhAAoAABQAqt2AWwsChAAjApCkCqAAAACCKAATFyFCqAgAAAQAAUAAAABADpcAALAKAtgBAy7AInQdCgCdAUBUBQEQFIAAAUAAAABAABQAACNFARBcvUjAEAKqgAgEKAiAAACAKFACIAGAIAFACgY2BkRhGILqQAGAFQABAMACArIFBcACWBQAWiKQICixUAKiBblAdAAAALYoK6MiFIAAAEAKABQC3Fh1KQNkAAIC2BQKAQAAAABRCgttAIOoKQNQAECFBVAAQAAAABQABAAAAAFE0KAAAAC19yFBBB03KQoAWAAAEAAAQoIULXFigDHXsFzIltAiXFyFCgCKBiUWBAAIADAKICi2gACxCCgjBQZGih6gYgr7iEAAAQDfYAAABAUgAAACohkBSAqAIAAADJdoEtrsUoAAEKAAAewqVyFRAKAECFQClgCgAAAAG4QAsCqFQ6gBsgAQAAAACKAFhYgAtiBAAFUBQBAUWCIC20BFQAWKAFgQAUjCAJcXKqghUAABAJ0KAIACiFAIAAAEsUAY2YKRooBAAUjKCDEFHUCAFAhQAIwUgEZCkKKQoAgdygIxABFPYLAAQFsQAAAJ0IVvsCCKVEsVFUKAQACpAWJSFCABAKACqAqWgSIhYFZAAA6gUABQAAAOpQidSgBQAAAAEACoCAoClhYAIoBAKQAAAAoAAgAAAACgACKQABYlrsoQGPUpbAqsSlsLEQIAAAAUAAEABUAAQAAFB0ACI0QyI0UQXACqCAAACIAAAAQKPYxMyWKidAGrABYAEVLaEMiPssBAAEAwAIAAqMFFgKUAAAVICpFAAAEApAWxRChFsuwAigEQIUgFBAVVABAAKEAAVQELYgF6CwCAAAAAqgAIKCAIAAqgASuAKQEQBUHuFS4AKAAAFICAOgBUAAFAAQUgAQuQoKqAoAgAZEQAFUABQABlAAAAAVUfeQpLAAAAAKEQhbAKgBSB1AARGRoo6lEAtqAqkKCDAFZAAAAWIUWuBACoCgFWrAJFKQIoJ1KFQAFAttCra4AIpCkAEHUoAACgBIgFsLAIdAAVQWBQJbQoBAAAAAJXKAHUya0IMQZJbiwEs7BrQo0KJbQWKAJre9i2KCDGxbFIBN2VAFCxGkZaEt3ARhFARGiewttdS9QrEFauLICW7gV3FiCAAAACgACAAAIwUFGIKLDRAAUOpSFuQDEo0AgBQAAIMdbAyI1cogFgAAKBALBkQIAVQMACPcItiPQCkFwAIygDEFdiAVB6hAiMWDIxZVZWKECCgiKBSAADJBAAUhQgAABCgKAti2CJYAAALCwURQAAKAiAttL3IUB7DKxQrGy3FrmVgBLAoIgQAAAWwVCj1F5JW9CXuCIDCdSFJXqThBfnSS+ZxVs8yrD/js0wNO32sRBfeB6BDxKnGvDFH8ZxDlkf/ALMX8jmn4ReDqSvLiPA/2ZSl8kVX0gPkqnhT4IprXiLDv1U6j/7Tnl4XuBYuz4hpf4FT/wAQj7Up8ZT8LfAtTRcSYZfpU6i/7T0sJx9wjjWlQ4myuTeyeIUH+1YivoSGNGvRxVNVMNVp4iD+tSmpr3otwKACgUAiBGkGWMZTdoxcn3K5RjbsFu06I4PEyWlCftVivBYhLWnb1tBXMQ3yw1S+qX6yMHQmui96CNYNnian2WR0pr6rIMAZOEl9V+4jT7AIAApYjWpQwiWIUW0KIAAoAAgAAAAIAACpbQjVjKxGiiAAIXAAVOgKAAAIgR7FIBAV6sltSqAdQghYjMiOxBiAApcNAAZgAAUEAosLXKggALAOpQAAACgBkkghawYHTYCFFgVQAEApAEULcLVMWfaBQC2CsWzz8z4gynJIp5nmOHwjeqjUn5z9UVr8DzuKeIKeU4Ss3XdCnS0q1Y+nzNXUIfnW1b6J9p+EZ/xViMdWqLC044WjJ68us598pvVso/b6fhP4MnWVP8O0YN6XqU5xXvaPpsLi8Nj8NHEYPEUsTRltUpTUov2o/j7E4mVXSb5vXqbsj4pzfhPHxxeU4yrQV7zpp+ZNdjjsyD+wHoTpe2i3fRH8+VvD/nGIhGFHD4elUcdXGKWvar3PAzHwg8Q5td18wnZ9I/6gf0fjuIsoy1PyvMsNTa+rz80vcrny2Y+F3hrAtqnUrYmS6RSgvi7/AAP54xGKr4ht1a1So39qTZyTqQpq8pKPrA/bMb4eEm1gsqp26OpOUvlY8LF+G/iOsvoPJ8OvzKMfvufl8HVrK9KjJr7UvNR10sBUkvpa9u6mvvYR9Zi/Cpxbik+bOMRTXVU58i+CR4OL4yzfEtvEZtiJ3+1Xk/vOaeX4dUpWpucrPWTbPlH50gr3MRnMqz87ESqN91zQ8RWmuZUqzXby2PqOCOH8NWTxeNVNRjs6kkl8Tr4mxWX070qOJw2mloTi/kUfDyxFRfUn7WYeXSWji/eba9Wk5O04+84puL2kveQbpYxv6vxZrddTeqt7zS0u1e8yjTbey95FZckJa81vb/obKFKMppJ81+lrndhsFGpS861+5nbk/D1XGZthqWGkvGyrQjFSdtXJLfoVGOXeV5fiFVwmIq4aafp0ZuD+Fj9/8EfE2b53SxeDzTFSxioU4zp1Kms1razfVes8uHg0z6q342lgI906qfyTPr+CeD63DVfE4ivOgp14Kn4ujdre9238gPrwAEAAB6GV4elV551IKTi0lfZew9OU4UY6yUIr2HzrrYinScKE+Tmd30ucFbD42rq3zvvmVXq4vi/B4avKjBOpJHFPipV3aGHb7jysPw7VqTlUqNpy3W57WByvD4NXnyJ9smByyzWpPfDTNbxk5O6w9Q9ubwPLrWor+0jnlVwMb/T0veQeVLFVI/kKnvRpqZmqfpRqx9lz0K+JwlnavT955WKlTqJqE4y9TRUbIZ1Qk7eUuL7GmjohmKl6GJi/7R8xiMPU57qnP1pGp80XZ3XrQV9isXVavzKXsuPK5dYxfsPg8Vi6+Gg50qkotdEzLDcU4inaNXzvWEfc+WJPWHuZksXTe8ZI+bw/EeGqtKouW/VM9WhisNiEvF1otvo9APTVWnLaXvMtHszgaa0ZVJp6XCu1oGmnOb6npYHB+V1OV6RWra7AjkjGU5csYtvsSNrwtWKu4W9bR6GLr08LHxOHiopdh5VXETlrKTAmzt1KefiZc8Xdu/anqjmy/N5fhD8HYz8bNN0anSolvF/nfMD2ALAKAAiAduoAGILZdhGtQBCtAqiALoEQBggEACgsUAYvcB7gqIAUCMhkRhUABBn1AAFIUWAvQABD1FBAqgAoAIpAWhbkARdwSxSqAAAAW2hAL0A6lAAADGvXjhcLWxM/RowlUfsTf3FbSWrsfnHHfhCwlDEQ4bwE1WxWNnGjVcfqQk0nd9NNur7luHx3hDzOrXx9HBzk2qNNVKi+1Un50n72fn2Ia1Po+MMV5TxTmEk7xVVxXs0Pmq70YHnVdGc03ujorbnM9wPMk3GrdbpnpUMYo01KcrI4PF+MxTgutzGpFwUX0kroyr0/LJVpcsPNXbuztwuDipc6heT+tLVmvhnKcTnOMhhsJh6uIrSekKcHJv3H6/lPgyweChCpxLxBluUR3dF4mnKq/Xd2j8So/OKeFbSbVr9p9Vkng+z7OYxnhstqxpP8rW+ih75b+w/Tcux/gw4aSeEznJvHLetVrqtU99nb2WPR/wDU3gpy/wDyjL2++cv/ABBj5jLvAtopZnmkIdsMNT57f2pWXwPwXjHhXGcH8TVcpxjg6sEpxlCV1KMtYtetdHqf1XhuPeFMXG9LiTK5LvxEY/5rH85+FbN8FxJ4S8di8trLEYaMadGFSO0+WKTa7Ve+oV1+D3hjBZxWVTH0fKIx2U22vcfX8TcO5PgsFKNDL8NTt9mmkY+DTAzo4BzlBq+p3cYzthpFiPxrMcLShWkowil3I8epTSbse5mLvWkeNV3JSOdxsZU156ukGZU0udEV6lChTlTV4K/afpPgi4YhnXEPPPGTp0sJFV502uZztJWUX01tfuPzvDRvRR+q+A2t4ri2rS/pMNUXus/uNI/eWtWwVgCFICAACgXYlgBto5fUzCrKU8TVhQglHxUHy3fVt7nbRyHA03fyeEn2y85/E25TG2GlLtkeigOXyKhCNlRgvVFHLWwlHX6KPuPTmcVYDxcTgaDT+ij7jwsbl1BXagk+4+nrq6Z4+MjowPlMTRlSl5kmvUzlqVq0Y/jZ6d9z1MZDzmeNjaipUm29AjlpLGZnmNPBUoxqupp0Tiur9SPpcVwUpa0cRGXdONvkfI5Bm9DCcV4StWnyUlJxlJ7JNNXP1Gnj8HUjeOJpzX5j5vkB8NieF8dh4t+Jk0usdV8Dy5QxeFldOSsfqMcXQ6Tf6kv3HPiqOAxiarU4Sv1cXF++wV+f4bijHYRqMnzxXSWqPost4owWMcYVX5PUe3M/Nft6GvMOEqFZOWDrQbf1JtJ+8+OzXK8TlranCUPWij9aoRU0nF3T2sfQ4OCw+WSqdZXZ+J8KZ/mWExSo0q3PRuuanU1il1fcft2JbhkVO+7gr+65keHVm5SbOSq9DbKZzVmrMo5asu88DP1OOEWKpO1bDTVWD7Gme1Va1POx9NVcDWg1e8H8gPqcPUVfD060fRqRU16mrmZ8PwtxjCly5ZmTUYQtCjiNkl0jPu7H7+0+4dgIBcEQBHuAq9CbFBRGQrIEAAFCFIAAAFABBOpGUFGIAKKiO/YUdSDHWwKyIDMoIQZdwIUIAAKpCgoAdC2IAAAAACgAAVK4sEtQhbUoAUABQJNxhBzlJRjFXbeyJVq06FGVWrNQhHds/D/CL4UquYzq5VktR08NFuNTEQes+1Rf3+7tA7vCT4VfE+NyfIqidT0a2IWvJ3LtfwXr0X5jwpGWK40y11JOc5YhTlKTu21dttnh4irGlC8tO4+84L4HzfAPLuKczi8JRr1XTwuGnF884unKTqP7KstL6v1EHj5pUdXNcXUvfmqyfxPNrK8Tsqp1K05PrJv4mueHk4vRlHj1Y6nPKm0z6/L+Dcdj6SxNRRwmFf5av5qf6K3l7DuqZLlOXwapUpY2qvylbzY37or7wPzCanTxXNFO6d1oZeTVa03LkVNPouh9fj8Eqk3K0U+yKsjzvJoxexMNeXh6NfDqap16kFNcs1CTipLsdtzOFBR2jH12PSdNdhhypDDXDKnLtNcoyT3PQcVYwcEB58myU1epqdkqKZj4lJ6Io+u4f41zzh7DRhh69PF4Vf8AD4mN7eqS1R6GZ8fZfnmGcK1KpgMS/qSfNB+qX7z4KdWcY2TOOrNy1YHpY+SlVk07p9Tyqm5gqkoppNpdnQOfNq9yEYNGVNeeiGdJeeiLXuYKCdFM/QPBBV8T4QMIr2U+eHvgz4TBR+gR9V4Oa/iOP8qle38Yivfp95WX9NXuQsdrBooi3MmtBZblCsACkEKTUoHs5Zpgo97b+J3I4sD5uEpruOyGpRJvQ46p2zWhzypSnsgPLrLc82vRlUdlFts+kWBi3eb9iNkaFOn6MEgPjlw3isXK7SpR7ZG+nwJlzfNi3PEPsbsj6tmD3CPIw/DmVYO3icDQg115Fc7o0YQVoxSXYtDe2YPYK0uCtojVKmuqR0M1SA550ab3hFrvRy4nLMDi6TpYjCUqsH9WUTukapOwR8+uAeHZYuNaGHrULNNwpVpRhK3aj67Nq6ll8VFprbQ8yVSyOWtVb6sK1ORz1dTY6i6mipNMI5qlrvU56keanJdqZuqOzNL1TCvzafmY2a+B93w7nFXC4eFKs5VMLbRbypertj3dOnYfJ1clxtTD4jMqFPx9CjWlTqxgrzp215rdVr7D1ckrKVGNmmns11CV+iwnGpCM4SUoyV007pozPn8vxFTCu8E5UnrKl98ex/Bnv0qlOvSjVpSUoS2aCjQ2KAIigEQAAVjYFZCgQoKAL0IQQFIADBQMLWBk1cxAoBABHuUAZgAAUiKAKAQAAEUAAABuFVAAACi1wi7lIkAKQFQVGc+MxlHA4adevUUKcE222lsbMViKOCwdXFYmoqVCjFznN9EfgfhE43r8RYmeCw7dPAQdpJP8ZbZepfF9yQRr4/8ACVieIa1TAZfVdHLo3i5RdnVXYvzfi+5aH51VrKLUYxc6k3ywhFXcn0SRa8qtTEU8NhqU6+KrSUKVKCvKTeisj9v4B8HuX8AYH/aXimtRlmyXMudpwwmm0ftVO19OnaFaPBr4IIZd4viLi+lCWKjapQwNSzhQXSVTtl2R2XW70PS4g4ww3EXFH4OwH0lDLqFevOt2z5OW3xf/AO6L4zjvwsYjiKU8BlEp4bL4u0qidpVPV+/3dr0+DqrgsDXxmLzFyp0KmFdOmkvOqXkrqK+8o1ZZwzi8wrqFKk3peUnpGK7W+iPoKeByrJUnTpwx2Lj+UnG9OD/Ni9/W/cdOYZ+quH8nwlGOGwq/Jxe/fJ9WfO4jGavmnH3lR2Y7G1cXVdWtVdSb6tnkYidzVVzCkt539SOKeZ0FdNSZBrxMXK6PPq0WrnXUzej0oyftOStmUZ3SoNe0DmnFo0z22M54u7f0bRqlW5vqhWD3MWytt9H7jFrufuIhcxb0YafY/cS3bf3AYSVzmnTOmSt1NU/UwrknCxrcWdMmuxmqVuwDCzNtGK5lfQxjY6KXLJ2ugPawXL4lWafqPY4Tquhxdl9RO3LiKb/bR4GCwrnNOMuV9x9PlGXTo46jiYO7hJSt6ncI/qRxtJrvYMaVenisPTxFOalTqxU4yWzT1LcKoJfUXCJbUrWgAEBdGEruyWrA9rCq1CC7Ejrhoc+Hi1TV10OhaIqs3yhsxuiNogPXqYSMrowckERmD3K5LsMWyqxZizJsxbXQDWzVJm5pGtxT6kRpkzRNnTKC7TTOlfqByVJHLVkd8sPf6xongm9poqvNnJHPOoj0KuXVHtKJxVcuxGtrP2hHDVruL7e8xVWMo6M2VMuxSXoN+o4qmFxNG8lCSfqCPJy7iaHD2eV8NiY3weIrScpxXnU5aWl3q26Pbx2QxVT8J5Mo1adVc9TD035tRP69Psfds/WfA8Q0q3l1SpOm4+df4W+47uFuK8TkNVUZ81fByd5Ub+i/tR7H8H8SNPtcHVhVoKpSlzRej7U+xrozsp16mHk6tG136UHtP9z7zGrTw2aUVmuT1YTqT9OKdo1e6S+rP/8Ae84o4pTpucbxs+WUZaOD7GUfSYbFUsXR8ZSldXs094vsfebT4r8KVMvx8cVQvNaRrUk/xkf3ro/YfZ0atLE4enXozVSlUipRkuqCMgAQAAFLXJsUWCMQW2pCgXoQoEIUEUAAQsYvcyI9ijEFIFVAFAoAQFsijqCAAXQCFACABQqFAAAFQFtoLXQAC1gAAKgAPzXwvZtVVDB5NSk1Ca8orW+tZ2gvfd+4/GcdalTcrOUm7Rit5PsP3vwgcKVc4pRzHCpzrUafJOmt3FO6a9V3ofjdfLnDEynUjrDSPd2sDVwhxLkfAFLFZ1i8NLNOI6rdPDU0uWlhoW1bl2u9tNbLpc8DOeLOJfCBmbeLqSq046qjT8yjSXyXt+Izbh7yivKrCtyRd24uN7eo2YKn5HhY0oR5YLVrtfa+8K6cuyGhSlGeKqPFSi7+JpK0PU5PV+w+iWGxuNqXo4aKeiXWy7F2HjYbF1IvSyR9JlWY11JcsrFR1YLgnOsfbzoU0+09qj4I8bVjevmkYdyR15dmmKSX0rPahmVdx1qy94wfPf8Ao7hov6fN5v1I1z8E+RUdamZVpW7z38Ri6sou9R+88HH4irr5794xHFX4A4ZoaPGVX7Txcbw7w1hk3GvVl/aNeYVqjcrylb1nzeLqybd5MK247B5PTb8XOb9p49ZYSL81yMK0m3ucNTUI21K1NX5bnNPEWejZrkaZakGyWKl0bMHi5LqzTIwYVv8ALJ9GR4uZzgi43+VPsRPHrrFGmxUgNnjY/YM6dSN9ImqMU0dFKmr7Fg9HBYlwkmqKl7T6jAcS1MMkngk0u4+Yw1NKx6+GgtNysv0Th/wrVcqSoSoc+GvfxUrqz7U+h+mZFx7kWd8sI4lYatL8nW0u+6Wx/PsacHHUsZSozvCTQV/U73Ifmngu4pxGMcsoxdR1LQcqEpO7Vt4+q2q9R+mJaEQRWQ24XllX11t0KM6GCrV9UlGPaz0cPl0KLUpPnl222N1OWiS0NykyKchVTHMy84Q8Wx4vvDkzFt94B012mDjFdSSZrkyqsuVGuU0YvvNUu8IzlVRqlWRhI0zA2SxCNE8Sl1Zrmc9QDZPG262OepmFupoq7HFVbQV1zzTl+sc8875ep59Y8+rswj16uftK9ziq8TuD6nj1TiqxvuB70uLnB3dzD/baH1lc+anTTZh4iHYgPoMTxRlmMg4YrB06kXo7xPm8dgMoryc8vxU8M3+Tqrnj71qviZyw0GtYoweDp9EBrynMcwyPHqVKq6anvZ81Oou9dfmfYYvNMPjaMMbGKo4vSNWMdYVo9vc13ny9PCJpx3T3R2UMFKnbnquSWySsB3uClK8W7P4H0nC9aVNVcHJ3pu9Wn+a/rL27+88DB03OfLbQ+ryfAPD3r1FZuNor7wPTYKQKAgRBQAER2IZEZRiUhQoCkZAAIBSFIBGQyexCikexSbkRkVE6mRVAAQALAooAAIosCAAVIAkW1gCoAAKAAgpAALdo+czngfJs4ryr1KdTD1ZaylQkoqXstY+kshYo+Dxng+4eyrJcfilhquJq0sPOUJV6nMovldmkrK5+IY2mqdWSWyZ/S3Eytwrmj/8A40/kfzbmP46frA5qL1Pfy2VpLQ+fpOzPdy1+cgj7LAPzU9j2KctEeJl/oo9iDVuhRa01bqeLjp6PtPUrS0Z4uOldNp3Cvmsyla/YfOYp3ufQZg7p7I+dxTV3qQedWepyVNTpq2uzlmyI0zNEtzdI1SKrVI1s2Mwe5BiwGCLAq2IVArZBdh00os54HVRWxpHoYZao9WhoeXh9Gj06T0A61OyNc6hhKdjmq17PcI/Q/BbVtxhgNbc03H3xZ+8dD+dvBjiLcX5dr+Xivmf0QgqMywMv4zU/SsRo04Goni6y/PaA+ipvQ3JnLRlojpiBsBjcqYFZiysjYGEnqansbJGt7AYS3NUjYzXII1SNMmbp7miQVpmc9TtN8jRU2A5KpxVkdtVbnFV2YHDUerOKr1OyqcVUI4axxzXU7Kq3OSaCuea7DA2T3MLagSxUgVLvA30IrmSPtqGQYLF5dhqrhKnUlSi3KD306o+Lo+kj9HyvXJsJ/wBJAc2EybC4SSklKbW3MehcNagCke5SdQAAAAhQIAUDF3BWiAEVkAQaIAFAAAA3FiCAADNIoAAAIIoACgRbAAChK7CC3MiAKAAACizCFgFuZAY2dy3KyAAOoKryuKXy8I5m/wCoa+KP5tzPSvP1n9H8XO3CGZf9L/uR/OGZL6aXrIOWjue1l/pLtPFpWTV2kexgalOLV5JFR9jl78xHrwfmnzOFzfB0IrxuIhG3bc7FxVlEF52Np/EK9Ou9GeJjpaNIwxXGGTpNRxkWeFjOLssne1eL9qLo1Y93vdI8HErfQ6MTn+Cqt2rQ/WR5tbMsPO9qsP1kZHLW3ZyzZuq4mi3pVh+scs61L+lh7wMZGmRsdSm/ytP3mtuHSrT95RraMGja+V/lKfvMWk/rw/WINbIZuH58P1hyd8f1kRYxCM/Ft/Z/WQVOV+nvQKygdVHoc8YST2+J00YSvsyo9LDrRHdB2OGg7LsOuMlbcIyqTsjz8RV1OitPQ8zET1KPvPBjVT4ty5t7V4fM/pq1j+W/BnNR4oy93/4iH+ZH9SSfnP1hWEmebl1W+Y4ldlRnpqN2eDllT+VsYv62XzA+zoS81HTFnDQn5qOuEk+pEdC2KjBNdpU0VVZGRzit3Y1yxNGK1qQXraAyka5GueYYRb4mkvXNGiWbYBb4ygv7xfvIjfI1SZzTzrLE9cfh1/eI558QZTHfMcMv7xFV2SNM9jhnxLkyf+8sKv7xGifE+Sf80wv+KgO6Zz1DinxNkv8AzTC/4qNFTibJbf7zwn+KgjrqnDW0OepxLk72zPCf40f3nNPPsrntmGFf97H95BnV2OGr1M55pgJvTG4d/wB7H95oni8LNPlxVB/3sf3gc1XY5aiOmpUpy9GrSl6px/ec8oyl6K5vU7lHNJGCWp1PD1pbUan6rMHh6sd6U1/ZYGqw6mzka3VjBqzA3UPSR+jZRrkuF/Q+9n5zRdpI/QsllzZNhu6L+bCu17kKyAAAEAAFQoBAAARGS2hkR3KIAApYWKQgAAIAAKjIVkA2AFCA2ACgsOpQKQoCAQVilFIARQoAAqWgVmUIgAAFIUKCwARw5zlzzbJcVgYz5JVocqk+jun9x/OXGWBx2U5lLCYWhgpyi2pzlUVRxfvt8D+m72dz8mz3g2nllec54dToyk3Gr0fXXsZVfiapZ1Um+bMaNBdlOP7onRDJq9fWvnuIt15acn82j7THYrKMI3Hnocy0sry+SPKqZvhXdUXH2Un94Hix4aytu+IzTMqn6NCP3yOqnkXC9NfSTzqp6o0Y/NM31KtbEehUnr2U0vvNX4HxlfXx00n22QG2OB4UhG0cvzef6WKpR+VM1VMNw2vRybGv9PMGvlELhvE7yxMv1jGpw5OK87ESftA5K2FyRu8cnkv0sbN/cck8Nlb9HLqUf/sTZ0Vsm5L3m3b848+pgVB7X/tMgTwmCfo4ajH+8k/vNE8Dh3tTor+0/wB5jOnGOnJ+0zVJxX5JfrMIssBR6eLXtf7zB4Cn9uC9pHKP9GvezW6kf6Je9gZvLo/0kPeYvL1/SR95h45f0S/WZHVj/RL9ZhWTy99KkfeT8Hy+3H3k8bH+j/aZPGw/o3+sBl+DpdJR94/B1T7UfeRVYP6sv1jJVIdk/eAWWz7V7zOOXPrUa9TMouLXpVEbI03LarJetAYrAJf8VKPs/wBS+RSj6OMfua+8z8TUt+MT9aLGTh6ai/YBolRxK2xKf9p/ea7YmMrSUKnrZ7OGnltSyr2g+1NnvYDJMuxlnSkqi7ncD3vBRw3i81xVHH4eiqXk9aLn9LGSSTTu1uj+i73bfefmngy4MllOJlmzpOjTnScIX0dS/W3YfpaQgyjoz4nP62Z8PYitVwGCjj8RiZuVKDqKKlf93efa3PBzzKvKMXHG2cuWCi/zbP5alR4WX/8Aqpmi53VyDKab2i26sl7rn0GF4e4xlG+N4yoxfVYfCr77HDDHLCWi6/K+y524fH4nEfilUku21grthwzjpfzni3Mqn6CjA3LhXBv8dm+Z1vXiLGulQx1TWzXrZ0xwOKe7XvAx/wBlcj+vUxlT9LEsf7L8OLehUl668jcsvrveaRmstqW1n8AjlfDnDf8A8FP11ZfvMJZBw2v/AG6k/XKX7zseXTt6XwMHl0vt/ADhlkPDX/KqD9bl+81SyDhr/k+G9z/ed8sDNfWNcsHUX1gPPlw/w1/yXCP+w/3mqXD3DX/I8F/h/wCp6EsLUX1vgaZ0ay2a9wHBPh7htr/ceC/w/wDU5anDPDctPwDgv1H+89GpCuuq9xzzdeP2fcB5dXhHhqX/ALFg/wBV/vOeXB3Dj/8AY8KvUpfvPVnXxEfqx9xonjKy+rEDyqnBHDktsmor1Sl+84q3AGQz2yuEfVUn+892WZVVvCJqeaTtrBP2gfLVvBtlEr8uDcfVVl+85J+DTBJt041oeqtI+xea33h8SfhVdYP3hHxa8HnI/MxWMgvzcQzP/YvMaX4nOMyh6q7Z9l+FodYNFWbUesZBXxb4e4koq9LiDHadJ+cjCWD4wou6zKjXXZWw6+5H3kMzwr3bXribVisJU2nHXtA+QyCtnVfMFhs0wmBjGWkatObp6+3Q/Vcvw0sJgadCTTcFrb1ni4XK44ySahan1l0Po0rbbAQdAyAAAAAAU6gAiAAABgxbKKCFAAAggD1AAEKFRkKwBn1KQqADqUWAAAAZIxW5kUAAAAKQBZlSKERKwAKqggAoAIAKQCHncQ0lW4azOm1dSw1TT2HpJWOTN482S45duHqL9llH8u5lDlrSt2nLSspHZmb+mZxQ9IhXq4Rq6PZoNOKPEwujR7OHeiKjpe2hy17WaOm9kcld7hXlYq2p4+JWux6+Jd7nk4i+oHm1Vqcs0jtqo5KiIOaSNbRukamEamjFmxmLQVgLMpSCJama0IjJAbIbnVS2Ryw6HXR2KNzV0aKp09DnrdSjnivPP0jwYYSGJ4oy2nOKlGVeF0+up+cU9ah+qeCmnfi7Lf8ArJ+5MD+iXqQt9EQCGSdkQjKPlPJqX4dxUbXtVdu4+pwNKEYq0UfNS8ziTGL+sv8ABH1GDl5qIPSppJbG5JGimbkEZ2QsiXKBi0jCUTYzBhWpxRqlBdhvkjXII5pwNM4HTI1SVgOKpTXYctWmuxHfNHNVW4Hm1aSOKtTWp6dZHDWiFeVVpWOOcLHqVkcNRahHDONjU9zoqI55bhWDbuS5kSwEvobqKu0aepvoekEfomWQUMowiX9EjpNWCVsuwy7KUfkbSKXsYsysiMqIACqAAIIAMigAAGPUyIBCoPYiCHUpAFGQrHUACFIIAANhUAAAAAtn2BLqUoW1AAAAEAqSKuwoAhSAAClEKAiAC9CFDqUiKBDRjo8+XYqPbRqL9lm8OKqRcHtLzX7dAP5WzSLVVnDBant8QYV4bMK9GSs6c5Qa9TseKtGQehhd0evQloeLhmerQloUdjldHLW1TN62uaK2zA8vE9Tyq56uI2Z5WIA4Ku5y1Drq7nLU6hHPI0tG6S1NUgrBoxaMmtTFkGLBWhYAjJGJlHoBtp7nXSRywOqkUb+hz1dje9jmqsgxoxvVR+veCSg5cVYBtejJy90Wfl+T4KeLxVkvNjuz9x8FWXKGduqlbxFCT9rtH95R+tMAABa4CA+Wxr8XxRiPzuV/BH0mBleC1PEzqhy5zRr9KkOV+tf6HsYF/RoI9em9Eb42Oak9DoiQbB0IihQwe5mYvqBrka5bG1tmqWxUapGmWxukap7BXPM56h0T3Zz1AOOqjiqrQ7qpw1dmEcNZbnDV2Z31Tgq9hBx1Opzy3Omoc0tyqxsydTIlgDsbsOrzSNR6OU4V4nGU49HJII+8oR5MLRh2QivgZjbQBQjKAMbMGRAiAoAgaKArEFBAAAEJYrIUALFAgKCCAMAACAbQGXcCFSv6gkUICwAUBQEAirtL6igACAQoCgAW4RSFIUAAFVAhQBChkH4B4TMH5FxjmEVpGpNVl6pK/wA7nw9/OZ+o+GWgoZ/hay3q4VX9kmj8tfpAdeHex6lB3SPJw71PVoapFHYtjTWejNq9E0VtgPNxDPMr7s9PEvVnl1+pEcNQ5ah01d2c0wrRJXRqkrG5muQRrZizJmLAxsAwRQySIjJFG2mdVLoctM6qfQI2yasctbbbU6ZPQmFjGpjIc/oxvN+pagexl0/IIU8NFfSztKb7L9D988E+GX4IxmLa1nONNPuSu/mj+esvlKvjHVlq5Suf0p4MYeL4Lpv7dacvkvuLFfXNakMmQCAtg1oEeRxAuXD4er9mrb3p/uOrL5N0496NHEMb5V6qsH8TPK3ehDtA9uk9DpjsjlpPRHREK2ovQxXQpEUxZSPYowZrlsbGa5dhBqkapm2W5qmBzzOep1OiZz1Cjkq9UcNbY7auzOKqBw1upxVdztqnFVCuOpqznkdFQ0T3CMBYpOpBYn0nDVP+UILblhKT9x89SjzVEul9T6bhZc+Oqz/q380FfTMFaIUACkRNyWZkQDEAXKqgAiFgUgEAAEZLGRLFUABEAAwIwBbUKAADba7LawBQ6DoAAKAQLC2oWrKULWKCERQQvQKWLawAAAAxAAUAAAL1FgAADA/KPDVTvLLKtvyc4/tH49L0z9q8NEL5dl0+xzVvcfi0157A30Nz1MO9EeVR3PTw7sEdt9DTVehsT0NNXqB5+JPMrnpYh7nmV9wriqanNNHTUOeeoHOzXJG1mqW5EYSMGZyMGBiwHuAqoyiYoyQG6mdNPoc1M6YbBGctiU3yUa8+rtBe3X7iSehHphI/nTb9ySKr1cljzVYo/pvgCn4vgnA6elzy/aZ/MmSyjTr0+aVuaVj+pOCopcFZW42alR5k+28mQe4GBuELaDoAB52eq+T1n9lxf7SNeUv6JI3Z3b8CYnp5q+aObKH5tiq9+jsjpjoc1LY6I9ANq+JSRsUIWIy9DF7AYs1yNjNctiK1SNUzazTMI0TOeotzoqM56nUo46z3OGqdtbqcVVsK4qpxVdztqnDV6kRy1DmnudE9zRJNsDELqLWCKM6ejfqPqeE1eriJdkEvifLw6n1fCaVsS0+kV8wr6FkKwRAgAAABUZLMyJdooWAQIgAAGpC3IVQAEE1BSXCGxHuV2IyqIpEUCAMWINwAAAFXeUQpbXFgCKQAACoBYoBBCkKUQoAAhQBAUAABYghQUo/N/DFR5slwdbslOH+Vn4jUXns/evC5T5uE6MrejXt74v8Acfg9ZWqP1kGVLdHo0GebSep6FBlHan5qNVV3M09DXVegHn4jqebXPRrnnVgOKZzz3Oioc89wNMjTI2yNciDWzBmbZiUYhAIgpkjFGSA3Q3OiGxzwOiJQkWp/N6H9p/ES2JW0p0F+Zf4sD0sBQeIq03FRTj7FLVaM/qngyk8PwNk1F7wwkE7H8wZCr1Yn9U5BDk4by2PZhqf+Ug9AAFAAAcGdwdTJMVGKV+S+vc0zkyi9k2j0sdHmy7EL+ql8jzso9CPqA9+jsdMdDmo7HTEI2IpijIKpi9ikewGD3MJaI2SNUuwg1yNMjbLqapFGiexzVNjonsc9TZgcdY4au53VTiqkHFWOGrud1XqcNUI5Km5pl6jfU3NL3KrHvIyiwGUEnGzSab2Z9dwrBqliprRScFbs0Z8jFWt2H2fC0f5PrS7aiXwA9q9kS90V6sAYgtiAAAAJYoIJYBgAACgTQpGgAYsCAACiEKLARFAIBCgDaAABUrlsUqAAIoBYoEKgAAACAAKoACACgCFAKJ1KAQAAVHxfhVhzcF3t6NeP+WR+AV19Iz+h/CXDn4Ir91WD+aP56xK+kYVhS3PQovqefT3O6iwOyL0MKr7CweiMajWvUDhxB51Y9Cu9Tz62wRxVLHNM6aurOae4Voka5GyRrkBrMXuZswZBiygvQAjJGJlEDdA6InPDodEQEthWV3SXZTQn6IraVYLsjH5FR7uQR+nif1blceTJsFH7OHpr9lH8r8PRvXif1bhVy4KhHspQX7KINoAKoACDXiVfCVl205fI8nJ/xcPUj2Kq5qNRdsWvgePlD+ip+pFR9BR2OiPQ56J0RCti3MjFbmQAPYpGEa5Gt7m1mqRBrl1NMjbI1SKrnnsznqdTpmrHNU2YRx1ThqndVOKtsQcVXZnDVO6rqcVVIK5Jmlm6otTS9yjEMpGRGyGvKfacNK2Vz76j+SPjKfpR9R9tw6rZQn21JFV6gAANXZj1Mg9EBiDJrsMSIAAATbqUbFVAAQAAAI0UAQFIUAAQRgpGEAQoVvWpSIoAAWAACwFAAQAAAAtgqWFi2BQABEAAUAARQABAXAA+b4/hz8EY381wl+0fzliPTdj+kOO4SnwTj1F2soSfqU0fzli42qtdjKrTT3O2jscUH5x2UgOuLujGo9CxbsY1HpsEcVd7nn1Tvrs4K2wHFV3OWe511NzlmFaZI1s2y2NTIjCRizJmDAjABFVLUyitTFGcdyjbDozojsaIG+PohEn6Iq/zhrssvgSexaj/AIzL1lH0/DSTxVNNrVo/quEeWnCPZFL4H8nZDhp4jMsMoK0eeKld9L//AOH9aNa2IqAWAAABBq6a7U18DxMo9CB7fceHlKtCKd1bTUqvoqOx0ROaidMSI2RMuhEUCkZehiyjFmqRsZrYGuRpmbpbGmYGiZzVOp0z2OarswOOtqzirHbVOKqQcVXS5xVOp21TiqlHLNGlm+ZpaIMbAoYGcF5y9R9xkH+5qbT3lL5nw0Y3mlzNbbH3WRQcMlopq13J/FlV6AKCAAAhdmLMiFGIK+4gUKQpEQFJ1AgLuSwUAAAWA6hEABQAAVAGCDo6gCwBblIUAAAAACFh1KCqAAB0ABEAAUAQttAoBYEAABAAewqvG4wjz8G5ouyg37mmfzfjlbE1P0n8z+l+I4c/C2ZxWt8NP5H815jG2LqX+0wOOKszqpM5ludFPciOqOxhN7li9DGpqVXJWPPrdTvrO5w1QOOpuc09zoqbmie5BokapG2ZrkgjWzBmbMSqxBQAM4mJnEg2wN62Rogbo7BCSu0u1mMnfES/SZktasFb6yMY61m/zmVX2vBtPnzbCx+1Vgv2kf1FL05etn8z8A0/GZ9gIvrXp/5kf0xL0n3sCAAiAAKqx9Jes8TAaVJLsm/me0tzx8IrYiouypL5ge7R2OqO5y0XodMSI29SmKMkVQj2KyMDFmpmyRregGuWxpl1N09jTMg0TOarszpnsctXZlHJWOGqdtU4qoHHVZx1ep2VTjqoiOWZqZulqabAQblMWVW2C+kPvMoX8j4X9C/xPg6Wsz7/AC2KWV4ZW/JoDpAaJciKQAqgAAMnUosBiACAACiMoABkKyEALcAA3oQpCgBYECxLFAHQGAUSxQLACiwIIUAoAAgAttAlcCAuwSKJr2DuLr2hXuAtaxeoBAWw0ta4IULIAANNykLYDiziHjMix8F9bD1F+yz+aMzj/G5+s/p/Fw58DXh9qlNfss/mbN42xcvUvkQeWtzbC5r6s2QKOiOiJNiLJPYDlqnDW6ndWOKqBxVNznnuzoqbnPO5BpZqkbZaGplGElYwtqZshBjYFAAyREZJAbIbG5eimaobG6OsShFfTQXeYUtZ+02Rv42Pdf5GGH9OJEfo3g4hzcVZXHtxMPmf0e9z+e/BfS5+L8r7qyfuTZ/QhVAUlgALYgDY8mirY2uuypL5nrHmLTMcQvz/ALkB69HZHVE5KOyOuOwRsW5kjFdDJBQjKRgYM1yNrNUtgjVI1TNzNMwOeoc1TY6ZnNU2CuSrscVXY7apxVeoHHVOKr1O2qcVUI5Zmp7G6aNTCoTdoyJFecgNlJecfoWCjy4DDrspx+R+fUV5x+iUVy0Ka7IRXwIjYS3ULYO/aVUZCkAAAgAAA1cln2FGtyjEFsQAACARlAEABQABAIXoSwAAAdAsUBCwACgBbbAQJCxbBEKloUALdRbUXG4Ea1KAUACkEBRYDEoAAAoVEUAIklzRce1NH80Z5Dkxsz+mYq8ku0/m3iOm6eZ1IPeMpRfsk0VXz73ZnDcklqZQQG6OxJ9hY7EnsEctZnFVO2qcVUg46pzzOipuc8yjRI1yNslY1yQVraMWZtGLIjEFADqZowRnHoFbYLQ3LRGqmblsESHp37Iv5GOGV6iLH6/6LMsJHmqJXt32A/VvBPFS4vy+26lJ/sSP3yx+CeB/DT/27pVuVqKo1PW7Qdm+3c/eyqAAgDqUBEseZJfylX/SXyR6Z5tROOaVrvfla9xR6tDSKOqJyUPRR1xCtkTJGMTJbERSMpGBgzUza+w1SKNcu40zN0jVMDmn1OeodM+pzVNSDkq7M4avU7qpw1eoHHVOKodtU46hVc0zUzbM1vVkRjYLdGTtcnX2AbKHpH6KvRXqR+e4aHPUjG+rkktO8/Q2tbdhQAsx0IqCxbC2gRAGutgAIAFACgSyYsu0pLFRiCvQhAAAVAUAQABApAAsA9xftKroBWQiAsWwClgAECkAC5ehCgQoBVAUAACBAABQAoEKAEB0AAsfTXrP534vpeLz7GRttXqL9tn9D7O5+Dcd0uTiXMFb/iJv36hXxjWpYoykvOItyIzTMZMqJJso5apx1Tsqs46uwHJU3NEzfM0TIrRI1s2yNUgjBsxktTJoxeoEJYoCi3Ni3sYJGaCNsDb0NUGbL6ARehVf5v3meCX0i9Zh+Rq+z5m3Ar6Veso/ZvA/TvxNzfZw1R/JH7Sfj3gap3zrET7MLL/NE/YQAAIKQAAefilbMm+2EfvPQucOLX8oRfbBfNlV34d+ajsicWG9BHZEiNq3MkYx3MwBi7FIwMXuzXKyNjNcijXLY0yN0jRMg0T2OeodM+pzVCjjq7M4avU7qvU4aoHHVOOodlQ5KhFc0tzWzZPc1sIg7fUB2gdeXR5sbRXbUivij79+kz4TKI82Z4Zf1kfmfdsqgAuRBAly9ADI+4XIUOhCgioUC4QAuQoWJfQpLBUABAALcIgYIyqAAgIWW4RQjf6y2ASCgKAIWwAAAFAAAACgCFsLXAgLYWAgKlqWwEsxa5kAMbMWZklZADDqUugAlj8T8ItLl4px+lr1U/fFH7cfjnhLp8vE2Kf2lTl+yB+c1FaTMEbqsdWaQKSRTGQHPUOOodlR3RyVNgOSors56isdM9Tnn1A0S0NUjbLc1S2AxZizIxYEFgCDJbmS3MUZR3CNkdjYYRMyqn5Cd/tI6MvV6i9Zzv8Am775/cdmWL6RAfuHgZp/x3MJ/Zw6Xvmj9ZPzDwN07QzKdvydOP7T/cfp4D2AAggKCiHFjNMXS74P5ncceN0r0H3SXyA6sNrFHbE4sN6J2wCNsTLoYxMkFCMoYGDNcjYzXLYg1zNEzdLc1TKjnm9DmqHRM56gVyVepw1Tuq9Tiq9QOKqctRnVUOSoRHPM1vU2S3NbKrGw6MysS1l7QPTyKPNm2G/Tv8D7Y+O4djfN6Pdd/Bn2IQIygCAoCoQoAhdwQgEMkAMQZWJoUQAAGiWfYUEGIMrIll2FEAAAhQQQoFgOkGW/QWXYBiWxbLsBRLCxQQSxbIoKJaxRbQtiDEpbd5LAQF5RZlEBUi9SDEtrmVkAjEmplYW0KJqDIWuFY26kMrdBygQ/JvCfT/l6c/tUab+4/W7I/LvCjC+awdv+Gj/mYH5XWXnM5zrrx1ZzNagYmM2ZGMgOeoclQ66mxyVSDlqHPPqdMzmqFGmSNMjdI1MDB+oljJmJAsOUoCIZrpoYmUSq2xMmYwM3uRGM/wCbrvmzvypfSI4aulCHrbO3LZqneT+qmyj+g/A/TtleYz7ZUo/CTP0Q/PfAxOdXhfH1Z2u8VyKy6Rj/AKn6GRUA3BQAKQQ5cd+Rf5zXwOo5cf6FL9P7gjow3oHZTOLCvzTtgVW6JkjGJkAD2KRkGDNbNkjBlRqkaZm6ZpmFc83qc1XqdMkc9RBHHUOKr1O6rucNXqQcdTc5Kh1VDlmVXNIw6myZgBPYN17SjZL1hHs8NRvm0H2Qk/gfWny3Cy5sylJbKlL5o+qtqBAWwsFQCwACwARLEMjFhVRSLYoEFiggjVyWZkAjH2kMrEsVUKLACNEtoZADCwMybBGIK0QiuywSMuoCMUrlsWwCpZFBbAQDQFQAAwALAAAAoA9AiIFHsAEBbCwVAUBEBSMoH534T6V62EmlrKhNe6X+p+iHxHhJpKWFwM7f0kfgmFfjGJi1JnHPc9DFLzmcE9wNZjPYyMZMiOeozlqHVUOWZRyz3OeZ01Dnn1CtEka5GyW5rZEYEsZNGLAgsNugAGaWxitzNIKzibGYR2MmEKq+horub+J6WUU1KSTVzzq3o0V+aexk0LzjYD+hvBVRVHg+pypJSxEnp3Rij7U+X8HFHxXBdH8+tUfxS+4+psUQpbCxBBYdRbUAcuPX8Xi+yaOpqxz46N8I+6SfxAywux3QfacGEvY74W6gbomZhHYyTAoYAGtmDNjNcijVI0y6m+RpmBzTOeodE9znq9QOOp1OKr1O2ocVVkHHVRyTOupuctQqueaNdjbPUw0IjEyXQlirdAfRcLxXlFeVtVTS+P8AofSHgcLR0xMu6K+Z79igC2FiKhLIysQIjQtoUAY2BkLIqsSlsgEQCwIFhYDdgQFAVBoykCJZCyMiMDFoWZkTcqoTcyshZAdlrk5TOxLMiJsC2FtAJYWMrCwEIZNEsUQWLYoViClsBB7CixEQhlYWAxBbCxVQpbCxEQhlYWAhDKxLd4VLHyXhCpc2U4SX2azXvj/ofXWPnOOafNw7GX2K8X8GUfhWLjZyPMqLVns4+Nqk/WzyKq1sQaGYSNjNbKNFQ5ah1VDlqAc1Q55dTomaJ7sDS0apG2RrlsRGtsxepnIwKIUWBBUZxMEZLYDbHYrepIiWwGdfSpTXZBHv5BDmqw9Z4OJ/nSXYkvgfS8OxvVg+8qv6S4Jo+K4NwKt6SlP3yZ7tjzuGKfi+E8si/wD48W/bd/eenYDGw1MhYIxGpRa4ENOLV8JU9V/idHKa8RG+GqL81hWjC7HfA4ML0O6AG+LMlsYRdzNBFuQAKwluYS3M3uYSCNcjTNm6WppmQc0zmqPc6ZnNU6lHJV6nHUOyotTjq9Qrjqo5ZnVVOWehEaJGt3Nkupre4EMktV6idpnHWRVfU8LwthcRLtml8D3LHlcNwtlk5faqP5I9axBLAthYIliGQ9pRjqRmRAqdSltoCCWFmUBEsR3uZe0e0oxBRYKgMmgkRGILYWAliFsLahUsCgCWIZEsB3WFjKxLAY2FjKzLYDHlJYzsLaFGFhbQzsLAYWFjNIWAxsDK2mwsQYpAysiWKJYIti2AxI0Z2JYDGxbGViWCMbDlMrCwVjZCyMrWFgJbQ8LjGDnwviPzZQl8f9T37I8riaHPwzjl2U7+5oI/A8zjavVXZJnh1lqfRZtG2Kres8CstWFcr3NcjY9zXIDnqHNUOqp1OaYHNM55nRUNEwNEka2bWamQYPcx6mTMWUQL1AyQBGSRijOJBnEPcR6GUUnUiu1ooyr3eNl3Ox9Vw7Hz4adT5aprjp/pH1vD8oQlHmkk+l2Ef1BlFJUsiwFNL0cPTX7KOqxjhoeLwdGH2KcY690UjMipZWFjIhRjYWMgBNewxqRvRn+i/kZhq6a7UEcGE2XqO+BwYR+bE74bEVujsZIxjsZXKKAAMWa231NjRrkEa5aGmZukaJhXPM5qh01Nznq7gclTc4qvU7Km7OOp1A5Ki3OWZ1VNjlnsRGiW5ra1NkkYdSqxZsgvPZjubKf4x+sD7Th+HLk8H2ykz0WjkyWNsmw9uqb+LO2xBjYWMrEKMbC2hlZIWAxsLGVhYgxtYGViWQGNhYyshZFGNhYthygY27gZWHKQQhlYgRAWwsVUBbIWIILXLyscoGLFivQAejZk5TMBGNhbuKUKwLYyJYolhYpbEGIsZWRAjFq4sZWFl2AY2SFjK2uwsVWNtBYy5e8WIiEsZcveOXvAwsOUy5RYKxsOUyBRjYWZSkRhY4M9oSxGQ4ynF2fim/XbW3wPSNeIh4zDVYdJQkvgwP57zqP8bqPtt8j5vELzmj6nPFau9N4o+YxK1ZVcMtzVI3S3NUgNEzmqHTM5pkRzTNE1c3zNM9CjQzWzazWyK1vQm5lJGIRLBF0FtQIjKO5DJIqtkTZRV8TSX5yMIrQ3YVXxtL9IIxacsXJpfWZ9Zw/hqmIzPBU4rzfGxbl2a2+9ny1Lzq7fefoHAuGdfP8AL4JN81emv2kQf0ta2nRaArWr9ZbAQhlYcpVY2YsZNakIjGxUtS6BblHm4ZcunY7HfDQ4oq1ea7JP5nbAK3QM0YxMl6wKACIxexqkjYYS2KrVI0T3N8jTMg56i1OaodMzmqdQjkqbnHVOyrucdXqUclQ5ZnVV0ZyzQVpl6zBozluYsDHqvWZQ86T6K5EvORaW9wj77KKbpZPhYtWfJe3ZfU7GrmGHjy4SjHspx+RmBLCxQFY2FjKwsRGIsZW7w0BiCgKhDIWQGNhYysLBEsSxl0IBAUBWOpSixRi1cW7zKxCIjRNTInUKlmxYyAR6FhZGXUliqlkLFsxYglhYtgBLC3cUBEsCgCbkMiWCoNDKy7CWCI7AthYogGwIoLC4AAo07AiEsUFEsEr6duhQt16yD8C4kpeLxcovpePubPksQtWfc8Z0fF5riF2VJr9o+HxG7ZRwT3ZpkbpmmTA55nPUOmfU5qhFc8zRI3zNEgNMt7mtm2RrYRg9jGxkzECCzKAokZpGKMohGa2N+E/ncX2Jv4GlbG7CJPESfZCT+AFwyvWXrP1TwY0HV4qyxLW1ZP3Js/LML+MR+weCOlz8XYJ9IKcvdFlH7xbQhnbQliDEpQBAABPYCiwV50/NxdX9I6qfQ56ytjJ99n8DohsgN8NzNbmETNbhFAIwMTCW5mYS3KrVLtNUzbI1TIjnmjlqbs6pvuOWpuwOSruziqHbVOOp1KOSoc09zqqHNMDRLqYvYzl1NbIIvSubMOrzS7dDV19h05fHmxdGO95xXxKP0W3KkuxWJYyl6TIFYlLYWQEAsLERBcAAAAqksAELEaKAJbQhk9SdCqhSFuELELcgAEuLkFZBcgVQS6Qv3FHqNak1MiATUFLYDEGVu4jRBGBYNWKILFsQBYWBSCAAoAgAoAAEtcoIiWDKCqxsxbQoAxKWyFtCD8a8IFHlzvF9njpP3q5+eYtWbP0/wjUlHOsS7byjL3xR+ZYtWbKPMmaJbm+oc8gNM2c09jpmc89gOea1NEjomaJkGqRrZska5FRgzDqzNmLWoVC2AAqRkkQq2REZrY3YXR1n2U2aVsbqGlKu/wA1L4lVlhF9Ij9r8DdG/EkZ9YUKj+FvvPxbB/jF6z918CtPmzXFVLehhnr65RA/YyGRCCAosBBYbAoWJYvUAcOKXLik+2KNsOhhjF9PB9sfvM4bIDfE2LY1xM1sBQB0AxMJaGbMJAapGqZukaZkRz1NWctQ6ZnNUKrkqnHVVztqnFU3A5amhzTOmp1OaZBpZgzN7mDKNbe/qO/JI+MzfDQ7akTglsz0+G0pZ5hu6TfuTCPvd2QqatsAoCXt3kuRAC5CqtxftJoRsCgl9BcgoMbkuEZXBjcNlVbtgw5uwcwGYMVIjkRGTaFzBslwrNsjbMW/YL95RldC5jp2k5raBGVyXJzEvqRXt2FgUDGwKAIC2IUQFIAFrlFgJYlmZEAmpLGQAxIZW1JYAACAAABCgogMtiWAAAiPy/wlQ/lOo+2nTfwsflON3Z+ueEuP8ek/6iD+LPyTG6NlV5VS1znludFXdnPIDTM55nRNHPMDRM0T2N8zRMI1SNcjZI1sKxtoYmbMWQSxbAoBFQKiimynJLDVr6XsjAq/m0++SA6MD+NXrP37wJwXjsxlbajBftH4DgH9Ij+gvAkvNzJ/1dP/ADMiP1foQyJYKgAKBCslgKQpAOTGr6Sn6mZU9iY306XtLT0QG+JmtjCJmtgKCkZBOhrkbHojWyjXLqaJ7G+RomBz1NTmqHVUOWoBy1dTjq7nZV2OSoRHHURzTOqpscsyjVLc1s2S3NcgrVLZnrcLRvndN/ZjJ/A8ebsj1+FZfyyv+nII+6TRL6mrmJzEG3mI5d5r5ic1yq2cy7S8yNLkhzAbeZE5ka+YjkEbHIXujVzBzCtt9Q5I083eOYDZzC5r5kTnA2XCloaucnPqQbubcjkaucnOUbea45jTzjnA28yHNY0845yDdzE5jTzk5yo3OXaOZGh1NieMCvpwUhABSBAFIAJYyAGILp1FtAuoyFIUAAAAKERq5HEoAxBkLBWIAAF6EKRAguAPzfwk649//wBaPzZ+R423Mz9e8JCvmCXbhvvZ+RY1ecyjyai3Oae501TmkQaZo55nRNnPMDRUepombpmqQGlowaNjMGFYCxSBEaFiiwBbmSItCoCh/iGvzimub+j9oHRgpWqL1n9D+A/XD5k768lP5s/nPCytUXrP6H8BUv4pmf6NP5yA/XCC5OZBVZLMxcyOSKM9R62YOZOe+5EZkbMOYx5tQNWLd5U/aWm9DViZXqU/abKWwHTDYzRhDY2JAXqR7FI9QI1oYS0M2zCWoGmRpmb5bGiYHPUOaodUzlqblHLV2OSrsddV3OSoByVNmc0zpqdTmmFaZGuextmaJ7ERoqM9fhRpZs/+nL7jxKsrM9PhepbN2/6uX3AfcOaRi6mpyut3mPjddyjr8ZqOc4/HDxy7QOt1B4zvOPxy7R47vA63PvJ4zvOTx67SePXaB2OoY+M7zk8f3k8eB2eM7x4w4/Honj0B2eMHP3nD47vL45dpB1up3jxhxeO03RPHIo7XUJ404/HEdddoV2+M1I6necfj+8jrd5EdnjR4zTQ4nWQ8eijrdTXcOocjrIjrIDr8YTxnecnjrk8cFfeAAgAAAUEApCkCAuAFQFZCiAAIAAAAAoACCNXIZEYRACAUgKVX554R4XzGj34dr4s/IcctWfsXhEjfMsL30Gviz8ezB2k9APHrWRyT2Omszkm9QjXM55vQ3TZpqBWiZpZukjU9yDVI1s2S3MJLqEYiw6gCFBbBUKgyAVs1VGrJGbZonLVBGzDytUR/QvgJn/Es0fYqS/zH860pWqI/ePAfj40cBmylJLWlb9oo/bPG95PHI8OWa01vNe81vN6VvTQV7zrLtMXXR4Tzelb00YPN6f20Ee949dpPHLtPAlm9P7SMHnFNfWQH0Pj12mLrnzzzeH20T8LQf1l7wr3alXmqw9p1UX2Hz+DxscTiUk72R7+H6XIjtiZo1xM0BkQAKjNctzZI1vvKNcjRM3y7DRMiNEzlqbnTNXTOaoUclQ5amh1Ve05KoHLUOaXU6KhomBpmc8+pvmc9RkHFXdmzp4ercmaSbf5OX3HFiJWmzVl2I8Xj27281/cUfcPFrtMfKu8+f8tfaZLG94V7vlWu48qXaeH5Z3k8sXaEe55Uu0eUrtPC8s7x5Z2sD2/Ku8jxXeeKsZ3l8r6XA9jyrvHlXeeP5X3jyrvA9fynvHlPeeR5VpuTytdoHr+U948p7zyPKe8eU94HreUd48p7zyfKu8nlK7QPW8oXaXyhHk+ULtHlF9gPV8oQ8oXaeV49mSqsD0vKF2h4nvPOU2zK7A7vKCPEX6nIk2zNRZVdDrvTUeO7zVytmSgRH6h3AfMhFAAAAAAAFAAALWDYZLgCAAAAAABAAAAm7KR6lEIWwAAAg+F8IUf49gn/AFb/AMx+M5npUkuxn7X4RqM1QwWKjFuEW6cn2Nu6+8/Es0f8YqfpP5mh4tfc5Zas6a+5zNERqmaZm6ZpkFaJGqRtmapEGqRg9jORjYox6ERR0AhSWMiCEKYtgYyZzTdpm6T0OSrK02UZxl52h+jeD3FV6GHxviqkoXcL267n5nGd56H6ZwPh5UMqnUnpKtJNLuWxB9g8xxj/AC8zFY7FX1rSNMVdm1U+pUbFjcTb8bIyjjsT1qSNXiyqmwrd5ZXf5SRPLK/9IyRoylsrm2OCqy2gyjX5ZiE/TZksdXt+MZvjlVee0GbIZJXe6CPY4NxE62ZVlOTdoJ/E/Q6GyPzzh/CzyvM1UqaQnHkb7D9Cwz5oxtqRXbHYzW5hEzW4FDAAkjWzN7GDA1zZzzN8jRMI0T6nLU6nTM5phXLU2OSoddRHJU1QHJUdjmkzoq7nJUdmEa5s5qktDZOocdaroFcOLq2lM8pV5qu3BtPuNuOxCUpa9TzaGJTryd+gR6ixVb+kkZ+VVvts5IzubEwOlYqq/rsyWIrfbZzxMrgb/KKv2mTymqn6RrKoSfRiDPymr9plWJq/aIqFR7QZsjgq0tosqsfKavaXymr2m+OW1Xumb4ZTN73Iji8oqdo8fVex6sMnfYdEMn/NCvD8dW6XM4zrs96GUpfVN8crS+qB86lXfQ2xp1mfRRyxfZNiy9L6oR8/GjUtsbY4ep2HvrAJdDNYFdgHhLDz7DbHDyR7awfcZrBrsCvFWHl2GyNCR7Cwq7DLyW3QDyVQl2GxUWen5N3GSw/cB5iovsMlSPS8nv0Hk/cB9qyApEQABQAAAAA+QaF+4doRGQpCqAAAAAgACAARhS90QAoAAiAAA58ZhaONwlTD4inGpSqK0oy6n5VxX4LcRKpUxGUt1oS87xTfnr1dp+uMj6FV/K2ZZBj8BVlTxNCpRmt41IuL+J49WhVg/OpyS7bH9f1aVLEUvF16UK0Ps1IqS9zPBx/AXC2YtuvkuGjJ7yo81J/stAfypOSTdzTOcXsz+j8b4FOFsVd0quZ4Zv7GJU17pxfzPBxP8HzATd8PxFi4Lsq4SnP4poI/CJM1SP2iv/B2xbv4jifDf3mBkvlM4an8HfP1+Kz/ACmf6VGrH95B+Qtaksfqs/4PfFq9DNMkl65VV/2ml/wfOM/+YZH/AIlT/wASq/L+Ulj9SX8HnjF+lmuSx9Uqj/7TOP8ABz4pm/pM/wAqgvzYVH9xB+UvYjdtbn69D+DTm839NxVhY/oYab+bR10v4MsP+I4pry/6eGS+cgPxKdeEd5HPPF0l9a/qP6Dw/wDBo4fpyviM2zLEdy5Ifcz2sH4A+C8JZvA1sQ11rVpP4KxR/LvlEqslGEZP1K7OzC8PZtmFROng5xi/rTXKj+uMD4NOG8ussNlGGp2/NuetT4ay+ikqeEpRt2QQR/LWT+D6sqkamIhUryWvJGD5f9T9By/h7HQpqMcJOK71Y/allFGPo0or2Gay6EdoID8rw/DOOnvBR9Z6FLhLEP05e5H6OsFFbRMlhY9gV8DT4QS9JtnTT4WpR+ofbeTLsL5MuwI+Sp8PUo2tBe466eSwj9Re4+j8n7iqjpsB4UcpgreabFlcF9U9pUiqkQeOsrg9HFWNlLB18Kl5NU0X1J6r2PdHq+KsVQ7ijhjmFSl/OMLVgvtRXPH4a/A30sxwdbSGIpt9nMr+46eRXMauGo11atRp1V+fFS+YGfjIWvd2J4yDekl7zklkuAveGH8U+2lOVP5M1yya34rH46n/AHkZ/wCaLIO/mVtzCT03POeU49ehm8v7zDQl8mjCWXZzH0cxwcv08NNfKZR3zte5omzilguINbVcrn2X8bH95png+JelLKZf39Vf9gV11DmqNXOSpg+KumFyl/8A2qn/AIHNPL+L5bYbJV68VVf/AGBHVUZy1Njmlk/Gk3p+AafrnWl9yNcuGeNaq1zbJKC/NwtWfzkgLVOGtJK+ptnwHxXiH9NxfQpL+oy9L5yZpl4JsVif57xhm1VPdU4wpL4IivKxmPw9CLlUrRgl1bPk8142yrDNwjio1Z7ctPzn8D76PgN4blLmxVfH42XV18Q2vcelhPBVw1gUlQy+mrFR+GzzXM82qyeGw06MJPSdXTT1HtZTlOIpUndVK1SbvKVnqftuH4PyrDNOng6a/snfDJsNT9GlFLuRFfkNDKMdPbDz9qsdlPh/Hz1dPlP1dZdSX1UZLA019Uo/MaXDGKl6Tt7DrpcKy+s2z9E8jh9n4GSwkewD4WlwxGO8Tqp8Pwj9RH2Hksewvk8ewiPloZJFL0V7jdHKIr6q9x9J5OuweIXYUfPxytdYmyOWxX1Ue54ldUXxK7ArxfwfFfVRksEl0PY8Sh4ldgHlLBJdDJYRdh6firDxYR5qw3cZeTXPR8WTxZBwLDJLYvk6R3eLHi12FVw+TrsRfEdx2+Lt0HJpsEcXiO4viO47OQcncByKi+weJ7jq5ByAcvih4nuOrk7hyBXtFIUggAAAAALFARGQNkKAACgAIgUg6FAAACNIpiFAARAAAAAAAAEsLaFAGNmkQzMXuUQoBAAHQAAAAIAKQoCgACBLFACxLFuLlUsLFBES3cOUtyXAlhbsMrgDG3cW1yjYKWDQARLAXBQIUASwsUEGFicpm0QDDk7iOJmCjCxOUz0FgrW46k5Da0QiNfIORGwWQGvkROQ2WQsuwK1qKQ5TY43HKEa+Ucps5SONijW4l5TK3cArDlHKZ2AGDiOUzsLERhb1Et3Gzl9ROUDCy7BYzFgrCwsZ2JoBhyjlM7CyCNfKXlM7CxRr5RymywsFa+X1DlM7FsB6AAIAAAFIAAbDdjEqAACgAIAAAAAoBuw2MXuAbuACAAQCkBSgACAAAgATUKpGNfaG+hRHboB1BABAEAAVQAAUAEAgBUAAFCkKQACMItyAFUuUhQBSAiLchAFUgBQKQpAJcpj1CBACqAEAAAgpGuoBRNmBcAAOgAAAiAAKoAABLFIQLEZSPUAQAodSkABaDchSBYcqIALZEsAULCwKQSwKRgd4AAAC9gA6hmJRWQAAACAAAABGUXoS5NQAYAIgAAoAEUQoAAAEAAgAbDoL6FEbIUEAhSAAAUAAyAUEuEAQoAEBVUC4uQCkAAAFAAAUAEAhSFAAAAUl9SALkv2ABcgBQAAEYAIAAABk1BRCgAAAQAAUAAAABAFgAJYmvQXF9SgQoIBCkuERgAKAAoAFIAIALcEHeB3gbEuAuLkBQAAQABAAF7AARsNlVGACAALhAAAAB1CgAAAAIAACDQPa5GFGyFAQAAAhSBQbAMIDoAAuCAAAUKgKQCggAC4IUW5bmICMri+pOoILcX0MQBlftD2MQFZbC5AEW9tiAACABQAACFARAAAAIFAAEAAAAAAABQABAC4uAJ7QHsBiwgABSAAAAICkChQAgAAICkuFGQFA7gAFB0FyFQABAKQknoBbkbIAgOoAUKQoEAAQAAUAAAABAAjYVSXXaS5CigAiABAKQC4UA7yAXoAAgCAKAAAAUCMAAqXAAAAAUhRcCFIAgAAoAUCFBAikAAADYKEACAAAAC4VAAAAAQAAAABQAmwRWQvQgAAjZVLhvREBAAAQAAEKQoVCgBAAAACBQAACAAd5CgCAMX0KBLkFyCt3IGAAAAWBSAUnQAAOgAAAFAAEAEuLgRu5ACgUhSACACkAYAncAAKQAAAAAAUBC9AgCdCgCBgALAFAFIQALgIAAqgAIAAAAAABchRSAEAAAAACIB0AAAAAAAAAAABDYlyvYxuFVPtJfVsABdsAACFAAhSACFBRACkAAgFIAADIAAAAAADuTsic2o6kAXAAAAAAB0AAAAAAAFyBC4uAFBclx1CLcjYAUIAAKABCkHQAHsQFAAEAAlwKAAoBcbgS5SbMMIbAgCKCPYoUAAANi5Ai3IAAFwAoAAKmCAC3FyAC3IAAAAAAAAAABAAAuAAAuAuS4AC5bmLYTtuEW+oT1MQBb33BAFUE9ouAFwAgLkAVQQoEBSXQFAFwIUEAC4ZAKQAAAAAFxcD/2Q==" alt="Akku Fuel Bottle" class="w-16 h-20 rounded-xl object-cover shrink-0 bg-neutral-200 dark:bg-neutral-800" />
          <div class="flex-1 min-w-0">
            <div class="flex items-start justify-between gap-2">
              <h5 class="text-xs font-bold uppercase tracking-wide truncate">AKKU FUEL BOTTLE</h5>
              <div class="text-right shrink-0">
                <div class="text-xs font-bold">₹399</div>
                <div class="text-[10px] text-red-500 line-through">₹450</div>
              </div>
            </div>
            <p class="text-[11px] text-neutral-500 mt-0.5">Monochrome 750ml BPA-Free Shaker</p>
            <button id="upsellAddBottleBtn" class="mt-2.5 w-full py-2 rounded-lg bg-neutral-200/80 dark:bg-neutral-800 hover:bg-black hover:text-white dark:hover:bg-white dark:hover:text-black text-[11px] font-bold uppercase tracking-wider transition">
              + ADD TO BAG
            </button>
          </div>
        </div>
      </div>

      <!-- RECENTLY VIEWED (Core Akku Sweats - Iron Grey ₹1,499 with S M L XL pills) -->
      <div class="pt-4 border-t border-neutral-200 dark:border-neutral-800">
        <h4 class="text-[11px] font-bold uppercase tracking-[0.16em] text-neutral-400 mb-3">RECENTLY VIEWED</h4>
        <div id="recentlyViewedCartCard" class="p-3.5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800 flex items-start gap-3.5">
          <!-- Rendered by JS -->
        </div>
      </div>
    </div>

    <!-- Bottom Cart Subtotal & Checkout Button -->
    <div class="p-5 border-t border-neutral-200 dark:border-neutral-800 bg-white dark:bg-[#0b0b0b]">
      <div class="flex items-baseline justify-between mb-3">
        <span class="text-sm font-medium">Subtotal* :</span>
        <span id="cartSubtotalText" class="text-xl font-bold tracking-tight">₹1,099.00</span>
      </div>
      <button id="openCheckoutModalBtn" class="w-full py-4 rounded-xl bg-black text-white dark:bg-white dark:text-black font-bold text-xs uppercase tracking-[0.18em] flex items-center justify-center gap-2.5 hover:opacity-90 transition shadow-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        <span>CHECKOUT SECURELY</span>
      </button>
    </div>
  </aside>

  <!-- ==========================================
       PRODUCT DETAIL MODAL (Matches Screenshot 10: <- Back, Trending badge, Thumbnails, Size selector)
       ========================================== -->
  <div id="productDetailModal" class="fixed inset-0 z-50 bg-white dark:bg-[#070707] overflow-y-auto hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 py-6">
      <!-- Top Back Bar -->
      <div class="flex items-center justify-between pb-4 mb-6 border-b border-neutral-200 dark:border-neutral-800">
        <button id="closeProductDetailBtn" class="inline-flex items-center gap-2 text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-black dark:hover:text-white transition">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7"/></svg>
          <span>Back</span>
        </button>
        <div class="flex items-center gap-2">
          <span class="font-display text-xl font-bold uppercase">AKKU<sup class="text-[9px]">TM</sup></span>
        </div>
        <button id="pdpOpenCartBtn" class="text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full border border-neutral-200 dark:border-neutral-800">
          View Bag
        </button>
      </div>

      <!-- Product Detail Content Grid -->
      <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
        <!-- Image Gallery Column -->
        <div class="md:col-span-6">
          <div class="relative aspect-[3/4] rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">
            <img id="pdpMainImg" src="data:image/jpeg;base64,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" alt="Product detail" class="w-full h-full object-cover" />
            
            <!-- Share & Wishlist Floating Buttons (Top Right like Screenshot 10) -->
            <div class="absolute top-3.5 right-3.5 flex items-center gap-2">
              <button id="pdpShareBtn" class="w-9 h-9 rounded-xl bg-black/25 hover:bg-black/45 backdrop-blur-md text-white flex items-center justify-center transition" aria-label="Share product">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path stroke-linecap="round" d="M8.59 13.51l6.83 3.98M15.41 6.51l-6.82 3.98"/></svg>
              </button>
              <button id="pdpWishBtn" class="w-9 h-9 rounded-xl bg-black/25 hover:bg-black/45 backdrop-blur-md text-white flex items-center justify-center transition" aria-label="Save to wishlist">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
              </button>
            </div>

            <!-- Trending This Week Pill (Bottom Center like Screenshot 10) -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 px-4 py-1.5 rounded-full bg-white text-black text-xs font-bold shadow-lg flex items-center gap-1.5 whitespace-nowrap">
              <span>⚡</span>
              <span>Trending this week</span>
            </div>
          </div>

          <!-- Thumbnail Strip below image -->
          <div id="pdpThumbnails" class="flex items-center gap-3 mt-4">
            <!-- Rendered by JS -->
          </div>
        </div>

        <!-- Product Info & Controls Column -->
        <div class="md:col-span-6 space-y-6">
          <div class="flex items-start justify-between gap-4 border-b border-neutral-200 dark:border-neutral-800 pb-5">
            <div>
              <span id="pdpCategory" class="text-xs font-bold uppercase tracking-[0.18em] text-neutral-400">Men's Collection</span>
              <h2 id="pdpTitle" class="text-xl sm:text-2xl font-bold mt-1">Core Akku Sweats - Iron Grey</h2>
            </div>
            <div class="text-right">
              <div id="pdpPrice" class="text-xl sm:text-2xl font-bold">₹1,499</div>
              <div id="pdpOldPrice" class="text-xs text-red-500 line-through"></div>
            </div>
          </div>

          <p id="pdpDescription" class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">
            Engineered with heavyweight 380 GSM brushed cotton fleece for structured drape and all-season training comfort. Features deep zippered pockets and custom monochrome drawcords.
          </p>

          <div>
            <div class="flex items-center justify-between mb-2.5">
              <span class="text-xs font-bold uppercase tracking-wider">Choose Size</span>
              <button id="pdpSizeGuideBtn" class="text-xs underline text-neutral-500 hover:text-black dark:hover:text-white">Size Guide</button>
            </div>
            <div id="pdpSizes" class="grid grid-cols-6 gap-2">
              <!-- Rendered by JS -->
            </div>
            <p id="pdpModelInfo" class="text-xs text-neutral-500 mt-3"></p>
          </div>

          <div class="pt-2 space-y-3">
            <button id="pdpAddToBagBtn" class="w-full py-4 rounded-xl bg-black text-white dark:bg-white dark:text-black font-bold text-xs uppercase tracking-[0.18em] hover:opacity-90 transition">
              Add to Bag
            </button>
            <div class="grid grid-cols-2 gap-3 text-xs text-neutral-500 pt-2">
              <div class="p-3 rounded-xl bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">⚡ Same-Day Dispatch on orders before 4 PM</div>
              <div class="p-3 rounded-xl bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">↺ 7-Day Easy Size Exchange</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ==========================================
       CHECKOUT MODAL (Matches Screenshot 8 Bag & Payment Card UI + Online ₹100 Discount)
       ========================================== -->
  <div id="checkoutModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white dark:bg-[#111111] text-black dark:text-white w-full max-w-md rounded-3xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
      <div class="flex items-center justify-between pb-4 border-b border-neutral-200 dark:border-neutral-800">
        <h3 class="font-display text-xl font-bold uppercase tracking-tight">Express Checkout</h3>
        <button id="closeCheckoutModalBtn" class="w-8 h-8 rounded-full bg-neutral-100 dark:bg-neutral-900 flex items-center justify-center">✕</button>
      </div>

      <form id="checkoutForm" class="mt-5 space-y-4">
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider mb-1.5">Full Name &amp; Shipping Address</label>
          <input type="text" required value="Arjun Varma — Panampilly Nagar, Kochi 682036" class="w-full px-3.5 py-2.5 rounded-xl text-xs bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 focus:outline-none" />
        </div>

        <!-- Payment Method Selector (Matches Screenshot 8 Mastercard + Online ₹100 Save) -->
        <div>
          <label class="block text-xs font-bold uppercase tracking-wider mb-1.5">Shipping &amp; Payment Method</label>
          <div class="space-y-2">
            <label class="flex items-center justify-between p-3.5 rounded-2xl border border-black dark:border-white bg-neutral-50 dark:bg-neutral-900 cursor-pointer">
              <div class="flex items-center gap-3">
                <input type="radio" name="payMethod" value="online" checked class="accent-black dark:accent-white" />
                <div class="flex items-center gap-2">
                  <span class="inline-flex">
                    <span class="w-4 h-4 rounded-full bg-red-500 inline-block"></span>
                    <span class="w-4 h-4 rounded-full bg-amber-400 -ml-2 inline-block opacity-90"></span>
                  </span>
                  <span class="text-xs font-semibold">**** **** **** 5214 / UPI</span>
                </div>
              </div>
              <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-black text-white dark:bg-white dark:text-black">SAVE ₹100</span>
            </label>

            <label class="flex items-center justify-between p-3.5 rounded-2xl border border-neutral-200 dark:border-neutral-800 cursor-pointer">
              <div class="flex items-center gap-3">
                <input type="radio" name="payMethod" value="cod" class="accent-black dark:accent-white" />
                <span class="text-xs font-medium">Cash on Delivery (Standard)</span>
              </div>
              <span class="text-[10px] text-neutral-400">No discount</span>
            </label>
          </div>
        </div>

        <!-- Order Summary Breakdown -->
        <div class="p-4 rounded-2xl bg-neutral-50 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 space-y-2 text-xs">
          <div class="flex justify-between">
            <span id="checkoutItemsCount" class="text-neutral-500">Total (1 item)</span>
            <span id="checkoutRawSubtotal" class="font-semibold">₹1,099.00</span>
          </div>
          <div class="flex justify-between">
            <span class="text-neutral-500">Shipping Fee</span>
            <span class="font-semibold">₹0.00 (Free)</span>
          </div>
          <div id="checkoutDiscountRow" class="flex justify-between text-emerald-600 dark:text-emerald-400">
            <span>Prepaid Online Discount</span>
            <span class="font-bold">-₹100.00</span>
          </div>
          <div class="pt-2 border-t border-neutral-200 dark:border-neutral-800 flex justify-between items-baseline text-sm font-bold">
            <span>Total Payable</span>
            <span id="checkoutFinalTotal" class="text-lg">₹999.00</span>
          </div>
        </div>

        <button type="submit" class="w-full py-4 rounded-2xl bg-black text-white dark:bg-white dark:text-black font-bold text-xs uppercase tracking-[0.2em] hover:opacity-90 transition">
          Confirm &amp; Place Order
        </button>
      </form>
    </div>
  </div>

  <!-- ==========================================
       INFO / SIZE GUIDE / WISHLIST / POLICY MODAL
       ========================================== -->
  <div id="infoModal" class="fixed inset-0 z-50 bg-black/70 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="bg-white dark:bg-[#111111] text-black dark:text-white w-full max-w-lg rounded-3xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-2xl max-h-[85vh] overflow-y-auto">
      <div class="flex items-center justify-between pb-4 border-b border-neutral-200 dark:border-neutral-800">
        <h3 id="infoModalTitle" class="font-display text-xl font-bold uppercase tracking-tight">Size Guide</h3>
        <button id="closeInfoModalBtn" class="w-8 h-8 rounded-full bg-neutral-100 dark:bg-neutral-900 flex items-center justify-center">✕</button>
      </div>
      <div id="infoModalBody" class="mt-4 text-xs sm:text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">
        <!-- Populated dynamically -->
      </div>
    </div>
  </div>

  <!-- TOAST NOTIFICATION -->
  <div id="toastNotification" class="fixed bottom-5 left-1/2 -translate-x-1/2 z-50 px-5 py-3 rounded-full bg-black text-white dark:bg-white dark:text-black text-xs font-bold tracking-wider uppercase shadow-2xl opacity-0 pointer-events-none transition-all duration-300">
    Added to Bag
  </div>

  <!-- APPLICATION SCRIPT -->
  <script>
    (function () {
      // 1. PRODUCT CATALOG (Uses inlined generated studio images)
      const PRODUCTS = [
        {
          id: 'old-skool-raglan',
          title: 'AkkuStyle',
          category: 'Shirt',
          color: 'Red',
          price: 1099,
          oldPrice: 1299,
          badge: '15% OFF',
          isNew: true,
          isCollector: true,
          sizes: ['S', 'M', 'L', 'XL', '2XL', '3XL'],
          modelNote: "Model is 172cm (5'8\") tall, weighs 72kg, and is wearing size M.",
          description: 'Iconic contrast crimson raglan sleeves paired with a breathable sweat-wicking combed cotton core. Engineered for a tapered V-taper silhouette.',
          images: [
            "https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp",
            "https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562",
            "https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg"
          ]
        }
      ];

      const CATEGORIES = ['All Products', 'T-shirt', 'Compression Fit', 'Gym Vest', 'Track Pant'];

      // 2. APPLICATION STATE
      const state = {
        themeMode: 'system', // 'system' | 'light' | 'dark'
        promoIndex: 0,
        spotlightCategory: 'All Products',
        spotlightIndex: 0,
        spotlightThumbIndex: 0,
        selectedSizes: {
          'old-skool-raglan': 'S'
        },
        catalogCategory: 'All Products',
        searchQuery: '',
        sortBy: 'featured',
        wishlist: ['old-skool-raglan'],
        recentlyViewedId: 'core-sweats-iron',
        cart: [
          {
            productId: 'old-skool-raglan',
            size: 'S',
            qty: 1
          }
        ],
        activePdpId: 'core-sweats-iron',
        activePdpThumb: 0
      };

      const PROMOS = [
        '⚡ ORDER TODAY, DISPATCHED TODAY! • PAY ONLINE & SAVE ₹100 ON YOUR ORDER!',
        'FREE EXPRESS SHIPPING ACROSS INDIA ON ALL PREPAID ORDERS',
        'NEW SEASONAL DROP: MONOCHROME & OLD SKOOL RAGLAN SERIES LIVE NOW'
      ];

      // 3. THEME ENGINE (Device prefers-color-scheme + Manual Override)
      const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

      function applyTheme() {
        const isDark =
          state.themeMode === 'dark' ||
          (state.themeMode === 'system' && mediaQuery.matches);
        document.documentElement.classList.toggle('dark', isDark);

        document.querySelectorAll('.theme-mode-btn').forEach((btn) => {
          const mode = btn.getAttribute('data-theme-mode');
          if (mode === state.themeMode) {
            btn.className = 'theme-mode-btn px-2.5 py-1 rounded-full transition bg-black text-white dark:bg-white dark:text-black font-bold shadow-xs';
          } else {
            btn.className = 'theme-mode-btn px-2.5 py-1 rounded-full transition text-neutral-500 hover:text-black dark:hover:text-white';
          }
        });
      }

      if (mediaQuery.addEventListener) {
        mediaQuery.addEventListener('change', () => {
          if (state.themeMode === 'system') applyTheme();
        });
      }

      // 4. TOAST HELPER
      let toastTimer = null;
      function showToast(msg) {
        const el = document.getElementById('toastNotification');
        el.textContent = msg;
        el.classList.remove('opacity-0', 'pointer-events-none');
        el.classList.add('opacity-100');
        if (toastTimer) clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
          el.classList.remove('opacity-100');
          el.classList.add('opacity-0', 'pointer-events-none');
        }, 2200);
      }

      // 5. SPOTLIGHT CAROUSEL RENDERER (Matches Screenshot 3)
      function getSpotlightList() {
        if (state.spotlightCategory === 'All Products') return PRODUCTS;
        return PRODUCTS.filter((p) => p.category === state.spotlightCategory);
      }

      function renderSpotlight() {
        const list = getSpotlightList();
        if (!list.length) return;
        if (state.spotlightIndex >= list.length) state.spotlightIndex = 0;
        if (state.spotlightIndex < 0) state.spotlightIndex = list.length - 1;

        const current = list[state.spotlightIndex];
        const prev = list[(state.spotlightIndex - 1 + list.length) % list.length];
        const next = list[(state.spotlightIndex + 1) % list.length];

        const activeImg = current.images[state.spotlightThumbIndex] || current.images[0];
        document.getElementById('spotlightMainImg').src = activeImg;
        document.getElementById('spotlightPrevImg').src = prev.images[0];
        document.getElementById('spotlightNextImg').src = next.images[0];

        const badgeEl = document.getElementById('spotlightBadge');
        if (current.badge) {
          badgeEl.textContent = current.badge;
          badgeEl.classList.remove('hidden');
        } else {
          badgeEl.classList.add('hidden');
        }

        // Wishlist heart state
        const wished = state.wishlist.includes(current.id);
        const wishIcon = document.getElementById('spotlightWishIcon');
        wishIcon.setAttribute('fill', wished ? 'currentColor' : 'none');

        // Thumbnails inside spotlight image
        const thumbsContainer = document.getElementById('spotlightThumbs');
        thumbsContainer.innerHTML = current.images
          .map(
            (imgUrl, idx) => `
            <button data-spot-thumb="${idx}" class="w-9 h-9 rounded-lg overflow-hidden border-2 transition ${
              idx === state.spotlightThumbIndex ? 'border-white scale-105' : 'border-transparent opacity-60 hover:opacity-100'
            }">
              <img src="${imgUrl}" alt="Angle ${idx + 1}" class="w-full h-full object-cover" />
            </button>
          `
          )
          .join('');

        // Title, Price, Sizes
        document.getElementById('spotlightTitle').textContent = current.title;
        document.getElementById('spotlightSub').textContent = `${current.category} • ${current.color}`;
        document.getElementById('spotlightPrice').textContent = `₹${current.price.toLocaleString('en-IN')}`;
        const oldPriceEl = document.getElementById('spotlightOldPrice');
        if (current.oldPrice) {
          oldPriceEl.textContent = `₹${current.oldPrice.toLocaleString('en-IN')}`;
          oldPriceEl.classList.remove('hidden');
        } else {
          oldPriceEl.classList.add('hidden');
        }

        const chosenSize = state.selectedSizes[current.id] || current.sizes[0];
        const sizesContainer = document.getElementById('spotlightSizes');
        sizesContainer.innerHTML = current.sizes
          .map((sz) => {
            const active = sz === chosenSize;
            return `<button data-spot-size="${sz}" class="py-2.5 rounded-xl text-xs font-bold transition ${
              active
                ? 'bg-black text-white dark:bg-white dark:text-black shadow-xs'
                : 'bg-neutral-100 text-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-800'
            }">${sz}</button>`;
          })
          .join('');

        document.getElementById('spotlightModelNote').textContent = current.modelNote;
        document.getElementById('spotlightAddBtnLabel').textContent = `Add to Bag — ${chosenSize}`;

        const numStr = String(state.spotlightIndex + 1).padStart(2, '0');
        const totStr = String(list.length).padStart(2, '0');
        document.getElementById('spotlightCounter').textContent = `${numStr}/${totStr}`;


      }

      // 6. MEN'S COLLECTION PRODUCT GRID RENDERER (Matches Screenshot 7)
      function renderCatalog() {
        // Category tabs
        const tabsEl = document.getElementById('catalogCategoryTabs');
        tabsEl.innerHTML = CATEGORIES.map((cat) => {
          const active = cat === state.catalogCategory;
          return `<button data-cat-tab="${cat}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition border ${
            active
              ? 'bg-black text-white border-black dark:bg-white dark:text-black dark:border-white'
              : 'bg-transparent text-neutral-600 border-neutral-200 dark:text-neutral-400 dark:border-neutral-800 hover:border-black dark:hover:border-white'
          }">${cat}</button>`;
        }).join('');

        // Filter & Sort products
        let filtered = PRODUCTS.filter((p) => {
          if (state.catalogCategory === 'New In') return p.isNew;
          if (state.catalogCategory === 'Collector') return p.isCollector;
          if (state.catalogCategory !== 'All Products' && p.category !== state.catalogCategory) return false;
          if (state.searchQuery.trim() !== '') {
            const q = state.searchQuery.toLowerCase();
            return (
              p.title.toLowerCase().includes(q) ||
              p.category.toLowerCase().includes(q) ||
              p.color.toLowerCase().includes(q)
            );
          }
          return true;
        });

        if (state.sortBy === 'price-asc') {
          filtered.sort((a, b) => a.price - b.price);
        } else if (state.sortBy === 'price-desc') {
          filtered.sort((a, b) => b.price - a.price);
        }

        const gridEl = document.getElementById('productGrid');
        if (!filtered.length) {
          gridEl.innerHTML = `
            <div class="col-span-full py-14 text-center">
              <p class="text-sm text-neutral-500 mb-3">No pieces matched your current filter.</p>
              <button id="emptyResetBtn" class="px-5 py-2.5 rounded-full bg-black text-white dark:bg-white dark:text-black text-xs font-bold uppercase tracking-wider">Reset Filters</button>
            </div>
          `;
          const resetBtn = document.getElementById('emptyResetBtn');
          if (resetBtn) {
            resetBtn.addEventListener('click', () => {
              state.catalogCategory = 'All Products';
              state.searchQuery = '';
              document.getElementById('searchInput').value = '';
              renderCatalog();
            });
          }
          return;
        }

        gridEl.innerHTML = filtered
          .map((p) => {
            const chosenSize = state.selectedSizes[p.id] || p.sizes[0];
            const wished = state.wishlist.includes(p.id);
            return `
            <article class="group flex flex-col justify-between">
              <div>
                <!-- Card Image Box -->
                <div class="relative aspect-[3/4] rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">
                  <!-- Top-left indicator lines like Screenshot 7 -->
                  <div class="absolute top-3 left-3 z-10 flex items-center gap-1">
                    <span class="w-4 h-1 rounded-full bg-black dark:bg-white"></span>
                    <span class="w-1.5 h-1 rounded-full bg-black/30 dark:bg-white/30"></span>
                    <span class="w-1.5 h-1 rounded-full bg-black/30 dark:bg-white/30"></span>
                  </div>

                  <!-- Wishlist Heart -->
                  <button data-grid-wish="${p.id}" class="absolute top-2.5 right-2.5 z-10 w-8 h-8 rounded-full bg-black/20 hover:bg-black/40 backdrop-blur-xs text-white flex items-center justify-center transition" aria-label="Toggle Wishlist">
                    <svg class="w-4 h-4" fill="${wished ? 'currentColor' : 'none'}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                    </svg>
                  </button>

                  <img data-open-pdp="${p.id}" src="${p.images[0]}" alt="${p.title}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 cursor-pointer" />

                  ${
                    p.badge
                      ? `<span class="absolute bottom-3 left-3 px-2.5 py-1 rounded-full bg-white text-black text-[10px] font-bold uppercase tracking-wider shadow">${p.badge}</span>`
                      : ''
                  }

                  <!-- Quick Size Ruler Icon bottom-right like Screenshot 7 -->
                  <button data-open-pdp="${p.id}" class="absolute bottom-3 right-3 w-7 h-7 rounded-full bg-black/25 hover:bg-black/50 text-white flex items-center justify-center backdrop-blur-xs" title="Inspect Fit & Details">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                  </button>
                </div>

                <!-- Product Meta -->
                <div class="mt-3">
                  <h3 data-open-pdp="${p.id}" class="text-xs sm:text-sm font-bold uppercase tracking-wide truncate cursor-pointer hover:opacity-70">${p.title}</h3>
                  <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">${p.category}</p>
                  <p class="text-[11px] text-neutral-400 dark:text-neutral-500">${p.color}</p>
                  <div class="flex items-center gap-2 mt-1.5">
                    <span class="text-xs sm:text-sm font-bold">₹${p.price.toLocaleString('en-IN')}</span>
                    ${
                      p.oldPrice
                        ? `<span class="text-[11px] text-red-500 line-through">₹${p.oldPrice.toLocaleString('en-IN')}</span>`
                        : ''
                    }
                  </div>
                </div>
              </div>

              <!-- Size Selector Pills + Quick Add -->
              <div class="mt-3 pt-2">
                <div class="flex flex-wrap gap-1">
                  ${p.sizes
                    .slice(0, 5)
                    .map((sz) => {
                      const isSel = sz === chosenSize;
                      return `<button data-card-size-prod="${p.id}" data-card-size="${sz}" class="px-2.5 py-1 rounded-lg text-[11px] font-bold transition ${
                        isSel
                          ? 'bg-black text-white dark:bg-white dark:text-black'
                          : 'bg-neutral-100 text-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-800'
                      }">${sz}</button>`;
                    })
                    .join('')}
                </div>
                <button data-card-add="${p.id}" class="mt-2.5 w-full py-2.5 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-bold uppercase tracking-wider hover:opacity-90 transition">
                  + Add (${chosenSize})
                </button>
              </div>
            </article>
          `;
          })
          .join('');
      }

      // 7. CART DRAWER & BADGE RENDERER (Matches Screenshot 1)
      function addToCart(productId, size) {
        const prod = PRODUCTS.find((p) => p.id === productId);
        if (!prod) return;
        const chosenSize = size || state.selectedSizes[productId] || prod.sizes[0];
        const existing = state.cart.find((item) => item.productId === productId && item.size === chosenSize);
        if (existing) {
          existing.qty += 1;
        } else {
          state.cart.push({ productId, size: chosenSize, qty: 1 });
        }
        renderCart();
        showToast(`Added ${prod.title} (${chosenSize}) to Bag`);
      }

      function renderCart() {
        const totalCount = state.cart.reduce((sum, item) => sum + item.qty, 0);
        document.getElementById('cartBadge').textContent = totalCount;

        // Wishlist badge
        const wishBadge = document.getElementById('wishlistBadge');
        if (state.wishlist.length > 0) {
          wishBadge.textContent = state.wishlist.length;
          wishBadge.classList.remove('hidden');
        } else {
          wishBadge.classList.add('hidden');
        }

        const container = document.getElementById('cartItemsContainer');
        if (state.cart.length === 0) {
          container.innerHTML = `
            <div class="py-10 text-center border border-dashed border-neutral-200 dark:border-neutral-800 rounded-2xl">
              <p class="text-xs text-neutral-500">Your Akku Bag is currently empty.</p>
            </div>
          `;
        } else {
          container.innerHTML = state.cart
            .map((item, idx) => {
              const p = PRODUCTS.find((prod) => prod.id === item.productId);
              if (!p) return '';
              return `
              <div class="p-3.5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800 flex gap-3.5">
                <img src="${p.images[0]}" alt="${p.title}" class="w-20 h-24 rounded-xl object-cover shrink-0 bg-neutral-200 dark:bg-neutral-800" />
                <div class="flex-1 min-w-0">
                  <div class="flex items-start justify-between gap-2">
                    <h5 class="text-xs font-bold uppercase tracking-wide leading-snug">${p.title}</h5>
                    <button data-cart-remove="${idx}" class="text-neutral-400 hover:text-red-500 transition p-0.5" aria-label="Remove item">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                  </div>
                  <p class="text-[11px] text-neutral-500 mt-0.5">${item.size} / ${p.color}</p>
                  <p class="text-[10px] text-neutral-400 mt-1 leading-normal">ⓘ ${p.modelNote}</p>
                  <div class="flex items-center justify-between mt-3">
                    <span class="text-xs font-bold">₹${(p.price * item.qty).toLocaleString('en-IN')}.00</span>
                    <div class="flex items-center gap-3 bg-white dark:bg-black px-2.5 py-1 rounded-lg border border-neutral-200 dark:border-neutral-800">
                      <button data-cart-dec="${idx}" class="text-sm font-bold px-1 hover:opacity-60">−</button>
                      <span class="text-xs font-bold">${item.qty}</span>
                      <button data-cart-inc="${idx}" class="text-sm font-bold px-1 hover:opacity-60">+</button>
                    </div>
                  </div>
                </div>
              </div>
            `;
            })
            .join('');
        }

        // Recently Viewed Card inside Cart Drawer (Matches Screenshot 1)
        const rvProd = PRODUCTS.find((p) => p.id === state.recentlyViewedId) || PRODUCTS[3];
        const rvSize = state.selectedSizes[rvProd.id] || rvProd.sizes[0];
        const rvContainer = document.getElementById('recentlyViewedCartCard');
        rvContainer.innerHTML = `
          <img src="${rvProd.images[0]}" alt="${rvProd.title}" class="w-16 h-20 rounded-xl object-cover shrink-0 bg-neutral-200 dark:bg-neutral-800" />
          <div class="flex-1 min-w-0">
            <h5 class="text-xs font-bold uppercase tracking-wide truncate">${rvProd.title}</h5>
            <p class="text-xs font-semibold text-neutral-500 mt-0.5">₹${rvProd.price.toLocaleString('en-IN')}</p>
            <div class="flex flex-wrap gap-1 mt-2">
              ${rvProd.sizes
                .slice(0, 4)
                .map(
                  (sz) => `
                <button data-rv-size="${sz}" class="px-2 py-0.5 rounded text-[10px] font-bold border ${
                  sz === rvSize
                    ? 'bg-black text-white border-black dark:bg-white dark:text-black dark:border-white'
                    : 'border-neutral-300 dark:border-neutral-700 text-neutral-600 dark:text-neutral-300'
                }">${sz}</button>
              `
                )
                .join('')}
            </div>
            <button id="rvAddToBagBtn" class="mt-2.5 w-full py-2 rounded-lg bg-black text-white dark:bg-white dark:text-black text-[11px] font-bold uppercase tracking-wider hover:opacity-90 transition">
              + ADD TO BAG
            </button>
          </div>
        `;

        const subtotal = state.cart.reduce((sum, item) => {
          const p = PRODUCTS.find((prod) => prod.id === item.productId);
          return sum + (p ? p.price * item.qty : 0);
        }, 0);

        document.getElementById('cartSubtotalText').textContent = `₹${subtotal.toLocaleString('en-IN')}.00`;
        updateCheckoutNumbers();
      }

      // 8. PRODUCT DETAIL MODAL RENDERER (Matches Screenshot 10)
      function openProductDetail(productId) {
        const prod = PRODUCTS.find((p) => p.id === productId);
        if (!prod) return;
        state.activePdpId = productId;
        state.activePdpThumb = 0;
        state.recentlyViewedId = productId;
        renderProductDetail();
        renderCart();
        document.getElementById('productDetailModal').classList.remove('hidden');
      }

      function renderProductDetail() {
        const prod = PRODUCTS.find((p) => p.id === state.activePdpId);
        if (!prod) return;

        const imgUrl = prod.images[state.activePdpThumb] || prod.images[0];
        document.getElementById('pdpMainImg').src = imgUrl;
        document.getElementById('pdpCategory').textContent = `${prod.category} • ${prod.color}`;
        document.getElementById('pdpTitle').textContent = prod.title;
        document.getElementById('pdpPrice').textContent = `₹${prod.price.toLocaleString('en-IN')}`;
        document.getElementById('pdpOldPrice').textContent = prod.oldPrice ? `₹${prod.oldPrice.toLocaleString('en-IN')}` : '';
        document.getElementById('pdpDescription').textContent = prod.description;
        document.getElementById('pdpModelInfo').textContent = prod.modelNote;

        const thumbsEl = document.getElementById('pdpThumbnails');
        thumbsEl.innerHTML = prod.images
          .map(
            (u, i) => `
          <button data-pdp-thumb="${i}" class="w-16 h-20 rounded-xl overflow-hidden border-2 transition ${
            i === state.activePdpThumb ? 'border-black dark:border-white' : 'border-transparent opacity-60 hover:opacity-100'
          }">
            <img src="${u}" alt="Thumb ${i + 1}" class="w-full h-full object-cover" />
          </button>
        `
          )
          .join('');

        const chosenSize = state.selectedSizes[prod.id] || prod.sizes[0];
        const sizesEl = document.getElementById('pdpSizes');
        sizesEl.innerHTML = prod.sizes
          .map(
            (sz) => `
          <button data-pdp-size="${sz}" class="py-3 rounded-xl text-xs font-bold border transition ${
            sz === chosenSize
              ? 'bg-black text-white border-black dark:bg-white dark:text-black dark:border-white'
              : 'border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white'
          }">${sz}</button>
        `
          )
          .join('');

        document.getElementById('pdpAddToBagBtn').textContent = `Add to Bag — ${chosenSize} (₹${prod.price.toLocaleString('en-IN')})`;
      }

      // 9. CHECKOUT SUMMARY HELPER
      function updateCheckoutNumbers() {
        const totalItems = state.cart.reduce((s, i) => s + i.qty, 0);
        const rawSubtotal = state.cart.reduce((s, i) => {
          const p = PRODUCTS.find((prod) => prod.id === i.productId);
          return s + (p ? p.price * i.qty : 0);
        }, 0);

        const selectedPay = document.querySelector('input[name="payMethod"]:checked');
        const isOnline = !selectedPay || selectedPay.value === 'online';
        const discount = isOnline && rawSubtotal > 0 ? 100 : 0;
        const finalAmount = Math.max(0, rawSubtotal - discount);

        document.getElementById('checkoutItemsCount').textContent = `Total (${totalItems} item${totalItems === 1 ? '' : 's'})`;
        document.getElementById('checkoutRawSubtotal').textContent = `₹${rawSubtotal.toLocaleString('en-IN')}.00`;
        document.getElementById('checkoutDiscountRow').classList.toggle('hidden', discount === 0);
        document.getElementById('checkoutFinalTotal').textContent = `₹${finalAmount.toLocaleString('en-IN')}.00`;
      }

      // 10. INFO MODAL HELPER (Size Guide, Wishlist, Policies, Contact)
      function openInfoModal(title, htmlContent) {
        document.getElementById('infoModalTitle').textContent = title;
        document.getElementById('infoModalBody').innerHTML = htmlContent;
        document.getElementById('infoModal').classList.remove('hidden');
      }

      function getSizeGuideHtml() {
        return `
          <p class="mb-4 text-xs text-neutral-500">All measurements are in inches. Fit is athletic tapered across chest &amp; shoulders.</p>
          <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
              <thead>
                <tr class="border-b border-neutral-200 dark:border-neutral-800 font-bold uppercase">
                  <th class="py-2">Size</th>
                  <th class="py-2">Chest (in)</th>
                  <th class="py-2">Length (in)</th>
                  <th class="py-2">Waist (in)</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                <tr><td class="py-2 font-bold">S</td><td class="py-2">38"</td><td class="py-2">27.5"</td><td class="py-2">28–30"</td></tr>
                <tr><td class="py-2 font-bold">M</td><td class="py-2">40"</td><td class="py-2">28.5"</td><td class="py-2">30–32"</td></tr>
                <tr><td class="py-2 font-bold">L</td><td class="py-2">42"</td><td class="py-2">29.5"</td><td class="py-2">32–34"</td></tr>
                <tr><td class="py-2 font-bold">XL</td><td class="py-2">44"</td><td class="py-2">30.5"</td><td class="py-2">34–36"</td></tr>
                <tr><td class="py-2 font-bold">2XL</td><td class="py-2">46"</td><td class="py-2">31.5"</td><td class="py-2">36–38"</td></tr>
                <tr><td class="py-2 font-bold">3XL</td><td class="py-2">48"</td><td class="py-2">32.0"</td><td class="py-2">38–40"</td></tr>
              </tbody>
            </table>
          </div>
        `;
      }

      function openWishlistModal() {
        if (!state.wishlist.length) {
          openInfoModal('Saved Wishlist', '<p class="py-6 text-center text-neutral-500">Your wishlist is empty. Tap the heart icon on any piece to save it here.</p>');
          return;
        }
        const itemsHtml = state.wishlist
          .map((id) => {
            const p = PRODUCTS.find((prod) => prod.id === id);
            if (!p) return '';
            return `
              <div class="flex items-center justify-between gap-3 py-3 border-b border-neutral-200 dark:border-neutral-800">
                <div class="flex items-center gap-3">
                  <img src="${p.images[0]}" alt="${p.title}" class="w-12 h-14 rounded-lg object-cover" />
                  <div>
                    <div class="text-xs font-bold uppercase">${p.title}</div>
                    <div class="text-xs text-neutral-500">₹${p.price.toLocaleString('en-IN')}</div>
                  </div>
                </div>
                <button data-wish-move-bag="${p.id}" class="px-3 py-1.5 rounded-lg bg-black text-white dark:bg-white dark:text-black text-[11px] font-bold uppercase">Add to Bag</button>
              </div>
            `;
          })
          .join('');
        openInfoModal('Saved Wishlist', `<div class="divide-y divide-neutral-200 dark:divide-neutral-800">${itemsHtml}</div>`);
      }

      // 11. DRAWER OPEN / CLOSE CONTROLLERS
      function toggleMenuDrawer(open) {
        const drawer = document.getElementById('menuDrawer');
        const backdrop = document.getElementById('menuDrawerBackdrop');
        if (open) {
          backdrop.classList.remove('hidden');
          drawer.classList.remove('-translate-x-full');
        } else {
          backdrop.classList.add('hidden');
          drawer.classList.add('-translate-x-full');
        }
      }

      function toggleCartDrawer(open) {
        const drawer = document.getElementById('cartDrawer');
        const backdrop = document.getElementById('cartDrawerBackdrop');
        if (open) {
          renderCart();
          backdrop.classList.remove('hidden');
          drawer.classList.remove('translate-x-full');
        } else {
          backdrop.classList.add('hidden');
          drawer.classList.add('translate-x-full');
        }
      }

      // 12. EVENT LISTENERS
      function attachListeners() {
        // Promo bar arrows
        document.getElementById('prevPromoBtn').addEventListener('click', () => {
          state.promoIndex = (state.promoIndex - 1 + PROMOS.length) % PROMOS.length;
          document.getElementById('promoBannerText').textContent = PROMOS[state.promoIndex];
        });
        document.getElementById('nextPromoBtn').addEventListener('click', () => {
          state.promoIndex = (state.promoIndex + 1) % PROMOS.length;
          document.getElementById('promoBannerText').textContent = PROMOS[state.promoIndex];
        });

        // Theme Mode Buttons
        /* document.querySelectorAll('.theme-mode-btn').forEach((btn) => {
          btn.addEventListener('click', () => {
            state.themeMode = btn.getAttribute('data-theme-mode');
            applyTheme();
            showToast(`Theme: ${state.themeMode.toUpperCase()}`);
          });
        }); */

        // Header Menu, Search, Wishlist, Cart
        document.getElementById('openMenuBtn').addEventListener('click', () => toggleMenuDrawer(true));
        document.getElementById('closeMenuBtn').addEventListener('click', () => toggleMenuDrawer(false));
        document.getElementById('menuDrawerBackdrop').addEventListener('click', () => toggleMenuDrawer(false));

        document.getElementById('openCartBtn').addEventListener('click', () => toggleCartDrawer(true));
        document.getElementById('closeCartBtn').addEventListener('click', () => toggleCartDrawer(false));
        document.getElementById('cartDrawerBackdrop').addEventListener('click', () => toggleCartDrawer(false));

        document.getElementById('openWishlistBtn').addEventListener('click', () => {
          window.location.href = '{{ route("pages.fav.index") }}';
        });

        document.getElementById('openSearchBtn').addEventListener('click', () => {
          const panel = document.getElementById('searchBarPanel');
          panel.classList.toggle('hidden');
          if (!panel.classList.contains('hidden')) {
            document.getElementById('searchInput').focus();
          }
        });

        document.getElementById('searchInput').addEventListener('input', (e) => {
          state.searchQuery = e.target.value;
          renderCatalog();
        });

        document.getElementById('clearSearchBtn').addEventListener('click', () => {
          state.searchQuery = '';
          document.getElementById('searchInput').value = '';
          renderCatalog();
        });

        // Brand Logo Home Scroll
        document.getElementById('brandHomeBtn').addEventListener('click', () => {
          document.getElementById('productDetailModal').classList.add('hidden');
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Desktop Nav Scroll Buttons
        document.querySelectorAll('.nav-scroll-btn').forEach((btn) => {
          btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-nav-section');
            const el = document.getElementById(targetId);
            if (el) el.scrollIntoView({ behavior: 'smooth' });
          });
        });

        // Hero CTAs
        document.getElementById('heroChaseBtn').addEventListener('click', () => {
          document.getElementById('catalogSection').scrollIntoView({ behavior: 'smooth' });
        });
        document.getElementById('heroExploreSpotlightBtn').addEventListener('click', () => {
          document.getElementById('showcaseSection').scrollIntoView({ behavior: 'smooth' });
        });

        // Menu Accordions & Items
        document.getElementById('menuExploreFitsToggle').addEventListener('click', () => {
          document.getElementById('menuExploreFitsSub').classList.toggle('hidden');
          document.getElementById('menuExploreFitsArrow').classList.toggle('rotate-180');
        });
        document.getElementById('menuSeasonalToggle').addEventListener('click', () => {
          document.getElementById('menuSeasonalSub').classList.toggle('hidden');
          document.getElementById('menuSeasonalArrow').classList.toggle('rotate-180');
        });

        document.querySelectorAll('.menu-nav-item').forEach((btn) => {
          btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-menu-filter');
            state.catalogCategory = filter;
            toggleMenuDrawer(false);
            renderCatalog();
            document.getElementById('catalogSection').scrollIntoView({ behavior: 'smooth' });
          });
        });

        document.getElementById('menuAboutBtn').addEventListener('click', () => {
          toggleMenuDrawer(false);
          document.getElementById('manifestoSection').scrollIntoView({ behavior: 'smooth' });
        });

        document.getElementById('menuProfileBtn').addEventListener('click', () => {
          toggleMenuDrawer(false);
          openInfoModal(
            'Athlete Profile',
            `<div class="space-y-3">
              <p class="font-bold">Signed in as: Arjun Varma (Akku VIP Member)</p>
              <p class="text-xs text-neutral-500">Reward Tier: Consistency Gold • ₹100 Instant Prepaid Discount Active</p>
            </div>`
          );
        });

        document.getElementById('menuWishlistBtn').addEventListener('click', () => {
          toggleMenuDrawer(false);
          window.location.href = '{{ route("pages.fav.index") }}';
        });

        // Spotlight Controls
        document.getElementById('spotlightPrevBtn').addEventListener('click', () => {
          state.spotlightIndex -= 1;
          state.spotlightThumbIndex = 0;
          renderSpotlight();
        });
        document.getElementById('spotlightNextBtn').addEventListener('click', () => {
          state.spotlightIndex += 1;
          state.spotlightThumbIndex = 0;
          renderSpotlight();
        });
        document.getElementById('spotlightPrevPreview').addEventListener('click', () => {
          state.spotlightIndex -= 1;
          state.spotlightThumbIndex = 0;
          renderSpotlight();
        });
        document.getElementById('spotlightNextPreview').addEventListener('click', () => {
          state.spotlightIndex += 1;
          state.spotlightThumbIndex = 0;
          renderSpotlight();
        });

        document.getElementById('spotlightMainImg').addEventListener('click', () => {
          const list = getSpotlightList();
          const current = list[state.spotlightIndex];
          if (current) openProductDetail(current.id);
        });

        document.getElementById('spotlightViewDetailBtn').addEventListener('click', () => {
          const list = getSpotlightList();
          const current = list[state.spotlightIndex];
          if (current) openProductDetail(current.id);
        });

        document.getElementById('spotlightWishBtn').addEventListener('click', () => {
          const list = getSpotlightList();
          const current = list[state.spotlightIndex];
          if (!current) return;
          const idx = state.wishlist.indexOf(current.id);
          if (idx > -1) {
            state.wishlist.splice(idx, 1);
            showToast('Removed from Wishlist');
          } else {
            state.wishlist.push(current.id);
            showToast('Saved to Wishlist');
          }
          renderSpotlight();
          renderCatalog();
          renderCart();
        });

        document.getElementById('spotlightAddToBagBtn').addEventListener('click', () => {
          const list = getSpotlightList();
          const current = list[state.spotlightIndex];
          if (!current) return;
          const sz = state.selectedSizes[current.id] || current.sizes[0];
          addToCart(current.id, sz);
          toggleCartDrawer(true);
        });

        document.getElementById('openSizeGuideBtn').addEventListener('click', () => {
          openInfoModal('Akku Size Guide', getSizeGuideHtml());
        });

        // Sort & Reset Catalog
        document.getElementById('sortSelect').addEventListener('change', (e) => {
          state.sortBy = e.target.value;
          renderCatalog();
        });

        document.getElementById('resetCatalogFiltersBtn').addEventListener('click', () => {
          state.catalogCategory = 'All Products';
          state.searchQuery = '';
          document.getElementById('searchInput').value = '';
          renderCatalog();
        });

        // Upsell Bottle button inside Cart
        document.getElementById('upsellAddBottleBtn').addEventListener('click', () => {
          addToCart('akku-fuel-bottle', 'ONE');
        });

        // Checkout Modal Triggers
        document.getElementById('openCheckoutModalBtn').addEventListener('click', () => {
          if (state.cart.length === 0) {
            showToast('Add an item to your bag first');
            return;
          }
          toggleCartDrawer(false);
          updateCheckoutNumbers();
          document.getElementById('checkoutModal').classList.remove('hidden');
        });

        document.getElementById('closeCheckoutModalBtn').addEventListener('click', () => {
          document.getElementById('checkoutModal').classList.add('hidden');
        });

        document.querySelectorAll('input[name="payMethod"]').forEach((radio) => {
          radio.addEventListener('change', updateCheckoutNumbers);
        });

        document.getElementById('checkoutForm').addEventListener('submit', (e) => {
          e.preventDefault();
          document.getElementById('checkoutModal').classList.add('hidden');
          state.cart = [];
          renderCart();
          openInfoModal(
            'Order Confirmed — #AKKU2026',
            `<div class="space-y-3">
              <p class="font-bold text-emerald-600 dark:text-emerald-400">⚡ Your Akku order has been queued for same-day dispatch!</p>
              <p class="text-xs text-neutral-500">Tracking link will be sent via WhatsApp &amp; E-mail within 2 hours.</p>
            </div>`
          );
        });

        // PDP Controls
        document.getElementById('closeProductDetailBtn').addEventListener('click', () => {
          document.getElementById('productDetailModal').classList.add('hidden');
        });
        document.getElementById('pdpOpenCartBtn').addEventListener('click', () => {
          document.getElementById('productDetailModal').classList.add('hidden');
          toggleCartDrawer(true);
        });
        document.getElementById('pdpSizeGuideBtn').addEventListener('click', () => {
          openInfoModal('Akku Size Guide', getSizeGuideHtml());
        });
        document.getElementById('pdpShareBtn').addEventListener('click', () => {
          showToast('Product link copied to clipboard');
        });
        document.getElementById('pdpWishBtn').addEventListener('click', () => {
          const id = state.activePdpId;
          const idx = state.wishlist.indexOf(id);
          if (idx > -1) {
            state.wishlist.splice(idx, 1);
            showToast('Removed from Wishlist');
          } else {
            state.wishlist.push(id);
            showToast('Saved to Wishlist');
          }
          renderCatalog();
          renderCart();
        });
        document.getElementById('pdpAddToBagBtn').addEventListener('click', () => {
          const id = state.activePdpId;
          const sz = state.selectedSizes[id] || 'M';
          addToCart(id, sz);
          document.getElementById('productDetailModal').classList.add('hidden');
          toggleCartDrawer(true);
        });

        // Info Modal close
        document.getElementById('closeInfoModalBtn').addEventListener('click', () => {
          document.getElementById('infoModal').classList.add('hidden');
        });

        // Footer Policy & Contact Links
        document.querySelectorAll('.policy-link-btn').forEach((btn) => {
          btn.addEventListener('click', () => {
            const type = btn.getAttribute('data-policy');
            const titles = {
              terms: 'Terms & Conditions',
              returns: '7-Day Returns & Size Exchange',
              privacy: 'Privacy Policy',
              cookies: 'Cookie Preferences',
              instagram: 'Akku Official Instagram'
            };
            openInfoModal(
              titles[type] || 'Information',
              `<p>All Akku orders are backed by our 7-day hassle-free size exchange guarantee and same-day dispatch commitment from our India fulfillment center.</p>`
            );
          });
        });

        document.querySelectorAll('.contact-action-btn').forEach((btn) => {
          btn.addEventListener('click', () => {
            const c = btn.getAttribute('data-contact');
            if (c === 'whatsapp') {
              openInfoModal('WhatsApp Concierge', '<p>Connect with our athlete sizing &amp; dispatch desk on WhatsApp: <strong>+91 98470 00000</strong> (Mon–Sat, 9 AM – 8 PM IST).</p>');
            } else if (c === 'email') {
              openInfoModal('Send E-mail', '<p>Reach our support team directly at <strong>support@akku.com</strong> — average response time under 2 hours.</p>');
            } else {
              openInfoModal('Contact Us', '<p>Akku Performance Apparel HQ • Fulfillment &amp; Design Studio, India. Same-day dispatch on all orders placed before 4 PM.</p>');
            }
          });
        });

        // Newsletter Form
        document.getElementById('newsletterForm').addEventListener('submit', (e) => {
          e.preventDefault();
          document.getElementById('newsletterEmail').value = '';
          showToast('Subscribed to Early Drop Access');
        });

        // Delegated Clicks for Dynamic Elements (Spotlight sizes/thumbs/cats, Grid cards, Cart items, PDP thumbs/sizes)
        document.body.addEventListener('click', (e) => {
          const spotThumb = e.target.closest('[data-spot-thumb]');
          if (spotThumb) {
            state.spotlightThumbIndex = parseInt(spotThumb.getAttribute('data-spot-thumb'), 10);
            renderSpotlight();
            return;
          }

          const spotSize = e.target.closest('[data-spot-size]');
          if (spotSize) {
            const list = getSpotlightList();
            const current = list[state.spotlightIndex];
            if (current) {
              state.selectedSizes[current.id] = spotSize.getAttribute('data-spot-size');
              renderSpotlight();
              renderCatalog();
            }
            return;
          }

          const spotCat = e.target.closest('[data-spot-cat]');
          if (spotCat) {
            state.spotlightCategory = spotCat.getAttribute('data-spot-cat');
            state.spotlightIndex = 0;
            state.spotlightThumbIndex = 0;
            renderSpotlight();
            return;
          }

          const catTab = e.target.closest('[data-cat-tab]');
          if (catTab) {
            state.catalogCategory = catTab.getAttribute('data-cat-tab');
            renderCatalog();
            return;
          }

          const cardSizeBtn = e.target.closest('[data-card-size]');
          if (cardSizeBtn) {
            const pid = cardSizeBtn.getAttribute('data-card-size-prod');
            const sz = cardSizeBtn.getAttribute('data-card-size');
            state.selectedSizes[pid] = sz;
            renderCatalog();
            renderSpotlight();
            return;
          }

          const cardAddBtn = e.target.closest('[data-card-add]');
          if (cardAddBtn) {
            const pid = cardAddBtn.getAttribute('data-card-add');
            addToCart(pid, state.selectedSizes[pid]);
            return;
          }

          const gridWishBtn = e.target.closest('[data-grid-wish]');
          if (gridWishBtn) {
            const pid = gridWishBtn.getAttribute('data-grid-wish');
            const idx = state.wishlist.indexOf(pid);
            if (idx > -1) {
              state.wishlist.splice(idx, 1);
              showToast('Removed from Wishlist');
            } else {
              state.wishlist.push(pid);
              showToast('Saved to Wishlist');
            }
            renderCatalog();
            renderSpotlight();
            renderCart();
            return;
          }

          const openPdpEl = e.target.closest('[data-open-pdp]');
          if (openPdpEl) {
            openProductDetail(openPdpEl.getAttribute('data-open-pdp'));
            return;
          }

          const cartInc = e.target.closest('[data-cart-inc]');
          if (cartInc) {
            const idx = parseInt(cartInc.getAttribute('data-cart-inc'), 10);
            if (state.cart[idx]) {
              state.cart[idx].qty += 1;
              renderCart();
            }
            return;
          }

          const cartDec = e.target.closest('[data-cart-dec]');
          if (cartDec) {
            const idx = parseInt(cartDec.getAttribute('data-cart-dec'), 10);
            if (state.cart[idx]) {
              state.cart[idx].qty -= 1;
              if (state.cart[idx].qty <= 0) state.cart.splice(idx, 1);
              renderCart();
            }
            return;
          }

          const cartRem = e.target.closest('[data-cart-remove]');
          if (cartRem) {
            const idx = parseInt(cartRem.getAttribute('data-cart-remove'), 10);
            state.cart.splice(idx, 1);
            renderCart();
            showToast('Item removed from bag');
            return;
          }

          const rvSizeBtn = e.target.closest('[data-rv-size]');
          if (rvSizeBtn) {
            const rvProd = PRODUCTS.find((p) => p.id === state.recentlyViewedId) || PRODUCTS[3];
            state.selectedSizes[rvProd.id] = rvSizeBtn.getAttribute('data-rv-size');
            renderCart();
            return;
          }

          if (e.target.closest('#rvAddToBagBtn')) {
            const rvProd = PRODUCTS.find((p) => p.id === state.recentlyViewedId) || PRODUCTS[3];
            addToCart(rvProd.id, state.selectedSizes[rvProd.id] || rvProd.sizes[0]);
            return;
          }

          const pdpThumb = e.target.closest('[data-pdp-thumb]');
          if (pdpThumb) {
            state.activePdpThumb = parseInt(pdpThumb.getAttribute('data-pdp-thumb'), 10);
            renderProductDetail();
            return;
          }

          const pdpSize = e.target.closest('[data-pdp-size]');
          if (pdpSize) {
            state.selectedSizes[state.activePdpId] = pdpSize.getAttribute('data-pdp-size');
            renderProductDetail();
            renderCatalog();
            renderSpotlight();
            return;
          }

          const wishMoveBtn = e.target.closest('[data-wish-move-bag]');
          if (wishMoveBtn) {
            const pid = wishMoveBtn.getAttribute('data-wish-move-bag');
            addToCart(pid, state.selectedSizes[pid]);
            document.getElementById('infoModal').classList.add('hidden');
            toggleCartDrawer(true);
          }
        });
      }

      // INITIALIZE APP
      applyTheme();
      renderSpotlight();
      renderCatalog();
      renderCart();
      attachListeners();
    })();
  </script>
</body>
</html>