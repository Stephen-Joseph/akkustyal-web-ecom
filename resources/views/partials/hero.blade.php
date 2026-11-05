<section class="relative bg-[#050505] text-white overflow-hidden">

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 items-center min-h-[480px] sm:min-h-[560px]">

        {{-- TEXT COLUMN --}}
        <div class="lg:col-span-5 px-6 sm:px-10 py-12 lg:py-20 z-10 order-2 lg:order-1">

            <h1 class="font-display text-4xl sm:text-6xl font-bold uppercase tracking-tight leading-[0.95] mb-3">
                {{ $hero->headline }}
            </h1>

            <p class="text-neutral-300 text-sm sm:text-base font-medium tracking-wide mb-7">
                {{ $hero->description }}
            </p>

            <div class="flex flex-wrap items-center gap-3">

                <a
                    id="heroChaseBtn"
                    href="{{ $hero->primary_button_url }}"
                    class="inline-flex px-8 py-3.5 rounded-full bg-white text-black font-bold text-xs uppercase tracking-[0.2em] hover:bg-neutral-200 transition shadow-lg"
                >
                    {{ $hero->primary_button_text }}
                </a>

                <a
                    id="heroExploreSpotlightBtn"
                    href="{{ $hero->secondary_button_url }}"
                    class="inline-flex px-6 py-3.5 rounded-full border border-white/30 text-white font-semibold text-xs uppercase tracking-[0.16em] hover:bg-white/10 transition"
                >
                    {{ $hero->secondary_button_text }}
                </a>

            </div>

            {{-- STATISTICS --}}
            <div class="mt-10 pt-6 border-t border-white/10 flex items-center gap-8 text-xs text-neutral-400">

                <div>
                    <strong class="text-white text-base font-display block">
                        {{ $hero->stat_1_value }}
                    </strong>
                    {{ $hero->stat_1_label }}
                </div>

                <div>
                    <strong class="text-white text-base font-display block">
                        {{ $hero->stat_2_value }}
                    </strong>
                    {{ $hero->stat_2_label }}
                </div>

                <div>
                    <strong class="text-white text-base font-display block">
                        {{ $hero->stat_3_value }}
                    </strong>
                    {{ $hero->stat_3_label }}
                </div>

            </div>

        </div>

        {{-- HERO IMAGE --}}
        <div class="lg:col-span-7 relative h-[320px] sm:h-[440px] lg:h-[560px] w-full order-1 lg:order-2">

            <img
                src="{{ $hero->image_path
                    ? asset('storage/'.$hero->image_path)
                    : 'https://user52064.na.imgto.link/public/20261105/681688e9ef6f7da8af1cb7bf-effortless-minimalist-streetwear-outfit-removebg-preview.avif' }}"
                alt="{{ $hero->headline }}"
                class="w-full h-full object-contain object-center"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-transparent to-transparent lg:bg-gradient-to-r lg:from-[#050505] lg:via-transparent lg:to-transparent"></div>

        </div>

    </div>

</section>