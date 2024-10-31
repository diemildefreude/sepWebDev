@props(['heading', 'secName'])

<div class="{{$secName}} main-sec" id="{{$secName}}">
    <div class="cutout-container">
        <div class="side-bar"></div>
        <div class="main-bar"></div>
    </div>
    <div class="heading-container">                        
        <div class="side-bar"></div>
        <div class="sec-heading js-sec-heading">
            <h2>{{$heading}}</h2>
        </div>
    </div>
    <div class="content-container">
        <div class="side-bar js-side-bar"></div>
        <div class="main-bar"></div>
        <div class="sec-content">
            {{ $slot }}
        </div>
    </div>
</div>