let headerDivs;
const minSize = 16;
const maxSize = 32;
const reducThreshold = 8;

document.addEventListener("DOMContentLoaded", () =>
{
    headerDivs = document.querySelectorAll('.js-sec-heading');
    headerDivs.forEach((h) =>
    {
        const count = h.innerText.length;
        const reduc = Math.max(0, count - reducThreshold) * 0.8;
        let size = 32.0 - reduc;
        h.style.setProperty('--sec-heading-font-size', `${size}px`)
    });
});