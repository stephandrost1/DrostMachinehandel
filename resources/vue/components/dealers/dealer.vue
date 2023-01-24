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
            this.$store.commit("SET_EDIT_DEALER", this.dealer);
        },
    },
}

</script>
<template>
    <tr class="flex flex-col flex-no wrap min-[1225px]:table-row mb-2 min-[1225px]:mb-0">
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3">
            <p>{{ dealer.name }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p>{{ dealer.email }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p>{{ dealer.phonenumber }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p>{{ dealer.company ? dealer.company.name : "Niet gevonden..." }}</p>
        </td>
        <td class="border-grey-light border hover:bg-gray-100 p-2 min-[1225px]:p-3 truncate">
            <p>{{ dealer.company ? dealer.company.kvknumber : "Niet gevonden..." }}</p>
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
                <div @click="_handleEdit" class="edit text-blue-500 cursor-pointer">
                    <i class="fas fa-edit"></i>
                </div>
            </div>
        </td>
    </tr>
</template>