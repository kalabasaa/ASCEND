@props(['title', 'description' => null])

<div class="page-header">
    <h1 class="page-header__title">{{ $title }}</h1>
    @if ($description)
        <p class="page-header__desc">{{ $description }}</p>
    @endif
</div>