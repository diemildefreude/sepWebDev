<x-layout :isCanvasOn="true" :resources="['resources/css/reset.css', 'resources/css/app.css', 'resources/js/hero.js', 
        'resources/js/scroll.js', 'resources/js/menu.js', 'resources/js/icon-placement.js', 'resources/js/font-size.js']">
    <x-public-header/>
    <main>
        <x-main-sec heading='contact' secName='contact'>
            @if(session('success'))
            <div class="notice">{{session('success')}}</div>
            @endif
            <form action="{{ route('mail')}}" method="post" class="vertical-form">
                @csrf
                <x-form-field name="name" type="text" placeholder="your name" />
                <x-form-field name="email" type="email" placeholder="your@e-mail.address" />
                <x-form-field name="subject" type="text" placeholder="message subject" />
                <div class="form-field form-text">
                    <label for="body">message</label>
                    <textarea name="body" rows="10" class="input @error('body') red-border @enderror"></textarea>
                </div>
                <button class="hover-grow"><div>send</div></button>
            </form>
        </x-main-sec>
    </main>
    <x-public-footer/>
</x-layout>