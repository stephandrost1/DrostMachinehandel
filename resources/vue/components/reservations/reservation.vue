<script>
import axios from 'axios';
import moment from 'moment';

export default {
    props: ["reservation"],

    computed: {
        getReservationName() {
            return this.reservation.user.name ?? `${this.reservation.user.firstname} ${this.reservation.user.lastname}`;
        },

        getReservationStatus() {
            if (this.reservation.deleted_at != null) {
                return 'Geweigerd'
            } else if (moment(this.reservation.dates.endDate).isBefore(moment().add(1, 'days').startOf('day'))) {
                return 'Verlopen'
            } else if (this.reservation.status == null) {
                return 'Niet geaccepteerd'
            } else {
                return 'Geaccepteerd'
            }
        },

        getReservationDates() {
            return `${moment(this.reservation.dates.startDate).format("DD-MM-YYYY")} - ${moment(this.reservation.dates.endDate).format("DD-MM-YYYY")}`
        },

        getReservationClasses() {
            if (this.reservation.deleted_at != null) {
                return 'bg-red-500'
            } else if (moment(this.reservation.dates.endDate).isBefore(moment().add(1, 'days').startOf('day'))) {
                return 'bg-orange-500'
            } else if (this.reservation.status == null) {
                return 'bg-yellow-500'
            } else {
                return 'bg-green-500'
            }
        },

        getReservationEmail() {
            return this.reservation.user.email;
        },

        getReservationDistance() {
            if (parseInt(this.reservation.distance) <= 10) {
                return `€0 (${this.reservation.distance}km)`;
            } else if (parseInt(this.reservation.distance) <= 25) {
                return `€50 (${this.reservation.distance}km)`;
            } else if (parseInt(this.reservation.distance) < 70) {
                return `€90 (${this.reservation.distance}km)`;
            }

            return `Aanvraag (${this.reservation.distance}km)`;
        },

        getReservationVehicleLink() {
            return window.location.origin + '/dealer/voorraad/vehicle/' + this.reservation.vehicle.id + '/' + this.reservation.vehicle.vehicle_name;
        },

        getReservationVehicleName() {
            return this.reservation.vehicle.vehicle_name;
        },

        getReservationDuration() {
            return this.reservation.duration;
        }
    },

    methods: {
        _handleDelete() {
            this.reservation.deleted_at = new Date();

            axios.delete(`/api/v1/reservations/${this.reservation.id}/delete`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                })
                .catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        },
        _handleAccept() {
            this.reservation.deleted_at = null;
            this.reservation.status = new Date();

            axios.patch(`/api/v1/reservations/${this.reservation.id}/accept`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                })
                .catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        },
        _handleView() {
            this.$emit("_handleView", this.reservation);
        }
    }
}

</script>

<template>
    <tr class="flex flex-col flex-no wrap min-[1225px]:table-row mb-2 min-[1225px]:mb-0">
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p>{{ getReservationName }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p>{{ getReservationEmail }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p>{{ getReservationDistance }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <a class="border-b border-primary-500 w-fit flex items-center gap-2" target="_blank" :href="getReservationVehicleLink">{{ getReservationVehicleName }} <i class="fas text-xs fa-external-link-alt"></i></a>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p>{{ getReservationDuration }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p>{{ getReservationDates }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <div class="reservation-status w-fit py-1 px-3 rounded text-white font-bold" :class="getReservationClasses">
                <p>{{ getReservationStatus }}</p>
            </div>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <div class="h-full flex items-center gap-3">
                <div @click="_handleDelete" class="delete text-red-500 cursor-pointer">
                    <i class="fas fa-trash"></i>
                </div>
                <div @click="_handleAccept" class="enable text-green-500 cursor-pointer">
                    <i class="fas fa-check"></i>
                </div>
                <div @click="_handleView" class="enable text-blue-500 cursor-pointer">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
        </td>
    </tr>
</template>