<x-layout :isCanvasOn="false" :resources="['resources/css/reset.css', 'resources/css/app.css']">
    <div class="login-container">
        <div class="logo">
            <h1>
                <div class="logo-text"><span>sep</span></div>
                <div class="logo-text mid"><span>web</span></div>
                <div class="logo-text"><span>dev</span><span class="cursor">|</span></div>
            </h1>
        </div> 
        <form action="{{route('login')}}" method="post" class="vertical-form">
            @csrf
            <div class="form-field">
                <label for="name">username</label>
                <input type="text" name="name" value = "{{ old('name') }}
                    "class="input @error('name') red-border @enderror">
                @error('name')
                    <div class="input-error"> {{ $message }} </div>
                @enderror
            </div>
            <div class="form-field">
                <label for="password">password</label>
                <input type="password" name="password" class="input @error('password') red-border @enderror">
                @error('password')
                <div class="input-error"> {{ $message }} </div>
                @enderror
            </div>
            @error('failed')
            <div class="input-error"> {{ $message }} </div>
            @enderror
            <button class="hover-grow">log in</button>   
        </form>
        <div class="to-home">
            <span class="arrow"><</span>
            <a href="{{route('main')}}">return to home page</a>
        </div>
    </div>
</x-layout>