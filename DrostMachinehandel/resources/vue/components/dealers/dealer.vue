<script>

export default {
    props: ["dealer"],

    data() {
        return {
            edit: false,
            nDealer: []
        }
    },

    mounted() {
        this.nDealer = this.dealer;
    },

    computed: {
        getDealerName() {
            return `${this.dealer.firstname} ${this.dealer.lastname}`;
        },

        dealerIsActive() {
            return !_.isNull(this.dealer.email_verified_at);
        }
    },

    methods: {
        _handleDelete() {
            this.$store.commit("REMOVE_DEALER", this.dealer.id);

            axios.delete(`/api/v1/dealer/${this.dealer.id}/delete`)
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message);
                })
        },

        _handleEnable() {
            const dt = new Date();
            const padL = (nr, len = 2, chr = `0`) => `${nr}`.padStart(2, chr);

            this.$store.commit("UPDATE_DEALER", {
                ...this.dealer,
                email_verified_at: `${padL(dt.getMonth() + 1)}/${padL(dt.getDate())}/${dt.getFullYear()} ${padL(dt.getHours())}:${padL(dt.getMinutes())}:${padL(dt.getSeconds())}`
            });

            axios.patch(`/api/v1/dealer/${this.dealer.id}/active`)
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

            axios.patch(`/api/v1/dealer/${this.dealer.id}/deactive`)
                .then((response) => {
                    console.log(response);
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

            axios.patch(`/api/v1/dealer/${this.dealer.id}/update`, this.nDealer)
                .then((response) => {
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
    <tr class="border-b-2 border-primary rounded-md p-5">
        <td class="py-2 px-1 w-1/12">
            <p v-if="!edit">{{ getDealerName }}</p>
            <div v-if="edit" class="edit-name editable">
                <input v-model="nDealer.firstname" />
                <input v-model="nDealer.lastname" />
            </div>
        </td>
        <td class="py-2 px-1 w-1/12">
            <p v-if="!edit">{{ dealer.email }}</p>
            <div v-if="edit" class="edit-email editable">
                <input v-model="nDealer.email" />
            </div>
        </td>
        <td class="py-2 px-1 w-1/12">
            <p v-if="!edit">{{ dealer.phonenumber }}</p>
            <div v-if="edit" class="edit-phonenumber editable">
                <input v-model="nDealer.phonenumber" />
            </div>
        </td>
        <td class="py-2 px-1 w-1/12">
            <p v-if="!edit">{{ dealer.companyname }}</p>
            <div v-if="edit" class="edit-companyname editable">
                <input v-model="nDealer.companyname" />
            </div>
        </td>
        <td class="py-2 px-1 w-1/12">
            <p v-if="!edit">{{ dealer.kvknumber }}</p>
            <div v-if="edit" class="edit-kvknumber editable">
                <input v-model="nDealer.kvknumber" />
            </div>
        </td>
        <td class="py-2 px-1 w-1/12" :class="[dealerIsActive ? 'active' : 'inactive']">
            <p class="w-min rounded-md p-1 font-bold"
                :class="[dealerIsActive ? 'text-green-500 bg-green-200' : 'text-red-500 bg-red-200']">{{
                        dealerIsActive ?
                            "Actief" : "Inactief"
                }}</p>
        </td>
        <td class="py-2 px-1 w-1/12 mt-1 flex gap-3">
            <div @click="_handleDelete" class="delete text-red-500">
                <i class="fas fa-trash"></i>
            </div>
            <div @click="_handleEnable" v-if="!dealerIsActive" class="enable text-green-500">
                <i class="fas fa-check"></i>
            </div>
            <div @click="_handleDisable" v-if="dealerIsActive" class="disable text-orange-500">
                <i class="fas fa-ban"></i>
            </div>
            <div @click="_handleEdit" v-if="!edit" class="edit text-blue-500">
                <i class="fas fa-edit"></i>
            </div>
            <div @click="_handleSave" v-if="edit" class="edit text-blue-500">
                <i class="fas fa-save"></i>
            </div>
        </td>
    </tr>
</template>