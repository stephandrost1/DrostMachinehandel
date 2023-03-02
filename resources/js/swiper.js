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
    effect: 'fade',
    slidesPerView: 1,
    fadeEffect: {
        crossFade: true
    },
    breakpoints: {
        480: {
            slidesPerView: 1,
        },
        640: {
            slidesPerView: 2,
        },
        976: {
            slidesPerView: 3,
        },
    }
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