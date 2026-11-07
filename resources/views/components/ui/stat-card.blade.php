@props(['title', 'value', 'description' => null, 'icon' => null])

<div class="stat-card">
    @if ($icon)
        <div class="stat-card__icon">{!! $icon !!}</div>
    @endif
    <div class="stat-card__value">{{ $value }}</div>
    <div class="stat-card__title">{{ $title }}</div>
    @if ($description)
        <div class="stat-card__desc">{{ $description }}</div>
    @endif
</div>