@props(['post'])

@php
    $techs = json_decode($post->tech_stack);
    $features = json_decode($post->features);
@endphp

<x-layout :isCanvasOn="true" :resources="['resources/css/reset.css', 'resources/css/app.css', 'resources/js/hero.js', 
        'resources/js/scroll.js', 'resources/js/menu.js', 'resources/js/icon-placement.js', 'resources/js/font-size.js']">
    <x-public-header/>
    <main>
        <x-main-sec heading="{{$post->title}}" secName='project'>
            <div class="sub-title">
                <h3>{{$post->subtitle}}</h3>
            </div>
            <div class="demo-code-container">
                <a class="link-container hover-grow hover-text-background" 
                    target="_blank" href="{{$post->live_url}}">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i><div class="text-container">live site</div>
                </a>
                <a class="link-container code hover-grow hover-text-background" 
                    target="_blank" href="{{$post->code_url}}">
                    <i class="fa-solid fa-code"></i><div class="text-container">code</div>
                </a>
            </div>
            <div class="sec-column-container project">
                <div class="sec-column">
                    <div class="devices-container">
                        <div class="device-img-container large-device desktop">
                            <img src="{{ asset('store/' . $post->desktop_img ?? 'images/default_desktop.webp') }}" alt="">
                        </div>
                        <div class="device-img-container large-device laptop">
                            <img src="{{ asset('store/' . $post->laptop_img ?? 'images/default_laptop.webp') }}" alt="">
                        </div>
                        <div class="device-img-container small-device-container">
                            <div class="small-device phone">
                                <img src="{{ asset('store/' . $post->phone_img ?? 'images/default_phone.webp') }}" alt="">
                            </div>
                            <div class="small-device tablet">
                                <img src="{{ asset('store/' . $post->tablet_img ?? 'images/default_tablet.webp') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sec-column tech-features">
                    <div class="tiles-container sec-column left">
                        <x-about-tile :isTechTile="true" iconPath="{{asset('store/images/support.png')}}" heading="tech stack">
                            <ul>
                                @foreach($techs as $tech)
                                    <li>{{$tech}}</li>
                                @endforeach
                            </ul>
                        </x-about-tile>
                    </div>
                    <div class="features-list sec-column right">
                        <h3>features</h3>
                        <ul>
                            @foreach($features as $feature)
                                <li>{{$feature}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
        </x-main-sec>
    </main>
    <x-public-footer/>
</x-layout>