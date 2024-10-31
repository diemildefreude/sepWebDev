@props(['post', 'isEditMode'])
@php
    $laptopPath = 'store/' . ($post->laptop_img ? $post->laptop_img : 'images/default_laptop.webp');
    $phonePath = 'store/' .($post->phone_img ? $post->phone_img : 'images/default_iphone.webp');
@endphp


<a class="tile project-tile" 
    href="{{ $isEditMode ? route('edit-post', $post) : route('show-post', $post)}}">
    <div class="laptop-container">
        <img class="laptop-img" src="{{ asset($laptopPath) }}" alt="">
    </div>
    <div class="mobile-container">
        <img class="mobile-img" src="{{ asset($phonePath )}}" alt="">
    </div>
    <div class="project-text centered">
        <h3 class="">{{$post->title}}</h3>
        <p>{{$post->subtitle}}</p>
    </div>
</a>