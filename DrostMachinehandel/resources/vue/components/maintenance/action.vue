<script>
import moment from 'moment';

export default {
    props: ["action"],

    computed: {
        getDate() {
            let days = ["Zondag", "Maandag", "Dinsdag", "Woensdag", "Donderdag", "Vrijdag", "Zaterdag"];
            let day = moment(this.action.created_at).weekday();
            let dutchDay = days[day];
            return dutchDay + " | " + moment(this.action.created_at).format("DD-MM-YYYY | HH:ss");
        }
    }
}

</script>

<template>
    <div class="bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5 pb-2 vue-action">
        <p class="description">{{ action.activity }}</p>
        <div class="action-date">
            <p class="date">{{ getDate }}</p>
        </div>
    </div>
</template>