@props(['title'])

<div class="info-card">
    <div class="info-card__title">{{ $title }}</div>
    <div>{{ $slot }}</div>
</div>