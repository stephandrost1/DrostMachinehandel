import Swiper, { Autoplay } from 'swiper';
// import Swiper styles
import 'swiper/css';

Swiper.use(Autoplay);

let showUspSlider = window.matchMedia('(max-width: 1045px)').matches;

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
        400: {
            slidesPerView: 1
        },
        520: {
            slidesPerView: 1,
        },
        740: {
            slidesPerView: 2,
        },
        976: {
            slidesPerView: 3,
        },
        1100: {
            slidesPerView: 4,
        },
        1200: {
            slidesPerView: 5,
        }
    }
}

//create a div in javascript?

// let swiper = new Swiper('.swiper-recent-items', swiperOptions);

// window.addEventListener('resize', function (event) {
//     showUspSlider = window.matchMedia('(max-width: 1045px)').matches;

//     if (showUspSlider) {
//         swiper.enable();
//     } else {
//         swiper.disable();
//     }
// }, true);