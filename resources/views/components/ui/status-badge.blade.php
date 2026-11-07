@props(['status' => 'neutral', 'label' => null])

@php
    $variant = match (strtolower($status)) {
        'active', 'paid', 'completed', 'in stock' => 'success',
        'pending', 'expiring', 'low stock' => 'warning',
        'expired', 'cancelled', 'inactive', 'failed', 'out of stock' => 'danger',
        default => 'neutral',
    };
@endphp

<span class="status-badge status-badge--{{ $variant }}">{{ $label ?? ucfirst($status) }}</span>