<script>
import activeFilterVue from '../components/verhuur/home/filters/activeFilter.vue';
import filterVue from '../components/verhuur/home/filters/filterGroup.vue';
import vehicleVue from '../components/verhuur/home/vehicle.vue';

export default {
    components: {
        "dm-vehicle": vehicleVue,
        "dm-filter": filterVue,
        "dm-active-filter": activeFilterVue
    },

    mounted() {
        this.$store.dispatch("fetchVehicles");
        this.$store.dispatch("fetchFilters");
    },

    computed: {
        getVehicleCount() {
            return this.getVehicles.length;
        },

        getVehicles() {
            return this.$store.getters.getVehicles;
        },

        getFilters() {
            return this.$store.getters.getFilters;
        },

        getActiveFilters() {
            return this.$store.getters.getActiveFilters;
        },

        hasActiveFilters() {
            return this.getActiveFilters.length > 0;
        }
    },

    methods: {
        fetchVehicles() {
            axios.get("/api/v1/vehicles")
                .then(response => {
                    this.vehicles = response.data.vehicles;
                }) 
        },

        fetchFilters() {
            axios.get("/api/v1/filters")
                .then(response => {
                    this.filters = response.data.filters;
                })
        }
    }
}

</script>

<template>
        <div class="verhuur-content">
            <div class="total-filter-wrapper">
                <div id="result_amount_mobile" class="result-amount result-amount-mobile">2 Resultaten gevonden</div>
                <div id="hide_filters" class="close-filters-button">
                    <span class="hide-filter-text">Filters</span>
                    <span style="float: right;" onclick="hideFilters()"><i class="fas fa-times"></i></span>
                </div>
                <div id="filter_button" onclick="showFilters()" class="filter-button">Filter</div>
                <div id="active_filters" class="active-filters">
                    <div>
                        <dm-active-filter v-for="filter in getActiveFilters" :key="filter.id" :filter="filter"></dm-active-filter>
                    </div>
                    <div v-if="hasActiveFilters" class="delete-active-filters">Verwijder alle filters</div>
                </div>
                <div id="filters" class="filters">
                    <dm-filter v-for="filter in getFilters" :key="filter.id" :filter="filter"></dm-filter>
                </div>
            </div>
            <div id="results_content" class="results-content">
                <div class="result-amount result-amount-desktop">{{ getVehicleCount }} Resultaten gevonden</div>
                <div class="machines-wrapper">
                    <dm-vehicle v-for="vehicle in getVehicles" :key="vehicle.id" :vehicle="vehicle"></dm-vehicle>
                </div>
            </div>
        </div>
</template>