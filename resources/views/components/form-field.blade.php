@props(['name', 'type', 'placeholder'])
<div class="form-field">
    <label for="{{ $name }}">{{ $name }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value = "{{ old($name) }}"
        placeholder="{{ $placeholder }}" class="input @error('{{ $name }}') red-border @enderror">
    @error($name)
        <div class="input-error"> {{ $message }} </div>
    @enderror
</div>