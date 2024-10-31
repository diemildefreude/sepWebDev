@props(['iconPath', 'heading', 'isTechTile'])
<div class="tile about-tile js-about-tile {{ $isTechTile ? 'js-tech-tile tech-tile' : '' }} ">
    <div class="icon-container js-icon-container">
        <img src="{{ asset($iconPath) }}" alt="" class="tile-logo">
    </div>
    <h3 class="about-tile-header">{{$heading}}</h3>
    {{ $slot }}
</div>