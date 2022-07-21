import SmoothScroll from "smooth-scroll";
import Collapse from "bootstrap/js/dist/collapse";

const smoothScroll = new SmoothScroll('a[href*="#"]', {
    speed: 300,
    speedAsDuration: true,
    easing: "Linear",
    offset: window.innerWidth <= 575 ? 55 : 80,
    updateURL: false
});

const hideMenuOnScroll = () => {
    document.addEventListener('scrollStart', () => {
        const toggler = document.getElementById('navbar-toggler') as HTMLDivElement;
        const btn = document.getElementsByClassName('navbar-toggler')[0] as HTMLDivElement;
        const collapse = Collapse.getInstance(toggler) as Collapse;

        if (btn.getAttribute('aria-expanded') === 'true' && window.innerWidth <= 991) {
            collapse.hide();
        }
    }, false);
}

export {smoothScroll, hideMenuOnScroll}