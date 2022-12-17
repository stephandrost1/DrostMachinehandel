<script>

export default {
    props: ["reservation"],

    data() {
        return {
        }
    },

    computed: {
        getReservationName() {
            return `${this.reservation.dealer.firstname} ${this.reservation.dealer.lastname}`;
        }, 

        getReservationEmail() {
            return this.reservation.dealer.email;
        },

        getReservationDistance() {
            return this.reservation.distance;
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
}

</script>

<template>
    <div class="row-item select-none">
        <div class="item name">
            <p>{{ getReservationName }}</p>
        </div>
        <div class="item email">
            <p>{{ getReservationEmail }}</p>
        </div>
        <div class="item distance">
            <p>{{ getReservationDistance }}</p>
        </div>
        <div class="item vehicle">
            <a :href="getReservationVehicleLink">{{ getReservationVehicleName }}</a>
        </div>
        <div class="item time">
            <p>{{ getReservationDuration }}</p>
        </div>
        <div class="item actions">
            <div @click="_handleDelete" class="delete text-red-500">
                <i class="fas fa-trash"></i>
            </div>
            <div @click="_handleEnable" v-if="!dealerIsActive" class="enable text-green-500">
                <i class="fas fa-check"></i>
            </div>
            <div @click="_handleDisable" v-if="dealerIsActive" class="disable text-orange-500">
                <i class="fas fa-ban"></i>
            </div>
            <div @click="_handleEdit" class="edit text-blue-500">
                <i class="fas fa-edit"></i>
            </div>
            <div @click="_handleSave"  class="edit text-blue-500">
                <i class="fas fa-save"></i>
            </div>
        </div>
    </div>
</template>