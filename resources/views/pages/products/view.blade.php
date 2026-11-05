@include('layouts.app')
<body class="bg-white text-black dark:bg-[#070707] dark:text-white font-sans antialiased selection:bg-black selection:text-white dark:selection:bg-white dark:selection:text-black transition-colors duration-300 overflow-x-hidden">

  @include('layouts.header')

  <main>

    <!-- BREADCRUMB -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex items-center gap-2 text-xs text-neutral-500 dark:text-neutral-400 border-b border-neutral-100 dark:border-neutral-900">
      <a href="/" class="hover:text-black dark:hover:text-white transition">Home</a>
      <span>/</span>
      <span class="hover:text-black dark:hover:text-white transition cursor-pointer">Men's Collection</span>
      <span>/</span>
      <span class="text-black dark:text-white font-semibold truncate">Old Skool — Red Raglan Tee</span>
    </div>

    <!-- PRODUCT DETAIL SECTION -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 py-10 lg:py-14">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start">

        <!-- LEFT: Image Gallery -->
        <div class="flex flex-col-reverse sm:flex-row gap-3 lg:sticky lg:top-20">

          <!-- Thumbnail Strip -->
          <div class="flex sm:flex-col gap-2 overflow-x-auto sm:overflow-y-auto no-scrollbar sm:max-h-[560px] shrink-0">
            <button onclick="switchImage(this, 'https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp')"
              class="thumb-btn shrink-0 w-16 h-20 rounded-xl overflow-hidden border-2 border-black dark:border-white transition">
              <img src="https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp" class="w-full h-full object-cover" />
            </button>
            <button onclick="switchImage(this, 'https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562')"
              class="thumb-btn shrink-0 w-16 h-20 rounded-xl overflow-hidden border-2 border-transparent hover:border-neutral-400 dark:hover:border-neutral-500 transition">
              <img src="https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562" class="w-full h-full object-cover" />
            </button>
            <button onclick="switchImage(this, 'https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg')"
              class="thumb-btn shrink-0 w-16 h-20 rounded-xl overflow-hidden border-2 border-transparent hover:border-neutral-400 dark:hover:border-neutral-500 transition">
              <img src="https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg" class="w-full h-full object-cover" />
            </button>
          </div>

          <!-- Main Image -->
          <div class="relative flex-1 rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-900 aspect-[3/4]">
            <img id="productMainImg"
              src="https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp"
              class="w-full h-full object-cover transition duration-300" />

            <!-- Discount Badge -->
            <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white text-black shadow">
              15% OFF
            </span>

            <!-- Wishlist Heart Button -->
            <button id="productWishBtn"
              class="absolute top-3.5 right-3.5 w-9 h-9 rounded-xl bg-black/25 hover:bg-black/50 backdrop-blur-md text-white flex items-center justify-center transition"
              aria-label="Add to Wishlist"
              onclick="toggleWishlist(this)">
              <svg id="productWishIcon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
            </button>

            <!-- New In Tag -->
            <span class="absolute bottom-3.5 left-3.5 px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-black/70 backdrop-blur-sm text-white">
              New In
            </span>
          </div>
        </div>

        <!-- RIGHT: Product Info -->
        <div class="flex flex-col gap-5">

          <!-- Category Label -->
          <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-neutral-400">T-Shirt • Red / White</span>

          <!-- Product Title & Price -->
          <div>
            <h1 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight leading-tight mb-2">
              Old Skool — Red Raglan Tee
            </h1>
            <div class="flex items-center gap-3">
              <span class="font-bold text-xl sm:text-2xl">₹1,099</span>
              <span class="text-sm text-red-500 dark:text-red-400 line-through">₹1,299</span>
              <span class="text-xs font-semibold text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 px-2 py-0.5 rounded-full">Save ₹200</span>
            </div>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Inclusive of all taxes · Free delivery above ₹499</p>
          </div>

          <!-- Rating Row -->
          <div class="flex items-center gap-2 pb-5 border-b border-neutral-100 dark:border-neutral-900">
            <div class="flex items-center gap-0.5 text-xs tracking-widest">★★★★★</div>
            <span class="text-xs font-semibold">4.9</span>
            <span class="text-xs text-neutral-400">(128 reviews)</span>
            <span class="ml-auto text-xs font-semibold text-neutral-500 hover:text-black dark:hover:text-white underline underline-offset-4 cursor-pointer">
              Read Reviews
            </span>
          </div>

          <!-- Color Selection -->
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs font-bold uppercase tracking-wider">Colour: <span class="font-semibold text-black dark:text-white">Red / White</span></span>
            </div>
            <div class="flex items-center gap-2">
              <button class="w-7 h-7 rounded-full bg-red-500 ring-2 ring-offset-2 ring-black dark:ring-offset-[#070707] dark:ring-white transition" aria-label="Red"></button>
              <button class="w-7 h-7 rounded-full bg-black dark:bg-white ring-2 ring-offset-2 ring-transparent hover:ring-black dark:hover:ring-white transition" aria-label="Black"></button>
              <button class="w-7 h-7 rounded-full bg-neutral-200 ring-2 ring-offset-2 ring-transparent hover:ring-neutral-500 transition" aria-label="Grey"></button>
              <button class="w-7 h-7 rounded-full bg-blue-800 ring-2 ring-offset-2 ring-transparent hover:ring-blue-800 transition" aria-label="Navy"></button>
            </div>
          </div>

          <!-- Size Selection -->
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-xs font-bold uppercase tracking-wider">Size</span>
              <button class="inline-flex items-center gap-1.5 text-xs font-medium text-neutral-500 dark:text-neutral-300 hover:text-black dark:hover:text-white underline underline-offset-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/></svg>
                Size Guide
              </button>
            </div>
            <div class="grid grid-cols-6 gap-2" id="sizeGrid">
              <button onclick="selectSize(this)" class="size-btn py-2 rounded-xl text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition bg-black text-white dark:bg-white dark:text-black">S</button>
              <button onclick="selectSize(this)" class="size-btn py-2 rounded-xl text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">M</button>
              <button onclick="selectSize(this)" class="size-btn py-2 rounded-xl text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">L</button>
              <button onclick="selectSize(this)" class="size-btn py-2 rounded-xl text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">XL</button>
              <button onclick="selectSize(this)" class="size-btn py-2 rounded-xl text-xs font-semibold border border-neutral-200 dark:border-neutral-800 hover:border-black dark:hover:border-white transition">2XL</button>
              <button onclick="selectSize(this)" class="size-btn py-2 rounded-xl text-xs font-semibold border border-neutral-200 dark:border-neutral-700 opacity-40 cursor-not-allowed line-through" disabled>3XL</button>
            </div>
            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-2 leading-relaxed">
              Model is 172cm (5'8") tall, weighs 72kg, and is wearing size <strong class="text-black dark:text-white">M</strong>.
            </p>
          </div>

          <!-- Quantity -->
          <div class="flex items-center gap-3">
            <span class="text-xs font-bold uppercase tracking-wider">Qty</span>
            <div class="flex items-center rounded-xl border border-neutral-200 dark:border-neutral-800 overflow-hidden">
              <button onclick="changeQty(-1)" class="w-9 h-9 flex items-center justify-center hover:bg-neutral-100 dark:hover:bg-neutral-900 transition text-lg font-light">−</button>
              <span id="qtyDisplay" class="w-10 text-center text-sm font-semibold">1</span>
              <button onclick="changeQty(1)" class="w-9 h-9 flex items-center justify-center hover:bg-neutral-100 dark:hover:bg-neutral-900 transition text-lg font-light">+</button>
            </div>
            <span class="text-xs text-neutral-400">Only 7 left in stock</span>
          </div>

          <!-- CTA Buttons -->
          <div class="flex flex-col gap-2.5 pt-1">
            <button id="addToBagBtn"
              class="w-full py-3.5 px-5 rounded-xl bg-black text-white dark:bg-white dark:text-black font-semibold text-xs uppercase tracking-[0.14em] flex items-center justify-center gap-2 hover:opacity-90 active:scale-[0.99] transition shadow-sm">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
              </svg>
              Add to Bag — S
            </button>
            <button class="w-full py-3.5 px-5 rounded-xl border border-neutral-300 dark:border-neutral-700 font-semibold text-xs uppercase tracking-[0.14em] flex items-center justify-center gap-2 hover:bg-neutral-50 dark:hover:bg-neutral-900 active:scale-[0.99] transition">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
              </svg>
              Save to Wishlist
            </button>
          </div>

          <!-- Trust Badges -->
          <div class="grid grid-cols-3 gap-2 pt-1">
            <div class="flex flex-col items-center gap-1 p-3 rounded-xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800 text-center">
              <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
              <span class="text-[10px] font-semibold uppercase tracking-wider">100% Genuine</span>
            </div>
            <div class="flex flex-col items-center gap-1 p-3 rounded-xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800 text-center">
              <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
              <span class="text-[10px] font-semibold uppercase tracking-wider">Easy Returns</span>
            </div>
            <div class="flex flex-col items-center gap-1 p-3 rounded-xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800 text-center">
              <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
              <span class="text-[10px] font-semibold uppercase tracking-wider">Fast Dispatch</span>
            </div>
          </div>

          <!-- Craft Details Accordion -->
          <div class="border-t border-neutral-200 dark:border-neutral-800 pt-4 space-y-3">

            <!-- Description -->
            <details class="group">
              <summary class="flex items-center justify-between cursor-pointer text-xs font-bold uppercase tracking-wider py-2">
                <span>Product Details</span>
                <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
              </summary>
              <div class="pt-3 pb-1 text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed space-y-2">
                <p>The Old Skool Raglan Tee is built for those who move with purpose. Heavyweight 380 GSM French Terry fabric ensures structure and durability while keeping you comfortable all day.</p>
                <ul class="space-y-1 list-none">
                  <li class="flex items-start gap-2"><span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-black dark:bg-white shrink-0"></span>Fabric: 100% Premium Cotton / 380 GSM</li>
                  <li class="flex items-start gap-2"><span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-black dark:bg-white shrink-0"></span>Fit: Oversized / Drop Shoulder</li>
                  <li class="flex items-start gap-2"><span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-black dark:bg-white shrink-0"></span>Collar: Round Neck / Ribbed</li>
                  <li class="flex items-start gap-2"><span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-black dark:bg-white shrink-0"></span>Sleeve: 3/4 Raglan Contrast Sleeve</li>
                  <li class="flex items-start gap-2"><span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-black dark:bg-white shrink-0"></span>Care: Machine Wash Cold, Tumble Dry Low</li>
                </ul>
              </div>
            </details>

            <!-- Delivery & Returns -->
            <details class="group border-t border-neutral-100 dark:border-neutral-900">
              <summary class="flex items-center justify-between cursor-pointer text-xs font-bold uppercase tracking-wider py-2">
                <span>Delivery &amp; Returns</span>
                <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
              </summary>
              <div class="pt-3 pb-1 text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed space-y-2">
                <p>🚚 <strong class="text-black dark:text-white">Order Today, Dispatched Today</strong> — Orders placed before 2PM ship same day.</p>
                <p>📦 Free delivery on orders above ₹499. Standard delivery in 3-5 business days.</p>
                <p>🔁 Easy 7-day returns. Items must be unworn, unwashed, with original tags.</p>
              </div>
            </details>

            <!-- Size & Fit -->
            <details class="group border-t border-neutral-100 dark:border-neutral-900">
              <summary class="flex items-center justify-between cursor-pointer text-xs font-bold uppercase tracking-wider py-2">
                <span>Size &amp; Fit</span>
                <svg class="w-4 h-4 transition group-open:rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
              </summary>
              <div class="pt-3 pb-1">
                <div class="overflow-x-auto">
                  <table class="w-full text-xs text-left">
                    <thead>
                      <tr class="border-b border-neutral-200 dark:border-neutral-800">
                        <th class="pb-2 font-bold uppercase tracking-wider text-neutral-500">Size</th>
                        <th class="pb-2 font-bold uppercase tracking-wider text-neutral-500">Chest (in)</th>
                        <th class="pb-2 font-bold uppercase tracking-wider text-neutral-500">Length (in)</th>
                        <th class="pb-2 font-bold uppercase tracking-wider text-neutral-500">Shoulder (in)</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 dark:divide-neutral-900 text-neutral-600 dark:text-neutral-400">
                      <tr><td class="py-2 font-semibold text-black dark:text-white">S</td><td class="py-2">38</td><td class="py-2">27</td><td class="py-2">17</td></tr>
                      <tr><td class="py-2 font-semibold text-black dark:text-white">M</td><td class="py-2">40</td><td class="py-2">28</td><td class="py-2">18</td></tr>
                      <tr><td class="py-2 font-semibold text-black dark:text-white">L</td><td class="py-2">42</td><td class="py-2">29</td><td class="py-2">18.5</td></tr>
                      <tr><td class="py-2 font-semibold text-black dark:text-white">XL</td><td class="py-2">44</td><td class="py-2">30</td><td class="py-2">19</td></tr>
                      <tr><td class="py-2 font-semibold text-black dark:text-white">2XL</td><td class="py-2">46</td><td class="py-2">31</td><td class="py-2">20</td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </details>

          </div>
        </div>
      </div>
    </section>

    <!-- MARQUEE RIBBON -->
    <div class="ribbon-tilt-left bg-black text-white dark:bg-white dark:text-black py-3.5 shadow-lg border-y border-neutral-800 dark:border-neutral-200 overflow-hidden my-10">
      <div class="flex whitespace-nowrap animate-marquee font-display text-sm font-bold tracking-[0.22em] uppercase">
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

    <!-- CUSTOMER REVIEWS SECTION -->
    <section class="py-14 px-4 sm:px-6 max-w-7xl mx-auto border-t border-neutral-200 dark:border-neutral-800">
      <div class="flex items-center justify-between mb-6">
        <div>
          <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-neutral-400">Customer Feedback</span>
          <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight mt-1">What They Say</h2>
        </div>
        <span class="text-xs font-semibold px-3 py-1.5 rounded-full bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">4.9 ★ (128 Reviews)</span>
      </div>

      <!-- Rating Bar Summary -->
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mb-8">
        <div class="space-y-2">
          <div class="flex items-center gap-3 text-xs">
            <span class="w-4 text-right font-semibold">5</span>
            <div class="flex-1 h-2 rounded-full bg-neutral-100 dark:bg-neutral-900 overflow-hidden">
              <div class="h-full rounded-full bg-black dark:bg-white" style="width: 82%"></div>
            </div>
            <span class="text-neutral-400 w-6">82%</span>
          </div>
          <div class="flex items-center gap-3 text-xs">
            <span class="w-4 text-right font-semibold">4</span>
            <div class="flex-1 h-2 rounded-full bg-neutral-100 dark:bg-neutral-900 overflow-hidden">
              <div class="h-full rounded-full bg-black dark:bg-white" style="width: 12%"></div>
            </div>
            <span class="text-neutral-400 w-6">12%</span>
          </div>
          <div class="flex items-center gap-3 text-xs">
            <span class="w-4 text-right font-semibold">3</span>
            <div class="flex-1 h-2 rounded-full bg-neutral-100 dark:bg-neutral-900 overflow-hidden">
              <div class="h-full rounded-full bg-black dark:bg-white" style="width: 4%"></div>
            </div>
            <span class="text-neutral-400 w-6">4%</span>
          </div>
          <div class="flex items-center gap-3 text-xs">
            <span class="w-4 text-right font-semibold">2</span>
            <div class="flex-1 h-2 rounded-full bg-neutral-100 dark:bg-neutral-900 overflow-hidden">
              <div class="h-full rounded-full bg-black dark:bg-white" style="width: 2%"></div>
            </div>
            <span class="text-neutral-400 w-6">2%</span>
          </div>
          <div class="flex items-center gap-3 text-xs">
            <span class="w-4 text-right font-semibold">1</span>
            <div class="flex-1 h-2 rounded-full bg-neutral-100 dark:bg-neutral-900 overflow-hidden">
              <div class="h-full rounded-full bg-black dark:bg-white" style="width: 0%"></div>
            </div>
            <span class="text-neutral-400 w-6">0%</span>
          </div>
        </div>

        <!-- Write Review CTA -->
        <div class="flex flex-col justify-center gap-3 p-5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/70 border border-neutral-200 dark:border-neutral-800">
          <p class="text-sm font-medium">Share your experience with this product</p>
          <button class="w-full py-3 px-5 rounded-xl bg-black text-white dark:bg-white dark:text-black font-semibold text-xs uppercase tracking-[0.14em] hover:opacity-90 transition">
            Write a Review
          </button>
        </div>
      </div>

      <!-- Review Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="p-5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 flex flex-col justify-between">
          <div>
            <div class="text-xs tracking-widest mb-2">★★★★★</div>
            <p class="text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">"Absolutely love the quality. The fabric feels premium and the oversized fit is exactly what I wanted. Will definitely order again!"</p>
          </div>
          <div class="mt-4 pt-3 border-t border-neutral-200 dark:border-neutral-800 flex items-center justify-between text-[11px]">
            <span class="font-bold">Devkrishna</span>
            <span class="text-neutral-400">Verified ✓</span>
          </div>
        </div>
        <div class="p-5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 flex flex-col justify-between">
          <div>
            <div class="text-xs tracking-widest mb-2">★★★★★</div>
            <p class="text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">"The raglan sleeve detail is a nice touch. Sizing is true to chart. Perfect for everyday wear. Very happy with the purchase."</p>
          </div>
          <div class="mt-4 pt-3 border-t border-neutral-200 dark:border-neutral-800 flex items-center justify-between text-[11px]">
            <span class="font-bold">Rajan M.</span>
            <span class="text-neutral-400">Verified ✓</span>
          </div>
        </div>
        <div class="p-5 rounded-2xl bg-neutral-50 dark:bg-neutral-900/80 border border-neutral-200 dark:border-neutral-800 flex flex-col justify-between">
          <div>
            <div class="text-xs tracking-widest mb-2">★★★★☆</div>
            <p class="text-xs text-neutral-600 dark:text-neutral-300 leading-relaxed">"Great tee, delivered super fast. The colour is vibrant and the stitching is clean. Went one size up for a more relaxed fit."</p>
          </div>
          <div class="mt-4 pt-3 border-t border-neutral-200 dark:border-neutral-800 flex items-center justify-between text-[11px]">
            <span class="font-bold">Aryan S.</span>
            <span class="text-neutral-400">Verified ✓</span>
          </div>
        </div>
      </div>
    </section>

    <!-- YOU MIGHT ALSO LIKE -->
    <section class="py-14 px-4 sm:px-6 max-w-7xl mx-auto border-t border-neutral-200 dark:border-neutral-800">
      <div class="flex items-center justify-between mb-6">
        <div>
          <span class="text-[11px] font-bold uppercase tracking-[0.22em] text-neutral-400">More Picks</span>
          <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase tracking-tight mt-1">You Might Also Like</h2>
        </div>
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
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">10% OFF</span>
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
            <img src="https://user52064.na.imgto.link/public/20261105/681688e9ef6f7da8af1cb7bf-effortless-minimalist-streetwear-outfit-removebg-preview.avif" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-black text-white shadow-sm">Trending</span>
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

        <div class="group relative flex flex-col rounded-2xl overflow-hidden border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900/50 hover:shadow-lg transition-shadow">
          <div class="relative aspect-[3/4] overflow-hidden bg-neutral-100 dark:bg-neutral-900">
            <img src="https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
            <span class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white text-black shadow-sm">15% OFF</span>
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

      </div>
    </section>

  </main>

  @include('layouts.footer')

  <script>
    // Image Switcher
    function switchImage(btn, src) {
      document.getElementById('productMainImg').src = src;
      document.querySelectorAll('.thumb-btn').forEach(function(b) {
        b.classList.remove('border-black', 'dark:border-white');
        b.classList.add('border-transparent');
      });
      btn.classList.remove('border-transparent');
      btn.classList.add('border-black', 'dark:border-white');
    }

    // Size Selector
    function selectSize(btn) {
      if (btn.disabled) { return; }
      document.querySelectorAll('.size-btn').forEach(function(b) {
        b.classList.remove('bg-black', 'text-white', 'dark:bg-white', 'dark:text-black');
      });
      btn.classList.add('bg-black', 'text-white', 'dark:bg-white', 'dark:text-black');
      document.getElementById('addToBagBtn').textContent = 'Add to Bag — ' + btn.textContent.trim();
    }

    // Quantity
    var qty = 1;
    function changeQty(delta) {
      qty = Math.max(1, Math.min(10, qty + delta));
      document.getElementById('qtyDisplay').textContent = qty;
    }

    // Wishlist Heart Toggle
    function toggleWishlist(btn) {
      var icon = btn.querySelector('svg');
      var filled = icon.getAttribute('fill') === 'currentColor';
      icon.setAttribute('fill', filled ? 'none' : 'currentColor');
    }
  </script>

</body>
</html>

