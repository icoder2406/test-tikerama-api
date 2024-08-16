@php
    $btnText ??= 'Enregistrer';
    $btnType ??= 'submit';
    $faIconClass ??= 'fa fa-save';
    $class ??= 'btn btn-success'
@endphp
<div class="mb-3">
    <button @class([$class]) type="{{ $btnType }}">
        <span @class([$faIconClass])></span>
        <strong>{{ $btnText }}</strong>
    </button>
</div>
