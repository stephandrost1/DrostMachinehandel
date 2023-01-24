<script>
import moment from 'moment';

export default {
    data() {
        return {
            activity: "",
        }
    },
    
    computed: {
        getDate() {
            let days = ["Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag"];
            let day = moment().weekday();
            let dutchDay = days[day];
            return dutchDay + " | " + moment().format("DD-MM-YYYY | HH:mm");
        },

        getVehicleId() {
            return this.$store.getters.getSelectedVehicle.id;
        }
    },

    methods: {
        _handleSave() {
            axios.post("/api/v1/vehicles/maintenance/action", {
                vehicle_id: this.getVehicleId,
                activity: this.activity
            }).then((response) => {
                this.$store.dispatch("addNewAction", {
                    id: response.data.activity_id.toString(),
                    created_at: new Date(),
                    activity: this.activity,
                    vehicle_id: this.getVehicleId,
                });

                this.activity = "",

                this.$toast.success(response.data.message);
            }).catch((error) => {
                console.log(error);
                this.$toast.error(error.response.data.message);
            })
        }
    },
}

</script>

<template>
    <div class="bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5 pb-2 vue-action">
        <textarea class="action-new-activity" type="text" v-model="activity"
            placeholder="Vul hier uw actie in..." />
        <div class="action-date footer">
            <p class="date" v-text="getDate"></p>
            <div class="add-activity">
                <div  @click="_handleSave"
                    class="circle save bg-green-200 border-2 border-green-500">
                    <i class="fas fa-check text-green-500 text-sm"></i>
                </div>
            </div>
        </div>
    </div>
</template>