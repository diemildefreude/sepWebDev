let menuButton, nav;

window.addEventListener("DOMContentLoaded", () =>
{
    menuButton = document.querySelector('.js-menu-button');
    nav = document.querySelector('nav');
    if(!menuButton)
    {
        return;
    }
    menuButton.addEventListener('click', () =>
    {
        nav.classList.toggle('closed');
        menuButton.classList.toggle('mobile-menu-open');
    });
})