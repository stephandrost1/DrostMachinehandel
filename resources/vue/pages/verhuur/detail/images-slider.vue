<template>
    <div v-if="images" class="flex flex-col gap-2">
        <div class="relative">
            <div
                class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 w-full flex justify-between items-center">
                <div @click="prevImg" :class="[currentImage == 0 ? 'opacity-50' : '']"
                    class="px-[15px] py-2 ml-3 rounded-full bg-white text-black cursor-pointer"><i
                        class="fas fa-chevron-left"></i>
                </div>
                <div @click="nextImg" :class="[currentImage == images.length - 1 ? 'opacity-50' : '']"
                    class="px-[15px] py-2 mr-3 rounded-full bg-white text-black cursor-pointer"><i
                        class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div>
                <img :src="images[currentImage]['image_location'] + images[currentImage]['image_name'] + '.' +
                images[currentImage]['image_type']" class="image-class" alt="slider-item">
            </div>

        </div>
        <div style="grid-template-columns: repeat(1fr, calc(50% - 40px));" class="grid gap-3 overflow-auto">
            <div v-for="(image, index) in images" :key="image.id">
                <img @click="selectImg(index)" class="w-56 cursor-pointer"
                    :src="`${image.image_location}${image.image_name}.${image.image_type}`" alt="slider-item">
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            images: null,
            currentImage: 0,
        }
    },
    mounted() {
        const vehicleId = document.getElementById("vehicle-id").dataset.vehicleid;

        axios.get(`/api/v2/vehicle/${vehicleId}/images`)
            .then((response) => (this.images = response.data.images));
    },
    methods: {
        nextImg() {
            if (this.currentImage == this.images.length - 1) {
                this.currentImage = this.currentImage;
            } else {
                this.currentImage++;
            }
        },
        prevImg() {
            if (this.currentImage == 0) {
                this.currentImage = this.currentImage;
            } else {
                this.currentImage--;
            }
        },
        selectImg(index) {
            this.currentImage = index;
        },
    }
}
</script>