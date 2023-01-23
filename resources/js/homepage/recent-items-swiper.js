import Swiper, { Autoplay } from 'swiper';
// import Swiper styles
import 'swiper/css';

Swiper.use(Autoplay);

const swiperOptions = {
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    loop: true,
    speed: 1000,
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    spaceBetween: 32,
    breakpoints: {
        520: {
            slidesPerView: 1.1,
        },
        900: {
            slidesPerView: 2.1,
        },
        1400: {
            slidesPerView: 3.1,
        },
        1900: {
            slidesPerView: 4.1,
        },
    }
}

let swiper = new Swiper('.swiper-recent-items', swiperOptions);
