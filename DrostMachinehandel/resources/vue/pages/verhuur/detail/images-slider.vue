<script>

export default {
    props: ["images"],

}

</script>


<template>
    <div class="images-wrapper">
        <div class="slider">
            <div class="slider-item" v-for="image in images" :key="image.id">
                <img :src="image.src" alt="slider-item">
            </div>
        </div>
    </div>
</template>