<nav class="settings-nav" aria-label="Settings">
  <a
    href="{{ route('admin.settings') }}"
    @class(['settings-nav-link', 'active' => request()->routeIs('admin.settings')])
    @if (request()->routeIs('admin.settings')) aria-current="page" @endif
  >
    <span class="settings-nav-icon">@include('admin.settings.partials.icon', ['name' => 'grid'])</span>
    <span>Overview</span>
  </a>

  @foreach (config('admin_settings.groups', []) as $group)
    <p class="settings-nav-group">{{ $group['label'] }}</p>

    @foreach ($group['items'] as $item)
      @if (filled($item['route'] ?? null))
        @php($isActive = request()->routeIs($item['active'] ?? $item['route']))

        <a
          href="{{ route($item['route']) }}"
          @class(['settings-nav-link', 'active' => $isActive])
          @if ($isActive) aria-current="page" @endif
        >
          <span class="settings-nav-icon">@include('admin.settings.partials.icon', ['name' => $item['icon'] ?? null])</span>
          <span>{{ $item['label'] }}</span>
        </a>
      @else
        <span class="settings-nav-link is-disabled" aria-disabled="true">
          <span class="settings-nav-icon">@include('admin.settings.partials.icon', ['name' => $item['icon'] ?? null])</span>
          <span>{{ $item['label'] }}</span>
          <span class="settings-nav-soon">Soon</span>
        </span>
      @endif
    @endforeach
  @endforeach
</nav>
