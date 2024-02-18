
@php
    $name ??= '';
    $id ??= '';
    $for ??= $id;
    $class ??= 'col-md-6';
    $label ??= '';
    $placeholder ??= '';
@endphp

<div @class($class)>
    <div class="form-floating">
        <textarea class="form-control" placeholder="{{ $placeholder }}" id="{{ $id }}" name="{{ $name }}" style="height: 150px"></textarea>
        <label for="{{ $for }}">{{ $label }}</label>
    </div>
</div>