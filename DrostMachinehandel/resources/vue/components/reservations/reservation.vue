<script>

export default {
    props: ["reservation"],

    computed: {
        getReservationName() {
            return this.reservation.user.name ?? `${this.reservation.user.firstname} ${this.reservation.user.lastname}`;
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