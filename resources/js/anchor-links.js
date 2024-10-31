let homeLink, aboutLink, projectsLink;

document.addEventListener("DOMContentLoaded", () =>
{
    homeLink = document.querySelector('.js-home-link');
    aboutLink = document.querySelector('.js-about-link');
    projectsLink = document.querySelector('.js-projects-link');

    addAnchorListener(homeLink, '#top');
    addAnchorListener(aboutLink, '#about');
    addAnchorListener(projectsLink, '#projects');
});

function addAnchorListener(a, id)
{
    const sec = document.querySelector(id);
    if(!sec)
    {
        return;
    }
    a.addEventListener('click', (e) =>
    {
        e.preventDefault();
        if(id == '#top')
        {
            history.replaceState(null, null, ' ');
        }
        else
        {
            history.pushState(null, null, id);
        }
        sec.scrollIntoView();
    });
}