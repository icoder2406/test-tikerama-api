@php
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $value ??= '';
    $label ??= '';
    $placeholder ??= '';
    $required_label ??= '';
    $help_text ??= '';
    $readonly ??= false;
    $min ??= 0;
    $step ??= 0.01;
@endphp
<div @class(['form-group', $class])>
    <label class="form-label" for="{{ $name }}">{{ $label ?: ucfirst($name) }} <span
            class="text-danger">{{ $required_label }}</span></label>
    <small class="text-muted">{{ $help_text }}</small>
    @if ($type == 'number')
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
            name="{{ $name }}" value="{{ old($name, $value) }}" min="{{ $min }}"
            step="{{ $step }}" placeholder="{{ $placeholder }}" {{$readonly ? 'readonly' : ''}}>
    @elseif ($type == 'textarea')
        <textarea @class(['form-control summernote', $class]) name="{{ $name }}" id="{{ $name }}">
            {{ old($name, $value) }}
    </textarea>
    @else
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}" {{$readonly ? 'readonly' : ''}}>
    @endif

    @error($name)
        <span class="text-danger">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
