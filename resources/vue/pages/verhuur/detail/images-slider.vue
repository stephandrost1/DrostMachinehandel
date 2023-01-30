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
                <img :src="currentMainImageSrc" class="image-class" alt="slider-item">
            </div>

        </div>
        <div class="grid grid-cols-4 md:grid-cols-7 gap-2 overflow-auto">
            <div v-for="(image, index) in images" :key="image.id">
                <img @click="selectImg(index)" :class="[currentImage == index ? 'border-primary border-2' : '']"
                    class="cursor-pointer" :src="`${image.image_location}${image.image_name}.${image.image_type}`"
                    alt="slider-item">
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
    computed: {
        currentMainImageSrc() {
            return this.images[this.currentImage]['image_location'] + this.images[this.currentImage]['image_name'] + '.' +
                this.images[this.currentImage]['image_type']
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