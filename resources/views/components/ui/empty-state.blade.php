@props(['title' => 'Nothing here yet', 'description' => null])

<div class="empty-state">
    <svg class="empty-state__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
        <rect x="3" y="4" width="18" height="16" rx="2"/>
        <path d="M3 10h18M8 15h3"/>
    </svg>
    <div class="empty-state__title">{{ $title }}</div>
    @if ($description)
        <p class="empty-state__desc">{{ $description }}</p>
    @endif
</div>