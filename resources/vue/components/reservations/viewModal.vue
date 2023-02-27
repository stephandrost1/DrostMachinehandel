<script>

import moment from 'moment';
import _ from "lodash";

export default {
    props: ["reservation"],

    data() {
        return {
            vehicle: []
        }
    },

    mounted() {
        this.fetchLinkedVehicle();
    },

    computed: {
        getAdres() {
            return `${this.reservation.user.address.streetname} ${this.reservation.user.address.housenumber}`
        },

        getPostalCodeCity() {
            return `${this.reservation.user.address.postalcode}, ${this.reservation.user.address.city}`;
        },

        getCreationDate() {
            return moment(this.reservation.created_at).format('DD MMM YYYY');
        },

        getFormattedDuration() {
            return this.reservation.duration.replace(/y/g, 'jaar').replace(/w/g, 'week').replace(/d/g, 'dagen');
        },

        getFromattedStartDate() {
            return moment(this.reservation.dates.startDate).format('DD MMM YYYY');
        },

        getFromattedEndDate() {
            return moment(this.reservation.dates.endDate).format('DD MMM YYYY');
        },

        getTotalPrice() {
            const totalDays = this.calculateDays(this.reservation.dates.startDate, this.reservation.dates.endDate);
            const weeks = parseInt(totalDays / 7);
            const days = totalDays % 7;

            if (_.isEmpty(this.vehicle)) {
                return `Berekenen...`;
            } 

            const totalWeekPrice = parseFloat(weeks) * parseFloat(this.vehicle.price_per_week);
            const totalDaysPrice = parseFloat(days + 1) * parseFloat(this.vehicle.price_per_day);
            const totalPrice = totalWeekPrice + totalDaysPrice;
            
            return `€ ${Number(totalPrice.toFixed(2))}`;
        },

        getVehicleThumbnail() {
            if (_.isEmpty(this.vehicle)) {
                return;
            }

            return `${this.vehicle.images[0].image_location}${this.vehicle.images[0].image_name}.${this.vehicle.images[0].image_type}`
        },

        getDistance() {
            if (parseInt(this.reservation.distance) <= 10) {
                return `${this.reservation.distance}km (€0)`;
            } else if (parseInt(this.reservation.distance) <= 25) {
                return `${this.reservation.distance}km (€50)`;
            } else if (parseInt(this.reservation.distance) < 70) {
                return `${this.reservation.distance}km (€90)`;
            }

            return `${this.reservation.distance}km (Aanvraag)`;
        }
    },

    methods: {
        _handleClose() {
            this.$emit("closeModal");
        },

        fetchLinkedVehicle() {
            axios.get(`/api/v1/vehicles/${this.reservation.vehicle_id}`)
                .then((response) => {
                    this.vehicle = response.data.vehicle;
                });
        },

        calculateDays(startDate, endDate) {
            return moment(endDate).diff(moment(startDate), 'days');
        }
    }
}

</script>

<template>
    <div class="relative z-20 vue-view-reservation-modal">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative parent transform overflow-hidden rounded-lg bg-white border-2 border-primary text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-8 sm:pb-5">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="far fa-calendar-check text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Reservering
                            </h3>
                        </div>
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 sm:mt-0 sm:text-left grow">
                                <div class="grid-wrapper mt-2 flex gap-5">
                                    <div class="grid-container gap-3">
                                        <div class="field">
                                            <label class="name" for="name">Naam:</label>
                                            <div class="value">
                                                <p>{{ reservation.user.name }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Adres:</label>
                                            <div class="value">
                                                <p>{{ getAdres }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Postcode & plaats:</label>
                                            <div class="value">
                                                <p>{{ getPostalCodeCity }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Email:</label>
                                            <div class="value">
                                                <p>{{ reservation.user.email }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Tel:</label>
                                            <div class="value">
                                                <p>{{ reservation.user.phonenumber }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Totaalprijs:</label>
                                            <div class="value">
                                                <p>{{ getTotalPrice }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Afstand:</label>
                                            <div class="value">
                                                <p>{{ getDistance }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Aangemaakt op:</label>
                                            <div class="value">
                                                <p>{{ getCreationDate }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Looptijd:</label>
                                            <div class="value">
                                                <p>{{ getFormattedDuration }}</p>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <label class="name" for="name">Datum:</label>
                                            <div class="value">
                                                <p>{{ getFromattedStartDate }}</p><b> Tot </b><p>{{ getFromattedEndDate }}</p>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="vehicle-teaser">
                                        <div class="vehicle-title">
                                            <p>{{ vehicle.vehicle_name }}</p>
                                        </div>
                                        <div class="thumbnail">
                                            <img class="vehicle-image" :src="getVehicleThumbnail" loading="lazy"/>
                                        </div>
                                        <div class="vehicle-tile item">
                                            <p>Prijs per dag: {{ vehicle.price_per_day }}</p>
                                        </div>
                                        <div class="vehicle-tile item-last">
                                            <p>Prijs per week: {{ vehicle.price_per_week }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end items-center gap-5">
                                    <div>
                                        <div @click="_handleClose"
                                            class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200 text-red-500 font-bold">
                                            Sluiten</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>