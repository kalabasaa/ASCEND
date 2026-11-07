@props([
    'name',
    'label',
    'type' => 'text',
    'options' => [],
    'required' => false,
    'hint' => null,
    'default' => null,
    'min' => null,
    'step' => null,
    'placeholder' => null,
])

@php
    $control = $type === 'relation' ? (count($options) ? 'select' : 'number') : $type;
    $missingList = $type === 'relation' && ! count($options);
@endphp

<label class="form-field">
    <span class="form-field__label">
        {{ $label }}
        @if ($required)
            <span class="form-field__req" aria-hidden="true">*</span>
        @endif
    </span>

    @if ($control === 'select')
        <select name="{{ $name }}" class="form-input" @required($required)>
            <option value="">{{ $required ? 'Select…' : '—' }}</option>
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" @selected((string) $default === (string) $value)>{{ $text }}</option>
            @endforeach
        </select>
    @elseif ($control === 'textarea')
        <textarea name="{{ $name }}" rows="3" class="form-input" @required($required)>{{ $default }}</textarea>
    @else
        <input
            type="{{ $control }}"
            name="{{ $name }}"
            value="{{ $default }}"
            class="form-input"
            @required($required)
            @if ($control === 'number' && $min !== null) min="{{ $min }}" @endif
            @if ($step) step="{{ $step }}" @endif
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
        >
    @endif

    @if ($hint)
        <span class="form-field__hint">{{ $hint }}</span>
    @endif

    @if ($missingList)
        <span class="form-field__hint">{{ __('Enter the record ID. A dropdown appears once the controller passes the list.') }}</span>
    @endif
</label>