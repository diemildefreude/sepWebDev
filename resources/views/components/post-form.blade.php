@props(['isCreateForm', 'post' => null])

@php
    if(!$isCreateForm)
    {
        $techs = json_decode($post->tech_stack);
        $features = json_decode($post->features);
    }
@endphp

<div class="post-form-container">
    <div class="new-post-header-container">
        <h2>{{ $isCreateForm ? 'new post' : 'edit post' }}</h2>
    </div>
    <form action="{{ $isCreateForm ? route('posts.store') : route('posts.update', $post) }}" method="post"
        enctype="multipart/form-data" class="js-post-form">
        @csrf
        @if(!$isCreateForm)
            @method('PATCH')
        @endif
        @if(session('success'))
            <div class="notice">{{session('success')}}</div>
        @elseif(session('delete'))
            <div class="notice">{{session('delete')}}</div>
        @endif

        <div class="form-flex-container">
            <div class="form-field">
                <label class="main-label" for="title">project title</label>
                <input type="text" name="title" value = "{{ $isCreateForm ? old('title') : $post->title }}
                        "class="input @error('title') red-border @enderror">
                @error('title')
                    <div class="input-error"> {{ $message }} </div>
                @enderror
            </div>
            <div class="form-field">
                <label class="main-label" for="subtitle">sub-title</label>
                <input type="text" name="subtitle" value = "{{ $isCreateForm ? old('subtitle') : $post->subtitle }}
                        "class="input @error('subtitle') red-border @enderror">
                @error('subtitle')
                    <div class="input-error"> {{ $message }} </div>
                @enderror
            </div>
            <div class="form-field">
                <label class="main-label" for="live-url">live url</label>
                <input type="text" name="live_url" value = "{{ $isCreateForm ? old('live_url') : $post->live_url }}
                        "class="input @error('live_url') red-border @enderror">
                @error('live_url')
                    <div class="input-error"> {{ $message }} </div>
                @enderror
            </div>
            <div class="form-field">
                <label class="main-label" for="code_url">code url</label>
                <input type="text" name="code_url" value = "{{ $isCreateForm ? old('code_url') : $post->code_url }}
                        "class="input @error('code_url') red-border @enderror">
                @error('code_url')
                    <div class="input-error"> {{ $message }} </div>
                @enderror
            </div>
            <div class="multi-field-container js-tech-stack-container">                            
                <div class="field-button-container top-align">
                    <div class="main-label-container">
                        <h3 class="main-label">tech stack</h3>
                    </div>
                    <div class="button-container">
                        <button class="js-add-tech-but" type="button">+</button>
                    </div>                                
                </div>
                @if($isCreateForm || sizeof($techs) == 0)
                    <x-optional-field name="tech"/>      
                @else
                    @foreach($techs as $t)
                        <x-optional-field name="tech">
                            {{ $t }}
                        </x-optional-field>    
                    @endforeach 
                @endif                 
            </div>  
            <div class="multi-field-container js-features-container">
                <div class="field-button-container top-align">
                    <div class="main-label-container">
                        <h3 class="main-label">features</h3>
                    </div>
                    <div class="button-container">
                        <button class="js-add-feature-but" type="button">+</button>
                    </div>
                </div>
                @if($isCreateForm || sizeof($features) == 0)
                    <x-optional-field name="feature"/>      
                @else
                    @foreach($features as $f)
                        <x-optional-field name="feature">
                            {{ $f }}
                        </x-optional-field>   
                    @endforeach 
                @endif               
            </div> 
            @if(!$isCreateForm)
                <x-image-input name="desktop" :post="$post"/>
                <x-image-input name="laptop" :post="$post"/>
                <x-image-input name="tablet" :post="$post"/>
                <x-image-input name="phone" :post="$post"/>
            @else
            <x-image-input name="desktop"/>
            <x-image-input name="laptop"/>
            <x-image-input name="tablet"/>
            <x-image-input name="phone"/>
            @endif
        </div>    
        <button class="submit-button" type="submit" name="action" value="submit">
            {{ $isCreateForm ? 'create' : 'update' }}</button>
    </form>
    @if(!$isCreateForm)
        <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('really delete post?')">
            @csrf
            @method('DELETE')
            <div class="delete-button-container">
                <button type="submit" class="delete-button">delete</button>
            </div>
        </form>
    @endif
</div>