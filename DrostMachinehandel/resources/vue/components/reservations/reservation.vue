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
            <a :href="getReservationVehicleLink">{{ getReservationVehicleName }}</a>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p>{{ getReservationDuration }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <div class="h-full flex items-center gap-3">
                <div @click="_handleDelete" class="delete text-red-500 cursor-pointer">
                    <i class="fas fa-trash"></i>
                </div>
                <div @click="_handleEnable" v-if="!dealerIsActive" class="enable text-green-500 cursor-pointer">
                    <i class="fas fa-check"></i>
                </div>
                <div @click="_handleDisable" v-if="dealerIsActive" class="disable text-orange-500 cursor-pointer">
                    <i class="fas fa-ban"></i>
                </div>
                <div @click="_handleEdit" v-if="!edit" class="edit text-blue-500 cursor-pointer">
                    <i class="fas fa-edit"></i>
                </div>
                <div @click="_handleSave" v-if="edit" class="edit text-blue-500 cursor-pointer">
                    <i class="fas fa-save"></i>
                </div>
            </div>
        </td>
    </tr>
</template>