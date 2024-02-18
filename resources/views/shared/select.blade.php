
@php
    $name ??= '';
    $id ??= '';
    $for ??= $id;
    $items ??= '';
    $class ??= 'col-md-6';
    $label ??= '';
@endphp

<div @class($class)>
    <div class="form-floating">
        <select class="form-select" id="{{$id}}" name="{{$name}}" aria-label="Financial Consultancy">
            <option selected="">Selectionner</option>
            @foreach ($items as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
            @endforeach
        </select>
        <label for="{{$for}}">{{ $label }}</label>
    </div>
    @error($name)
        $message
    @enderror
</div>