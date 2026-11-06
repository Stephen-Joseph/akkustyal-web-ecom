{{--
  Navigation card used on overview pages (settings, catalog).
  $item: label, description, icon, route (named route or null for "Coming soon"), optional meta.
--}}
@php
  $available = filled($item['route'] ?? null);
  $tag = $available ? 'a' : 'div';
@endphp

<{{ $tag }}
  @if ($available) href="{{ route($item['route']) }}" @else aria-disabled="true" @endif
  @class(['section-card', 'is-disabled' => ! $available])
>
  <div class="section-card-top">
    <span class="section-card-icon">
      @include('admin.partials.icon', ['name' => $item['icon'] ?? null])
    </span>

    @if ($available)
      <span class="section-card-arrow">
        @include('admin.partials.icon', ['name' => 'arrow'])
      </span>
    @endif
  </div>

  <h3 class="section-card-title">{{ $item['label'] }}</h3>
  <p class="section-card-desc">{{ $item['description'] }}</p>

  <div class="section-card-footer">
    <span @class(['status-badge', 'is-live' => $available, 'is-soon' => ! $available])>
      {{ $available ? 'Available' : 'Coming soon' }}
    </span>

    @isset($item['meta'])
      <span class="section-card-meta">{{ $item['meta'] }}</span>
    @endisset
  </div>
</{{ $tag }}>
