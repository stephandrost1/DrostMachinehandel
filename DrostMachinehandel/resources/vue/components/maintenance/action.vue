<script>
import moment from 'moment';

export default {
    props: ["action"],

    data() {
        return {
            edit: false,
        }
    },

    computed: {
        actionIsNew() {
            return this.action.new;
        },

        actionEdit() {
            return this.edit;
        },

        getDate() {
            const date = this.actionIsNew ? moment() : moment(this.action.created_at);
            let days = ["Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag"];
            let day = date.weekday();
            let dutchDay = days[day];
            return dutchDay + " | " + date.format("DD-MM-YYYY | HH:mm");
        },

        truncatedActivity() {
            return this.action.activity.length > 75 ? this.action.activity.slice(0, 72) + "..." : this.action.activity;
        }
    },

    methods: {
        _handleEdit() {
            this.edit = true;
        },

        _handleSave() {
            this.edit = false;

            if (this.action.new) {
                this.action.new = false;
            }
        }
    }
}

</script>

<template>
    <div class="bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5 pb-2 vue-action">
        <p v-if="!actionIsNew && !actionEdit" class="description">{{ truncatedActivity }}</p>
        <textarea class="action-new-activity" type="text" v-if="actionIsNew || actionEdit" v-model="action.activity" placeholder="Vul hier uw actie in..."/>
        <div class="action-date footer">
            <p class="date" v-text="getDate"></p>
            <div class="add-activity">
                <div v-if="actionIsNew || actionEdit" @click="_handleSave" class="circle save bg-green-200 border-2 border-green-500">
                    <i class="fas fa-check text-green-500 text-sm"></i>
                </div>
                <div v-if="!actionIsNew && !actionEdit" @click="_handleEdit" class="circle edit bg-orange-200 border-2 border-orange-500">
                    <i class="fas fa-pen text-orange-500 text-sm"></i>
                </div>
            </div>
        </div>
    </div>
</template>