<script>

export default {
    props: ["image"],

    computed: {
        getImagePath() {
            return `${this.image.image_location}${this.image.image_name}.${this.image.image_type}`;
        }
    },

    methods: {
        _handleRemoveImage() {
            this.$store.commit("REMOVE_IMAGE_BY_ID", this.image.id);
        }
    }
}

</script>

<template>
    <div class="image-swiper-item relative vue-vehicle-image">
        <img :src="getImagePath" alt="Swiper item" class="image aspect-square object-cover w-full h-full">
        <div class="image-actions">
            <div class="action" @click="_handleRemoveImage" id="delete">
                <i class="fas fa-trash text-lg"></i>
            </div>
        </div>
    </div>
</template>