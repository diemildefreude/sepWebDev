let headerLogo, heroText, header, scrollable;

window.addEventListener('DOMContentLoaded', () =>
{
    headerLogo = document.querySelector('.js-header-logo');
    heroText = document.querySelector('.js-banner-content');
    header = document.querySelector('header');
    toggleNavPos();
    if(!heroText)
    {
        setToBlack();
        //fadeHeaderColor(0.0);
    }

    scrollable = document.querySelector('.scrollable');
    scrollable.addEventListener('scroll', onScroll);
});

function setToBlack()
{
    headerLogo.style.setProperty('--logo-color', `rgba(0,0,0, 1.0)`);
}
function onScroll()
{
    const fadeH = Math.min(1.0, scrollable.scrollTop / window.innerHeight);
    if(heroText)
    {
        crossFadeLogos(fadeH);    
        //fadeHeaderColor(fadeH);
    }

    toggleNavPos();
};

function toggleNavPos()
{    
    const headerTop = header.getBoundingClientRect().top;
    const isHeaderHigh = headerTop < window.innerHeight * 0.5;
    header.classList.toggle("high-header", isHeaderHigh);
}
// function fadeHeaderColor(a)
// {    
//     const gradA = 1.0 - (Math.max(0.5, a) - 0.5) * 2;
//     const rangedA = gradA * 0.15 + 0.85;
//     header.style.setProperty('--nav-gradient-center-color', `rgba(255,255,255,${rangedA})`);
// }
function crossFadeLogos(a)
{
    const logoA = a * 2;
    const textA = 1.0 - logoA;
    headerLogo.style.setProperty('--logo-color',`rgba(0, 0, 0, ${logoA})`);
    heroText.style.setProperty('--hero-text-color', `rgba(0, 0, 0, ${textA})`);
}
