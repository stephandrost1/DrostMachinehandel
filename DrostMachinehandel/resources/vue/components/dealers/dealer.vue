<script>

export default {
    props: {
        dealer: {
            required: true,
            type: Object
        }
    },

    data() {
        return {
            edit: false,
            nDealer: Object.assign({}, this.dealer),
        }
    },

    computed: {
        dealerIsActive() {
            return !_.isNull(this.dealer.email_verified_at);
        },

        getDealerStatus() {
            if (!_.isNull(this.dealer.deleted_at)) {
                return "Verwijderd";
            } else if (!_.isNull(this.dealer.email_verified_at)) {
                return "Actief";
            } else if (_.isNull(this.dealer.email_verified_at)) {
                return "Inactief"
            }

            return "Error"
        },

        getDealerStatusClass() {
            if (!_.isNull(this.dealer.deleted_at)) {
                return "bg-red-500"
            } else if (!_.isNull(this.dealer.email_verified_at)) {
                return "bg-green-500";
            } else if (_.isNull(this.dealer.email_verified_at)) {
                return "bg-orange-500"
            }

            return "bg-blue-500"
        },

        getTimeStamp() {
            const dt = new Date();
            const padL = (nr, len = 2, chr = `0`) => `${nr}`.padStart(2, chr);

            return `${padL(dt.getMonth() + 1)}/${padL(dt.getDate())}/${dt.getFullYear()} ${padL(dt.getHours())}:${padL(dt.getMinutes())}:${padL(dt.getSeconds())}`;
        }
    },

    methods: {
        _handleDelete() {
            this.$store.commit("UPDATE_DEALER", {
                ...this.dealer,
                deleted_at: this.getTimeStamp,
            });

            axios.delete(`/api/v1/users/${this.dealer.id}/delete`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        },

        _handleEnable() {
            this.$store.commit("UPDATE_DEALER", {
                ...this.dealer,
                email_verified_at: this.getTimeStamp
            });

            axios.patch(`/api/v1/users/${this.dealer.id}/activate`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        },

        _handleDisable() {
            this.$store.commit("UPDATE_DEALER", {
                ...this.dealer,
                email_verified_at: null
            });

            axios.patch(`/api/v1/users/${this.dealer.id}/deactivate`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                });
        },

        _handleEdit() {
            this.edit = true;
        },

        _handleSave() {
            this.edit = false;

            this.$store.commit("UPDATE_DEALER", this.nDealer);

            axios.patch(`/api/v1/users/${this.dealer.id}/update`, this.nDealer)
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
    <tr class="flex flex-col flex-no wrap min-[1225px]:table-row mb-2 min-[1225px]:mb-0">
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p v-if="!edit">{{ dealer.name }}</p>
            <div v-if="edit" class="edit-name editable flex gap-4">
                <input class="border-2 border-primary rounded pl-2 py-2 w-full" v-model="nDealer.name" />
            </div>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p v-if="!edit">{{ dealer.email }}</p>
            <div v-if="edit" class="edit-email editable ">
                <input class="border-2 border-primary rounded pl-2 py-2 w-full" v-model="nDealer.email" />
            </div>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p v-if="!edit">{{ dealer.phonenumber }}</p>
            <div v-if="edit" class="edit-phonenumber">
                <input class="border-2 border-primary rounded pl-2 py-2 w-full" v-model="nDealer.phonenumber" />
            </div>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p v-if="!edit">{{ dealer.company ? dealer.company.name : "Niet gevonden..." }}</p>
            <div v-if="edit" class="edit-companyname editable">
                <input class="border-2 border-primary rounded pl-2 py-2 w-full" v-model="nDealer.company.name" />
            </div>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p v-if="!edit">{{ dealer.company ? dealer.company.kvknumber : "Niet gevonden..." }}</p>
            <div v-if="edit" class="edit-kvknumber editable">
                <input class="border-2 border-primary rounded pl-2 py-2 w-full" v-model="nDealer.company.kvknumber" />
            </div>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate"
            :class="[dealerIsActive ? 'active' : 'inactive']">
            <p class="w-min text-white rounded-md p-[2px] min-[1225px]:p-2 font-bold"
                :class="getDealerStatusClass">{{
                    getDealerStatus
                }}</p>
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