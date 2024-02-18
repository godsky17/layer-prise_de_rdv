@php
    $name ??= '';
    $id ??= '';
    $placeholder ??= '';
    $for ??= $id;
    $type ??= '';
    $value ??= '';
    $class ??= 'col-md-6';
    $label ??= '';
@endphp
<div @class($class)>
    <div class="form-floating">
        <input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}" placeholder="{{$placeholder}}" value="{{ old($name,$value)}}">
        <label for="{{ $for }}">{{ $label }}</label>
    </div>
    @error($name)
        {{$message}}
    @enderror
</div>