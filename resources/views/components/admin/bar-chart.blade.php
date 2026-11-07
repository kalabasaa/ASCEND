@props(['title' => 'Sales overview', 'data' => [], 'prefix' => '₱'])

@php
    $max = count($data) ? max(max($data), 1) : 1;
@endphp

<div class="info-card">
    <div class="info-card__title">{{ $title }}</div>

    @if (count($data))
        <div class="bar-chart" role="img" aria-label="{{ $title }}">
            @foreach ($data as $label => $value)
                <div class="bar-chart__col">
                    <span class="bar-chart__value">{{ $prefix }}{{ number_format($value) }}</span>
                    <div class="bar-chart__track">
                        <div class="bar-chart__bar" style="height: {{ round($value / $max * 100) }}%"></div>
                    </div>
                    <span class="bar-chart__label">{{ $label }}</span>
                </div>
            @endforeach
        </div>
    @else
        <div class="bar-chart bar-chart--placeholder" aria-hidden="true">
            @foreach ([40, 65, 50, 80, 55, 70, 45] as $height)
                <div class="bar-chart__col">
                    <div class="bar-chart__track">
                        <div class="bar-chart__bar skeleton" style="height: {{ $height }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="bar-chart__note">{{ __('Chart data will appear here once it is connected.') }}</p>
    @endif
</div>