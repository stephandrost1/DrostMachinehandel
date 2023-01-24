<script>

export default {
    props: ["vehicleName", "vehicleId"]
}

</script>

<template>
    <div class="select-rent-vehicle-option p-2 bg-white border-2 border-primary rounded-lg hover:bg-primary-300 hover:text-primary duration-100 text-primary">
        <span class="option-value font-bold pointer-events-none" id="{{ vehicleId }}">{{ vehicleName }}</span>
    </div>
</template>