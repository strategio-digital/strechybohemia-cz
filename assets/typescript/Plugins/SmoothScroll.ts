import SmoothScroll from "smooth-scroll";
import {Collapse} from "bootstrap";

const smoothScroll = new SmoothScroll('a[href*="#"]', {
    speed: 300,
    speedAsDuration: true,
    easing: "Linear",
    offset: window.innerWidth <= 767 ? 66 : 86,
    updateURL: false
});

const hideMenuOnScroll = () => {
    document.addEventListener('scrollStart', () => {
        const toggler = document.getElementById('navbar-toggler') as HTMLDivElement;
        const btn = document.getElementsByClassName('navbar-toggler')[0] as HTMLDivElement;

        if (btn.getAttribute('aria-expanded') === 'true' && window.innerWidth <= 991) {
            const collapse = Collapse.getOrCreateInstance(toggler) as Collapse;
            collapse.hide();
        }
    }, false);
}

export {smoothScroll, hideMenuOnScroll}