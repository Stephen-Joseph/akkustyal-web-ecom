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