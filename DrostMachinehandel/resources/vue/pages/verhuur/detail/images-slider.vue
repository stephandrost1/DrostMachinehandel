<script>
import axios from 'axios';
import { Swiper, SwiperSlide } from 'swiper/vue';
// Import Swiper styles
import 'swiper/css';

export default {
    components: {
        Swiper,
        SwiperSlide,
    },

    data() {
        return {
            images: [],
        }
    },

    mounted() {
        const vehicleId = document.getElementById("vehicle-id").dataset.vehicleid;
        this.fetchImages(vehicleId);
    },


    methods: {
        fetchImages(vehicleId) {
            axios.get(`/api/v2/vehicle/${vehicleId}/images`)
                .then((response) => {
                    this.images = response.data.images;
                })
        }
    }

}

</script>


<template>
    <div class="images-wrapper">
        <swiper
            :slides-per-view="3"
            :space-between="50"
         class="slider">
            <swiper-slide class="slider-item" v-for="image in images" :key="image.id">
                <img :src="`${image.image_location}${image.image_name}.${image.image_type}`" alt="slider-item">
            </swiper-slide>
        </swiper>
    </div>
</template>