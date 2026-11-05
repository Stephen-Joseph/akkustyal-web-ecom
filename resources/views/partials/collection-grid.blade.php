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