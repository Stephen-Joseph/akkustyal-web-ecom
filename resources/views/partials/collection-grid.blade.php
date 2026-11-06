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
        @if (isset($categoriesList) && count($categoriesList))
          @foreach ($categoriesList as $cat)
            <button data-cat-tab="{{ $cat }}" class="px-3.5 py-1.5 rounded-full text-xs font-semibold transition border {{ $loop->first ? 'bg-black text-white border-black dark:bg-white dark:text-black dark:border-white' : 'bg-transparent text-neutral-600 border-neutral-200 dark:text-neutral-400 dark:border-neutral-800 hover:border-black dark:hover:border-white' }}">
              {{ $cat }}
            </button>
          @endforeach
        @endif
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
    @if (isset($products) && $products->isNotEmpty())
      @foreach ($products as $index => $product)
        @php
          $firstVariant = $product->variants->first();
          $firstPrice = $firstVariant?->prices->first();
          $retailPrice = (float) ($firstPrice?->retail_price ?? 999);
          $msrpPrice = $firstPrice?->msrp_price ? (float) $firstPrice->msrp_price : null;
          $categoryName = $product->categories->first()?->name ?? 'Collection';
          $brandName = $product->brand?->name ?? 'AkkuStyle';
          $colorName = $firstVariant?->variant_options['color'] ?? ($product->base_attributes['fabric'] ?? 'Standard');

          $sizes = $product->variants->map(fn($v) => $v->variant_options['size'] ?? $v->name)->filter()->unique()->values()->all();
          if (empty($sizes)) {
              $sizes = ['S', 'M', 'L', 'XL'];
          }
          $chosenSize = $sizes[0];

          $fallbacks = [
              'https://www.shaadidukaan.com/vogue/wp-content/uploads/2026/01/Men-formal-outfit-3.webp',
              'https://blackberrys.com/cdn/shop/files/Plum_Solid_Shirt_Sylvia-MS015529U1-image1_36730d14-ac20-4d20-996a-85f22389874b_533x.jpg?v=1780986562',
              'https://louisphilippe.abfrl.in/blog/wp-content/uploads/2023/09/JPP3308-1.jpg',
              'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?auto=format&fit=crop&w=800&q=80',
              'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?auto=format&fit=crop&w=800&q=80',
          ];
          $imageSrc = !empty($firstVariant?->media_gallery) ? $firstVariant->media_gallery[0] : $fallbacks[$index % count($fallbacks)];

          $badge = null;
          if ($msrpPrice && $msrpPrice > $retailPrice) {
              $badge = round((($msrpPrice - $retailPrice) / $msrpPrice) * 100) . '% OFF';
          } elseif ($product->created_at && $product->created_at->diffInDays(now()) < 14) {
              $badge = 'NEW';
          }
        @endphp

        <article class="group flex flex-col justify-between">
          <div>
            <!-- Card Image Box -->
            <div class="relative aspect-[3/4] rounded-2xl overflow-hidden bg-neutral-100 dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800">
              <!-- Top-left indicator lines -->
              <div class="absolute top-3 left-3 z-10 flex items-center gap-1">
                <span class="w-4 h-1 rounded-full bg-black dark:bg-white"></span>
                <span class="w-1.5 h-1 rounded-full bg-black/30 dark:bg-white/30"></span>
                <span class="w-1.5 h-1 rounded-full bg-black/30 dark:bg-white/30"></span>
              </div>

              <!-- Wishlist Heart -->
              <button data-grid-wish="{{ $product->id }}" class="absolute top-2.5 right-2.5 z-10 w-8 h-8 rounded-full bg-black/20 hover:bg-black/40 backdrop-blur-xs text-white flex items-center justify-center transition" aria-label="Toggle Wishlist">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                </svg>
              </button>

              <a href="{{ route('pages.products.show', $product->slug) }}">
                <img data-open-pdp="{{ $product->id }}" src="{{ $imageSrc }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500 cursor-pointer" />
              </a>

              @if ($badge)
                <span class="absolute bottom-3 left-3 px-2.5 py-1 rounded-full bg-white text-black text-[10px] font-bold uppercase tracking-wider shadow">{{ $badge }}</span>
              @endif

              <!-- Quick Size Ruler / Inspection Icon -->
              <button data-open-pdp="{{ $product->id }}" class="absolute bottom-3 right-3 w-7 h-7 rounded-full bg-black/25 hover:bg-black/50 text-white flex items-center justify-center backdrop-blur-xs" title="Inspect Fit & Details">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>

            <!-- Product Meta -->
            <div class="mt-3">
              <h3 data-open-pdp="{{ $product->id }}" class="text-xs sm:text-sm font-bold uppercase tracking-wide truncate cursor-pointer hover:opacity-70">
                <a href="{{ route('pages.products.show', $product->slug) }}">{{ $product->name }}</a>
              </h3>
              <p class="text-[11px] text-neutral-500 dark:text-neutral-400 mt-0.5">{{ $categoryName }}</p>
              <p class="text-[11px] text-neutral-400 dark:text-neutral-500">{{ is_array($colorName) ? implode(', ', $colorName) : $colorName }}</p>
              <div class="flex items-center gap-2 mt-1.5">
                <span class="text-xs sm:text-sm font-bold">₹{{ number_format($retailPrice, 2) }}</span>
                @if ($msrpPrice && $msrpPrice > $retailPrice)
                  <span class="text-[11px] text-red-500 line-through">₹{{ number_format($msrpPrice, 2) }}</span>
                @endif
              </div>
            </div>
          </div>

          <!-- Size Selector Pills + Quick Add -->
          <div class="mt-3 pt-2">
            <div class="flex flex-wrap gap-1">
              @foreach (array_slice($sizes, 0, 5) as $sz)
                <button data-card-size-prod="{{ $product->id }}" data-card-size="{{ $sz }}" class="px-2.5 py-1 rounded-lg text-[11px] font-bold transition {{ $loop->first ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-neutral-100 text-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-800' }}">{{ $sz }}</button>
              @endforeach
            </div>
            <button data-card-add="{{ $product->id }}" class="mt-2.5 w-full py-2.5 rounded-xl bg-black text-white dark:bg-white dark:text-black text-[11px] font-bold uppercase tracking-wider hover:opacity-90 transition">
              + Add ({{ $chosenSize }})
            </button>
          </div>
        </article>
      @endforeach
    @else
      <div class="col-span-full py-14 text-center">
        <p class="text-sm text-neutral-500 mb-3">No products available in the catalog yet.</p>
      </div>
    @endif
  </div>
</section>
