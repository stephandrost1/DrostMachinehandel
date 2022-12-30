<script>

export default {
    props: ["detail"],

}

</script>

<template>
    <li class="description-item">{{ detail.detail_name }} : {{ detail.detail_value }}</li>
</template>