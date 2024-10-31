    let tiles, sideBar;
    const mobileThreshold = 650;
    const midThreshold = 768;
    const wideThreshold = 992;

    document.addEventListener('DOMContentLoaded', () =>
    {
        tiles = document.querySelectorAll('.js-about-tile');
        sideBar = document.querySelector('.js-side-bar');
        if(tiles)
        {
            positionIcons();    
            window.onresize = positionIcons;
        }
    });

    function positionIcons()
    {
        const ww = window.innerWidth;
        const sideWidth = sideBar.getBoundingClientRect().width;

        for(let i = 0; i < tiles.length; ++i)
        {        
            const icon = tiles[i].querySelector('.js-icon-container');
            icon.style.position = 'absolute';        
            let newLeft, newTranslate; 
            const tileRect = tiles[i].getBoundingClientRect();
            const isOutOfBounds = tileRect.left > sideWidth;
            const isTechAtMidWidth = ww >= midThreshold 
                && ww < wideThreshold && tiles[i].classList.contains('js-tech-tile');

            if(ww < mobileThreshold || isOutOfBounds || isTechAtMidWidth)
            {
                newLeft = `50%`;
                newTranslate = '0px';
            }
            else
            {                
                newLeft = `${-tileRect.left}px`;
                newTranslate = `${sideWidth}px`
            }

            icon.style.left = newLeft;
            icon.style.setProperty('--icon-translate', newTranslate);
        }
    }