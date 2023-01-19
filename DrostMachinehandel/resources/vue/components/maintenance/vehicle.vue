<script>
import actionVue from './action.vue';

export default {
    props: ["vehicle"],

    components: {
        "dm-action": actionVue
    },

    computed: {
        sortedObjects() {
            return this.vehicle.actions.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
        },
        getActionsObject() {
            let left = [];
            let right = [];
            this.sortedObjects.forEach((object, index) => {
                if (index % 2 === 0) {
                    left.push(object);
                } else {
                    right.push(object);
                }
            });
            return { left, right };
        }
    }
}

</script>

<template>
        <div class="flex gap-5 w-full vue-maintenance-vehicle">
            <div class="wrapper flex flex-col min-[680px]:flex-row md:flex-col min-[880px]:flex-row lg:flex-col min-[1150px]:flex-row gap-5 w-full">
                <div class="column-left column bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5">
                    <div class="vehicle-item title">
                        <p class="name">Naam:</p>
                        <p class="value">{{ vehicle.vehicle_name }}</p>
                    </div>
                    <div class="vehicle-item mark">
                        <p class="name">Merk:</p>
                        <p class="value">{{ vehicle.mark }}</p>
                    </div>
                    <div class="vehicle-item type">
                        <p class="name">Type:</p>
                        <p class="value">{{ vehicle.type }}</p>
                    </div>
                    <div class="vehicle-item serial-number">
                        <p class="name">Serienummer:</p>
                        <p class="value">{{ vehicle.serial_number }}</p>
                    </div>
                    <div class="vehicle-item construction-year">
                        <p class="name">Bouwjaar:</p>
                        <p class="value">{{ vehicle.construction_year }}</p>
                    </div>
                    <div class="vehicle-item reference-number">
                        <p class="name">Referentienummer:</p>
                        <p class="value">{{ vehicle.reference_number }}</p>
                    </div>
                </div>

                <div class="column-right column bg-primary-200 border-2 border-primary rounded-lg shadow-xl p-5">
                    <div class="body flex">
                        <div class="col-left">
                            <dm-action v-for="action in getActionsObject.left" :key="action.id" :action="action"></dm-action>
                        </div>
                        <div class="col-right">
                            <dm-action v-for="action in getActionsObject.right" :key="action.id" :action="action"></dm-action>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>