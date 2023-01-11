<template>
    <div class="images-wrapper">
        <div class="main-image-wrapper">
            <img class="main-image" :src="mainImageSrc">
        </div>
        <div class="slider-wrapper">
            <dm-swiper @swiper="onSwiper" @slideChange="onSlideChange" :navigation="true" :modules="[Navigation]" :slidesPerView="3"
                :spaceBetween="50" class="slider">
                <dm-swiper-slide @click="handleSlideClick" class="slider-item" v-for="image in images" :key="image.id">
                    <img :src="`${image.image_location}${image.image_name}.${image.image_type}`" class="image-class" alt="slider-item">
                </dm-swiper-slide>
            </dm-swiper>
        </div>
    </div>
</template>

<script>
import { defineComponent, ref, onMounted } from 'vue';
import axios from 'axios';
import { Swiper, SwiperSlide, useSwiper } from 'swiper/vue';
import { Navigation } from "swiper";

import "swiper/css";
import "swiper/css/navigation";

export default defineComponent({
    components: {
        "dm-swiper": Swiper,
        "dm-swiper-slide": SwiperSlide,
    },
    setup() {
        const images = ref([]);
        const mainImageSrc = ref("");
        const swiperObj = ref();

        onMounted(() => {
            const vehicleId = document.getElementById("vehicle-id").dataset.vehicleid;
            fetchImages(vehicleId);
        });

        const fetchImages = (vehicleId) => {
            axios.get(`/api/v2/vehicle/${vehicleId}/images`)
                .then((response) => {
                    images.value = response.data.images;
                }).then(() => {
                    mainImageSrc.value = swiperObj.value.slides[0].querySelector(".image-class").src;
                })
        }
        const onSlideChange = (e) => {
            mainImageSrc.value = e.slides[e.activeIndex].querySelector(".image-class").src;
        };

        const handleSlideClick = (e) => {
            const images = document.querySelectorAll(".swiper-wrapper .image-class");
            swiperObj.value.activeIndex = [...images].indexOf(e.target)
            mainImageSrc.value = e.target.src;
        }

        const onSwiper = (swiper) => {
            swiperObj.value = swiper;
        };

        return {
            images,
            mainImageSrc,
            Navigation,
            handleSlideClick,
            onSwiper,
            onSlideChange,
        }
    }
});
</script>