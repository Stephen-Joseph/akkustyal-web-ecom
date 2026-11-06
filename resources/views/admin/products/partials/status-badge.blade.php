@php
  $statusValue = $status?->value ?? 'draft';
  $statusClass = match ($statusValue) {
      'active' => 'badge-green',
      'draft' => 'badge-purple',
      default => 'badge-muted',
  };
@endphp

<span class="badge badge-dot {{ $statusClass }}">{{ ucfirst($statusValue) }}</span>
