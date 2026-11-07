@props(['path' => null, 'size' => 'sm', 'alt' => 'Profile photo'])

<img
    src="{{ $path ? asset('storage/' . $path) : asset('assets/image/no-profile.jpg') }}"
    alt="{{ $alt }}"
    class="avatar avatar--{{ $size }}"
>