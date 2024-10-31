<x-layout :isCanvasOn="true" :resources="['resources/css/reset.css', 'resources/css/app.css', 'resources/js/hero.js', 
        'resources/js/scroll.js', 'resources/js/menu.js', 'resources/js/icon-placement.js', 
        'resources/js/font-size.js', 'resources/js/anchor-links.js']">
    <div class="banner" id="top">                    
        <div class="banner-content js-banner-content">
            <div class="logo">
                <h1>
                    <div class="logo-text"><span class="js-hero-text js-typed-text-4">sep</span></div>
                    <div class="logo-text mid"><span class="js-hero-text js-typed-text-5">web</span></div>
                    <div class="logo-text"><span class="js-hero-text js-typed-text-6">dev</span></div>
                </h1>
            </div>
            <div class="banner-text">
                <h2>
                    <span class="hero-text js-hero-text js-typed-text-0">hi, my name is stephan</span><span class="cursor js-text-cursor">|</span>
                </h2>
                <ul>
                    <li><span class="hero-text js-hero-text js-typed-text-1">・full-stack web developer</span></li>
                    <li><span class="hero-text js-hero-text js-typed-text-2">・ui/ux designer</span></li>
                    <li><span class="hero-text js-hero-text js-typed-text-3">・artist</span></li>
                </ul>
            </div>
        </div>
    </div>
    <x-public-header/>
    <main>
        <x-main-sec heading='about me' secName='about'>
            <div class="sec-column-container">
                <div class="sec-column left">
                    <div class="profile-img-container">
                        <img src="{{asset('store/images/about.webp')}}" alt="image of stephan of s.e.p. web dev">
                    </div>
                    <div class="tiles-container">
                        <x-about-tile :isTechTile="false" iconPath="/store/images/support.png" heading="skill set">
                            <ul>
                                <li>general: full stack web development, responsive web design, interactive audiovisual, ui/ux design, database management, seo, testing & debugging</li>
                                <li>programming languages: html, css, javascript, php, c++, c#, python</li>
                                <li>frameworks: laravel, wordpress, unity, openFrameworks</li>
                                <li>libraries: three.js, hvcc, openAI, fastAi, face-detect.js</li>
                                <li>other: git, prismic.io</li>
                                <li>human languages: en, de, fr, jp</li>
                            </ul>
                        </x-about-tile>
                        <x-about-tile :isTechTile="false" iconPath="/store/images/file.png" heading="resumé">
                            <a class="hover-grow hover-text-background" download alt="download resume" target="_blank" rel="noopener noreferrer" 
                            href="{{ asset('store/pdf/sep_webdev_resume.pdf')}}">
                                download
                            </a>
                        </x-about-tile> 
                    </div>
                </div>        
                <div class="sec-column right">                                                            
                    <p>
                        After studying composition and music programming in University, I self studied c#/Unity, c++/openFrameworks, utilizing them to develop interactive art and performance pieces. I then worked for two years as a software engineer at Cosmic Lab in Osaka, Japan, where I used UE5 and python/touchDesigner to develop installations and live concert visuals. In January 2024 I started studying Web Development and am excited by its possibilities for expression and communication on a global, accessible level.
                    </p>    
                    <hr>
                    <p><em>
                        Now that you know me a little better, feel free to contact me <a href="">here</a>. I am available for free-lance work and would love to discuss your ideas and how I can assist you!
                    </em></p>
                </div>
            </div>    
        </x-main-sec>
        <x-main-sec heading='projects' secName='projects'>
            <div class="tiles-container" href="">
                @foreach($posts as $post)
                    <x-post-card :post="$post" :isEditMode="false"/>
                @endforeach
            </div>
        </x-main-sec>             
    </main>
    <x-public-footer/>
</x-layout>