@props([
    'title',
    'description' => null,
    'noun' => 'record',
    'records' => [],
    'paginator' => null,
    'columns' => [],
    'badges' => [],
    'details' => [],
    'filterKey' => null,
    'store' => null,
    'update' => null,
    'destroy' => null,
    'param' => 'id',
])

@php
    $plural = \Illuminate\Support\Str::plural($noun);
    $titleKey = array_key_first($columns);
    $total = $paginator && method_exists($paginator, 'total') ? $paginator->total() : count($records);
    $filterValues = $filterKey ? collect($records)->pluck($filterKey)->filter()->unique()->values()->all() : [];
    $emptyText = $paginator === null
        ? 'This page has not received data from the server yet.'
        : 'Records you add will appear here.';
@endphp

<div class="page-header page-header--split">
    <div>
        <h1 class="page-header__title font-display">{{ $title }}</h1>
        @if ($description)
            <p class="page-header__desc">{{ $description }}</p>
        @endif
    </div>

    @if (filled($store))
        <button type="button" class="btn btn--primary" data-activity-open="create">+ {{ __('New') }} {{ $noun }}</button>
    @endif
</div>

<div class="stat-grid stat-grid--compact">
    <x-ui.stat-card :title="'Total '.$plural" :value="$total" />
    {{ $summary ?? '' }}
</div>

<section class="table-card" aria-label="{{ $title }}">
    @if (count($records))
        <div class="admin-toolbar">
            <label class="admin-search">
                <span class="sr-only">{{ __('Search') }}</span>
                <input type="search" class="form-input" placeholder="{{ __('Search this page…') }}" data-table-search>
            </label>

            @if (count($filterValues))
                <select class="form-input admin-filter" data-table-filter aria-label="{{ __('Filter by') }} {{ $columns[$filterKey] ?? 'status' }}">
                    <option value="">{{ __('All') }}</option>
                    @foreach ($filterValues as $value)
                        <option value="{{ strtolower($value) }}">{{ ucfirst($value) }}</option>
                    @endforeach
                </select>
            @endif
        </div>

        <div class="table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        @foreach ($columns as $label)
                            <th scope="col">{{ $label }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                        <tr
                            class="admin-table__row"
                            tabindex="0"
                            role="button"
                            aria-label="{{ __('View details') }}"
                            data-record="{{ json_encode($record) }}"
                            data-record-id="{{ $record['id'] }}"
                            data-filter-value="{{ strtolower((string) ($record[$filterKey] ?? '')) }}"
                        >
                            @foreach ($columns as $key => $label)
                                <td data-label="{{ $label }}" class="{{ $loop->first ? 'admin-table__primary' : '' }}">
                                    @if (in_array($key, $badges, true) && filled($record[$key] ?? null))
                                        <x-ui.status-badge :status="$record[$key]" />
                                    @else
                                        {{ filled($record[$key] ?? null) ? $record[$key] : '—' }}
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="admin-no-results" data-no-results hidden>{{ __('No matching records on this page.') }}</p>

        @if ($paginator && method_exists($paginator, 'links'))
            <div class="admin-pagination">{{ $paginator->links() }}</div>
        @endif
    @else
        <x-ui.empty-state :title="'No '.$plural.' yet'" :description="$emptyText" />
    @endif
</section>

@push('activity-panel')
    <x-activity-panel
        :noun="$noun"
        :store="$store"
        :update="$update"
        :destroy="$destroy"
        :param="$param"
        :details="$details"
        :title-key="$titleKey"
    >
        <x-slot:fields>{{ $fields ?? '' }}</x-slot:fields>
    </x-activity-panel>
@endpush