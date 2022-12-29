<script>

import filter from './filter.vue';

export default {
    components: {
        "dm-added-filter": filter,
    },

    data() {
        return {
            showErrorMessage: false,
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
                id: this.filterOptions.length > 0 ? this.filterOptions[this.filterOptions.length - 1].id + 1 : 0,
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

        toggleErrorMessage(status) {
            this.showErrorMessage = status;
        },

        validateFilterOptions(options) {
            return options.filter(option => {
                return option.name != "";
            }).length == 0;
        },

        _handleAcceptNewFilterGroup() {
            if (this.filterName == "" || this.validateFilterOptions(this.filterOptions)) {
                this.toggleErrorMessage(true);
                return;
            }

            this.$store.commit("ADD_FILTER", {
                filter_name: this.filterName,
                options: this.filterOptions.map((filter) => {
                    return {
                        ...filter,
                        isActive: false,
                    }
                })
            })

            this.$emit("_handleAcceptNewFilterGroup", {
                name: this.filterName,
                options: this.filterOptions
            });
            this.clearCurrentFormData();

            if (this.showErrorMessage) {
                this.toggleErrorMessage(false);
            }
        },

        _handleRejectNewFilterGroup() {
            this.clearCurrentFormData();
            this.$emit("_handleRejectNewFilterGroup");
        },

        clearCurrentFormData() {
            this.filterName = "";
            this.filterOptions = [];
        }
    }
}

</script>

<template>
    <div class="relative relative z-20">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-filter text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Filter aanmaken
                            </h3>
                        </div>
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left grow">

                                <div class="mt-2 flex flex-col gap-3">
                                    <div class="error-notification" v-show="showErrorMessage">
                                        <div
                                            class="error border-2 border-red-500 bg-red-200 rounded text-center py-2 mb-2">
                                            <p class="text-red-500 font-bold">Niet alle velden zijn ingevuld. Vul een
                                                titel in en verwijder lege
                                                filters!</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div>Filter naam:</div>
                                        <input
                                            class="w-1/2 sm:!w-7/12 h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                            type="text" id="filter-name" v-model="filterName" />
                                    </div>
                                    <div class="filter-options">
                                        <div class="flex justify-between mb-2">
                                            <h2>Filter opties:</h2>
                                            <div @click="_handleAddFilterClick"
                                                class="flex items-center justify-center p-2 bg-white rounded-full shadow-md cursor-pointer">
                                                <i class="fas fa-plus text-lg text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1">
                                            <dm-added-filter v-for="filter in filterOptions" :key="filter.id"
                                                :filter="filter" @_handleRemoveFilter="_handleRemoveFilter"
                                                @_updateFilterValue="_updateFilterValue"></dm-added-filter>
                                        </div>
                                    </div>
                                    <div class="flex justify-end items-center gap-5">
                                        <div @click="_handleRejectNewFilterGroup">
                                            <div
                                                class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200 text-red-500 font-bold">
                                                Annuleren</div>
                                        </div>
                                        <div @click="_handleAcceptNewFilterGroup">
                                            <div
                                                class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 font-bold">
                                                Opslaan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>