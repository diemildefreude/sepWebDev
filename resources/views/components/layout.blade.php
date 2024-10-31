@props(['resources', 'isCanvasOn'])
@php
    $title = 'sepWebDev';
    $description = "Stephan E Perez is a full-stack web developer, UI/UX designer and artist with a passion for building websites and apps that communicate, connect, and inspire.">
    $url = env('APP_URL');
    $ogType = "website";
    $ogImg = 'store/images/og_image.webp';
@endphp
<!DOCTYPE html>
<html lang="en"
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <title>{{ $title }}</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="{{ $description }}">

        <!-- Open Graph Meta Tags -->
        <meta property="og:url" content="{{ $url }}">
        <meta property="og:type" content="{{ $ogType }}">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:image" content="{{ asset($ogImg) }}">
        <meta property="og:image:width" content="1920">
        <meta property="og:image:height" content="1080">

        <!-- Twitter Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="sepweb.dev">
        <meta property="twitter:url" content="{{ $url }}">
        <meta name="twitter:title" content="{{ $title }}">
        <meta name="twitter:description" content="{{ $description }}">
        <meta name="twitter:image" content="{{ asset($ogImg) }}">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('store/images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('store/images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('store/images/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('store/images/favicon/site.webmanifest') }}">

        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

        @vite($resources)
        <script src="https://kit.fontawesome.com/dfd3e08cad.js" crossorigin="anonymous"></script>
    </head>
    <body>
        @if($isCanvasOn)
            <canvas id="mainCanvas" width="300" height="200">              
            </canvas>        
        @endif
        <div class="scrollable">
            {{ $slot }}            
        </div>
    </body>
</html>