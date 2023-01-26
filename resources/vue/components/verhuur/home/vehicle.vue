<script>
import detailVue from './detail.vue';

export default {
    components: {
        "dm-detail": detailVue
    },

    props: ["vehicle"],

    computed: {
        getPricePerDay() {
            return new Intl.NumberFormat('nl-NL', {
                style: 'currency',
                currency: 'EUR',
            }).format(this.vehicle.price_per_day);
        },

        getThumbnail() {
            return this.vehicle.images[0] ? `${this.vehicle.images[0].image_location}${this.vehicle.images[0].image_name}.${this.vehicle.images[0].image_type}` : '../../../../../public/img/errors/no_image_placeholder.png'
        }
    },

    methods: {
        _handleVehicleClick() {
            window.location.href = `/verhuur/detail/${this.vehicle.id}/${encodeURIComponent(this.vehicle.vehicle_name)}`;
        },
        capitalized(name) {
            const capitalizedFirst = name[0].toUpperCase();
            const rest = name.slice(1);

            return capitalizedFirst + rest;
        },
    }
}

</script>

<template>
    <div @click="_handleVehicleClick" class="cursor-pointer vehicle-card swiper-slide">
        <div class="thumbnail-wrapper">
            <img :src="getThumbnail" class="vehicle-thumbnail">
        </div>
        <div class="card-body">
            <div class="vehicle-description-content">
                <a class="vehicle-title">{{ capitalized(vehicle.vehicle_name) }}</a>

                <div class="vehicle-description">
                    <ul class="description-list">
                        <li class="description-item">Aantal beschikbaar : {{ vehicle.stock }}</li>
                        <dm-detail v-for="detail in vehicle.details" :key="detail.id" :detail="detail"></dm-detail>
                    </ul>
                </div>
            </div>
            <div class="vehicle-price-content">
                <div class="vehicle-price-wrapper">
                    <span class="vehicle-price">{{ getPricePerDay }} <span class="vehicle-price-time">Per dag</span>
                    </span>
                    <span class="vehicle-price-sub-text">Excl. BTW</span>
                </div>
            </div>
        </div>
    </div>
</template>