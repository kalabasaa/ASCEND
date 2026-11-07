@props(['title', 'subtitle' => null, 'value' => null, 'valueSub' => null])

<div class="data-card">
    <div class="data-card__main">
        <div class="data-card__title">{{ $title }}</div>
        @if ($subtitle)
            <div class="data-card__sub">{{ $subtitle }}</div>
        @endif
    </div>
    @if ($value !== null)
        <div class="data-card__meta">
            <div class="data-card__value">{{ $value }}</div>
            @if ($valueSub)
                <div class="data-card__value-sub">{{ $valueSub }}</div>
            @endif
        </div>
    @endif
</div>