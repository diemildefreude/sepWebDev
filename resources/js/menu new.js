let menuButton, nav;

window.addEventListener("DOMContentLoaded", () =>
{
    menuButton = document.querySelector('.js-menu-button');
    nav = document.querySelector('.header-content');
    if(!menuButton)
    {
        return;
    }
    menuButton.addEventListener('click', () =>
    {
        nav.classList.toggle('open');
        menuButton.classList.toggle('mobile-menu-open');
    });
})