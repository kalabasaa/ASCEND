@props([
    'noun' => 'record',
    'store' => null,
    'update' => null,
    'destroy' => null,
    'param' => 'id',
    'details' => [],
    'titleKey' => null,
])

@php
    $storeUrl = $store && Route::has($store) ? route($store) : null;
    $updateUrl = $update && Route::has($update) ? route($update, [$param => '__ID__']) : null;
    $destroyUrl = $destroy && Route::has($destroy) ? route($destroy, [$param => '__ID__']) : null;
    $canCreate = filled($store);
    $canEdit = filled($update);
    $canDelete = filled($destroy);
    $oldInput = collect(old())->except(['_token'])->all();
@endphp

<aside
    class="activity-panel"
    id="activity-panel"
    tabindex="-1"
    aria-label="{{ ucfirst($noun) }} {{ __('activity') }}"
    data-activity-panel
    data-title-key="{{ $titleKey }}"
    data-update-url="{{ $updateUrl }}"
    data-destroy-url="{{ $destroyUrl }}"
    data-initial-tab="{{ old('_activity', 'details') }}"
    data-initial-record="{{ old('_record_id') }}"
    data-old="{{ json_encode($oldInput) }}"
>
    <div class="activity-panel__head">
        <div class="activity-tabs" role="tablist" aria-label="{{ __('Activity') }}">
            <button type="button" role="tab" class="activity-tab" data-activity-tab="create" @disabled(! $canCreate)>{{ __('Create') }}</button>
            <button type="button" role="tab" class="activity-tab" data-activity-tab="edit" @disabled(! $canEdit)>{{ __('Edit') }}</button>
            <button type="button" role="tab" class="activity-tab" data-activity-tab="details">{{ __('Details') }}</button>
        </div>

        <button type="button" class="activity-close" data-activity-close aria-label="{{ __('Close panel') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
        </button>
    </div>

    <div class="activity-panel__body">

        @if ($errors->any() && old('_activity'))
            <div class="flash flash--error" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="activity-view" data-activity-view="create" role="tabpanel" hidden>
            @if ($canCreate)
                <h2 class="activity-view__title">{{ __('New') }} {{ $noun }}</h2>

                <form method="POST" action="{{ $storeUrl ?? '#' }}" class="activity-form" data-loading-form data-create-form>
                    @csrf
                    <input type="hidden" name="_activity" value="create">

                    {{ $fields }}

                    @unless ($storeUrl)
                        <p class="form-note">{{ __('This form is not connected to the backend yet.') }}</p>
                    @endunless

                    <div class="activity-form__actions">
                        <button type="submit" class="btn btn--primary" data-loading-label="{{ __('Saving…') }}" @disabled(! $storeUrl)>{{ __('Create') }} {{ $noun }}</button>
                    </div>
                </form>
            @else
                <x-ui.empty-state title="Creating is not available" :description="'New '.\Illuminate\Support\Str::plural($noun).' cannot be added from this page.'" />
            @endif
        </section>

        <section class="activity-view" data-activity-view="edit" role="tabpanel" hidden>
            @if ($canEdit)
                <div data-empty>
                    <x-ui.empty-state title="No record selected" description="Select a row in the list, then choose Edit." />
                </div>

                <div data-record-content hidden>
                    <h2 class="activity-view__title">{{ __('Editing') }}: <span data-record-title></span></h2>

                    <form method="POST" action="#" class="activity-form" data-loading-form data-edit-form>
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="_activity" value="edit">
                        <input type="hidden" name="_record_id" value="">

                        {{ $fields }}

                        @unless ($updateUrl)
                            <p class="form-note">{{ __('This form is not connected to the backend yet.') }}</p>
                        @endunless

                        <div class="activity-form__actions">
                            <button type="submit" class="btn btn--primary" data-loading-label="{{ __('Saving…') }}" @disabled(! $updateUrl)>{{ __('Save changes') }}</button>
                        </div>
                    </form>
                </div>
            @else
                <x-ui.empty-state title="Editing is not available" :description="ucfirst(\Illuminate\Support\Str::plural($noun)).' are read-only on this page.'" />
            @endif
        </section>

        <section class="activity-view" data-activity-view="details" role="tabpanel">
            <div data-empty>
                <x-ui.empty-state title="No record selected" description="Select a row in the list to see its details." />
            </div>

            <div data-record-content hidden>
                <h2 class="activity-view__title" data-record-title></h2>

                <div class="activity-details">
                    @foreach ($details as $key => $label)
                        <div class="info-row">
                            <span class="info-row__label">{{ $label }}</span>
                            <span class="info-row__value" data-field="{{ $key }}">—</span>
                        </div>
                    @endforeach
                </div>

                <div class="activity-form__actions">
                    @if ($canEdit)
                        <button type="button" class="btn btn--ghost" data-activity-open="edit">{{ __('Edit') }}</button>
                    @endif

                    @if ($canDelete)
                        <form method="POST" action="#" data-delete-form data-confirm="{{ __('Delete this') }} {{ $noun }}? {{ __('This cannot be undone.') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn--danger" @disabled(! $destroyUrl)>{{ __('Delete') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>

    </div>
</aside>