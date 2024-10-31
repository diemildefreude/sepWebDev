@props(['name', 'post' => null])

<div class="file-input-container">
    <label class="main-label" for="{{ $name }}_img">{{$name}} photo</label>
    <input type="file" name="{{$name}}_img">
    @error('{{ $name }}_img')
        {{ $message }}
    @enderror
    @if($post && $post[$name . '_img'])
        <div class="img-preview-container">
            <img src="{{ asset('store/' . $post[$name . '_img']) }}" alt="">
        </div>
    @endif
</div>