<header>      
    <a href="{{ route('main') }}" class="logo-container">
        <div class="logo js-header-logo hover-text-background">
            <div class="logo-text js-typed-text-4"><span>sep</span></div>
            <div class="logo-text mid js-typed-text-5"><span>web</span></div>
            <div class="logo-text js-typed-text-6"><span>dev</span></div>
        </div>
    </a>        
    <button class="js-menu-button menu-button">
        <div class="hamburger">
            <div class="bar bar1"></div>
            <div class="bar bar2"></div>
            <div class="bar bar3"></div>
            <div class="bar bar4"></div>
        </div>
    </button>
    <nav class="closed">
        <a class="hover-grow js-home-link" href="{{ route('main')  }}"><div>home</div></a>
        <a class="hover-grow js-about-link" href="{{ route('main') . '#about' }}"><div>about</div></a>
        <a class="hover-grow js-projects-link" href="{{ route('main') . '#projects' }}"><div>projects</div></a>
        <a class="hover-grow" href="{{ route('contact') }}"><div>contact</div></a>
    </nav>    
</header>