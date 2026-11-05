@php
  $available = filled($item['route'] ?? null);
  $tag = $available ? 'a' : 'div';
@endphp

<{{ $tag }}
  @if ($available) href="{{ route($item['route']) }}" @else aria-disabled="true" @endif
  @class(['settings-card', 'is-disabled' => ! $available])
>
  <div class="settings-card-top">
    <span class="settings-card-icon">
      @include('admin.settings.partials.icon', ['name' => $item['icon'] ?? null])
    </span>

    @if ($available)
      <span class="settings-card-arrow">
        @include('admin.settings.partials.icon', ['name' => 'arrow'])
      </span>
    @endif
  </div>

  <h3 class="settings-card-title">{{ $item['label'] }}</h3>
  <p class="settings-card-desc">{{ $item['description'] }}</p>

  <span @class(['status-badge', 'is-live' => $available, 'is-soon' => ! $available])>
    {{ $available ? 'Available' : 'Coming soon' }}
  </span>
</{{ $tag }}>
