@php
    $class ??=null;
    $name ??= '';
    $value ??= '';
    $label ??= ucfirst($name);
@endphp

<div class="{{ $class ? 'form-group ' + $class : 'form-group' }}">
    <label for="{{ $name }}" class="block text-gray-700 font-bold mb-2">{{ $label }}</label>
    <select name="{{$name}}[]" id="{{$name}}" multiple class="tom-select block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" @error($name) class="border-red-500" @enderror>
        @foreach($options as $option)
            <option value="{{$option->id}}" @selected($value->contains($option->id))>{{$option->name}}</option>
        @endforeach
    </select>
    @error($name)
    <div class="text-red-500 text-xs italic mt-1">
        {{ $message }}
    </div>
    @enderror
</div>
