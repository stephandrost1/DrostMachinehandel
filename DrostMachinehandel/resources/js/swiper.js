import Swiper, { Autoplay } from 'swiper';
// import Swiper styles
import 'swiper/css';

Swiper.use(Autoplay);

let showUspSlider = window.matchMedia('(max-width: 1280px)').matches;
const swiperOptions = {
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    loop: false,
    speed: 1000,
    centeredSlides: true,
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
}

let swiper = new Swiper('.swiper-container-element', swiperOptions);

window.addEventListener('resize', function (event) {
    showUspSlider = window.matchMedia('(max-width: 1045px)').matches;

    if (showUspSlider) {
        swiper.enable();
    } else {
        swiper.disable();
    }
}, true);