@props(['label'])

<div class="info-row">
    <span class="info-row__label">{{ $label }}</span>
    <span class="info-row__value">{{ $slot }}</span>
</div>