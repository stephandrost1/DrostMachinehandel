<script>
import moment from 'moment';
import { mapActions } from 'vuex';

export default {
    props: ["action"],

    data() {
        return {
            edit: false,
        }
    },

    computed: {
        actionEdit() {
            return this.edit;
        },

        getDate() {
            const date = moment(this.action.created_at);
            let days = ["Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag"];
            let dutchDay = days[date.weekday()];
            return dutchDay + " | " + date.format("DD-MM-YYYY | HH:mm");
        },

        truncatedActivity() {
            if (this.action && this.action.activity) {
                return this.action.activity.length > 75 ? this.action.activity.slice(0, 72) + "..." : this.action.activity;
            }

            return "";
        }
    },

    methods: {
        ...mapActions(["removeAction"]),

        _handleEdit() {
            this.edit = true;
        },

        _handleSave() {
            this.edit = false;

            this.$store.dispatch("editAction", this.action);

            axios.patch(`/api/v1/vehicles/maintenance/action/${this.action.id}`, { activity: this.action.activity })
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        },

        _handleDelete() {
            this.removeAction(this.action.id);

            axios.delete(`/api/v1/vehicles/maintenance/action/${this.action.id}`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        }
    },
}

</script>

<template>
    <div class="bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5 pb-2 vue-action">
        <p v-if="!actionEdit" class="description">{{ truncatedActivity }}</p>
        <textarea class="action-new-activity" type="text" v-if="actionEdit" v-model="action.activity" placeholder="Vul hier uw actie in..."/>
        <div class="action-date footer">
            <p class="date" v-text="getDate"></p>
            <div class="add-activity">
                <div v-if="actionEdit" @click="_handleSave" class="circle save bg-green-200 border-2 border-green-500">
                    <i class="fas fa-check text-green-500 text-sm"></i>
                </div>
                <div v-if="!actionEdit" @click="_handleEdit" class="circle edit bg-orange-200 border-2 border-orange-500">
                    <i class="fas fa-pen text-orange-500 text-sm"></i>
                </div>
                <div v-if="!actionEdit" @click="_handleDelete" class="circle edit bg-red-200 border-2 border-red-500">
                    <i class="fas fa-trash text-red-500 text-sm"></i>
                </div>
            </div>
        </div>
    </div>
</template>