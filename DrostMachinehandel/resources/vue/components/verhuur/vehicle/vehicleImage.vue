<script>

export default {
    props: ["image"],

    computed: {
        getImagePath() {
            return `${this.image.image_location}${this.image.image_name}.${this.image.image_type}`;
        }
    }
}

</script>

<template>
    <div class="image-swiper-item ">
        <img :src="getImagePath" alt="Swiper item" class="aspect-square object-cover">
    </div>
</template>