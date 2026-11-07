@props(['title', 'description' => null])

<div class="page-header">
    <h1 class="page-header-title">{{ $title }}</h1>
    @if ($description)
        <p class="page-header-description">{{ $description }}</p>
    @endif
</div>