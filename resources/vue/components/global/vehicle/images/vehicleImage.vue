<script>

export default {
    props: ["image"],

    computed: {
        getImagePath() {
            if (typeof this.image === "object") {
                return `${this.image.image_location}${this.image.image_name}.${this.image.image_type}`;
            } else if (!this.image.startsWith("https://")) {
                return "https://" + this.image;
            }
            return this.image;
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
        <img :src="getImagePath" alt="Swiper item" class="image aspect-square object-cover w-full h-full" loading="lazy">
        <div class="image-actions">
            <div @click="_handleRemoveImage" id="delete"
                class="action flex items-center justify-center bg-white shadow-md p-2 rounded-full cursor-pointer">
                <i class="fas fa-trash text-lg text-red-600"></i>
            </div>
        </div>
    </div>
</template>