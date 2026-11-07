@props(['title' => 'Recent activity', 'group' => 'activity'])

<div class="activity-panel">
    <div class="activity-panel__head">
        <span class="activity-panel__title">{{ $title }}</span>
        <div class="activity-panel__actions">
            <button type="button" class="activity-action-btn is-active" data-activity-switch="list" data-activity-target="{{ $group }}">{{ __('List') }}</button>
            <button type="button" class="activity-action-btn" data-activity-switch="create" data-activity-target="{{ $group }}">{{ __('Create') }}</button>
            <button type="button" class="activity-action-btn" data-activity-switch="edit" data-activity-target="{{ $group }}">{{ __('Edit') }}</button>
            <button type="button" class="activity-action-btn" data-activity-switch="details" data-activity-target="{{ $group }}">{{ __('Details') }}</button>
        </div>
    </div>

    <div class="activity-panel__body">
        <div class="activity-panel__view is-visible" data-activity-view="list" data-activity-group="{{ $group }}">
            {{ $list ?? '' }}
        </div>
        <div class="activity-panel__view" data-activity-view="create" data-activity-group="{{ $group }}">
            {{ $create ?? __('Create form goes here.') }}
        </div>
        <div class="activity-panel__view" data-activity-view="edit" data-activity-group="{{ $group }}">
            {{ $edit ?? __('Edit form goes here.') }}
        </div>
        <div class="activity-panel__view" data-activity-view="details" data-activity-group="{{ $group }}">
            {{ $details ?? __('Details view goes here.') }}
        </div>
    </div>
</div>