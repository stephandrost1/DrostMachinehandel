<script>

import filter from './addPopup/filter.vue';

export default {
    components: {
        "dm-added-filter": filter,
    },

    data() {
        return {
            filterName: "",
            filterOptions: [
                {
                    id: 0,
                    name: ""
                }
            ]
        }
    },

    methods: {
        _handleAddFilterClick() {
            this.filterOptions.push({
                id: this.filterOptions[this.filterOptions.length - 1].id + 1,
                name: "",
            });
        },

        _handleRemoveFilter(filterId) {
            this.filterOptions = this.filterOptions.filter((filter) => filter.id !== filterId);
        },

        _updateFilterValue(filter) {
            this.filterOptions = this.filterOptions.map((f) => {
                if (f.id == filter.id && filter.name) {
                    f.name = filter.name;
                }

                return f;
            });
        },

        _handleAcceptNewFilterGroup() {
            this.$emit("_handleAcceptNewFilterGroup", {
                name: this.filterName,
                options: this.filterOptions
            });
            this.clearCurrentFormData();
        },

        _handleRejectNewFilterGroup() {
            this.clearCurrentFormData();
            this.$emit("_handleRejectNewFilterGroup");
        },

        clearCurrentFormData() {
            this.filterName = "";
            this.filterOptions = [
                {
                    id: 0,
                    name: "",
                }
            ]
        }
    }
}

</script>

<template>
        <div class="absolute w-screen h-screen add-filter-group-vue top-0 left-0">
            <div class="add-filter-menu">
                <div class="head">
                    <h1>Filter toevoegen</h1>
                </div>
                <div class="body">
                    <div class="filter-name">
                        <label for="filter-name" class="filter-name-label">Naam:</label>
                        <input type="text" id="filter-name" v-model="filterName" class="filter-name-input">
                    </div>
                    <div class="filter-options">
                        <div class="title">
                            <h2>Filter opties:</h2>
                            <div class="add-filter" @click="_handleAddFilterClick">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div class="list-filter-options">
                            <dm-added-filter v-for="filter in filterOptions" :key="filter.id" :filter="filter" @_handleRemoveFilter="_handleRemoveFilter" @_updateFilterValue="_updateFilterValue"></dm-added-filter>
                        </div>
                        <div class="actions">
                            <div @click="_handleRejectNewFilterGroup" class="reject bg-gradient-to-b w-1/8 cursor-pointer from-red-500 flex items-start justify-between to-red-200 border-b-4 border-red-500 rounded-lg shadow-xl p-3">
                                <div class="inner flex rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200 text-red-500 font-bold">Annuleren</div>
                            </div>
                            <div @click="_handleAcceptNewFilterGroup" class="accept bg-gradient-to-b cursor-pointer w-1/8 from-green-500 flex items-start justify-between to-green-200 border-b-4 border-green-500 rounded-lg shadow-xl p-3">
                                <div class="inner flex rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 font-bold">Opslaan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>