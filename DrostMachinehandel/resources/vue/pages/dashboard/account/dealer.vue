<script>
export default {
    data() {
        return {
            visible: {
                currentPassword: false,
                password: false,
                passwordRepeat: false,
            },
        }
    },

    mounted() {
        this.$store.dispatch("fetchDealer");
    },

    computed: {
        getDealer() {
            return this.$store.getters.getDealer;
        },

        getFirstname: {
            get() {
                return this.getDealer.firstname ?? "";
            },
            set(firstname) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, firstname })
            }
        },

        getLastname: {
            get() {
                return this.getDealer.lastname ?? "";
            },
            set(lastname) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, lastname })
            }
        },

        getEmail: {
            get() {
                return this.getDealer.email ?? "";
            },
            set(email) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, email })
            }
        },

        getPhonenumber: {
            get() {
                return this.getDealer.phonenumber ?? "";
            },
            set(phonenumber) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, phonenumber })
            }
        },

        getCompanyName: {
            get() {
                return this.getDealer.companyname ?? "";
            },
            set(companyname) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, companyname })
            }
        },

        getKvkNumber: {
            get() {
                return this.getDealer.kvknumber ?? "";
            },
            set(kvknumber) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, kvknumber })
            }
        },

        getBtwNumber: {
            get() {
                return this.getDealer.btwnumber ?? "";
            },
            set(btwnumber) {
                this.$store.commit("SET_DEALER", {...this.getDealer, btwnumber})
            }
        },

        getAddress: {
            get() {
                return this.getDealer.address ?? [];
            },
            set(address) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, address })
            }
        },

        getCountry: {
            get() {
                return this.getAddress.country ?? "";
            },
            set(country) {
                this.$store.commit("SET_DEALER", {
                    ...this.getDealer,
                    address: {
                        ...this.getDealer.address,
                        country,
                } })
            }
        },

        getProvince: {
            get() {
                return this.getAddress.province ?? "";
            },
            set(province) {
                this.$store.commit("SET_DEALER", {
                    ...this.getDealer,
                    address: {
                        ...this.getDealer.address,
                        province,
                    }
                })
            }
        },

        getCity: {
            get() {
                return this.getAddress.city ?? "";
            },
            set(city) {
                this.$store.commit("SET_DEALER", {
                    ...this.getDealer,
                    address: {
                        ...this.getDealer.address,
                        city,
                    }
                })
            }
        },

        getPostalCode: {
            get() {
                return this.getAddress.postalcode ?? "";
            },
            set(postalcode) {
                this.$store.commit("SET_DEALER", {
                    ...this.getDealer,
                    address: {
                        ...this.getDealer.address,
                        postalcode,
                    }
                })
            }
        },

        getHouseNumber: {
            get() {
                return this.getAddress.housenumber ?? "";
            },
            set(housenumber) {
                this.$store.commit("SET_DEALER", {
                    ...this.getDealer,
                    address: {
                        ...this.getDealer.address,
                        housenumber,
                    }
                })
            }
        },

        getStreetname: {
            get() {
                return this.getAddress.streetname ?? "";
            },
            set(streetname) {
                this.$store.commit("SET_DEALER", {
                    ...this.getDealer,
                    address: {
                        ...this.getAddress,
                        streetname,
                    }
                })
            }
        },

        getPassword: {
            get() {
                return this.getDealer.password ?? "";
            },
            set(password) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, password, });
            }
        },

        getPasswordRepeat: {
            get() {
                return this.getDealer.passwordRepeat ?? "";
            },
            set(passwordRepeat) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, passwordRepeat, });
            }
        },

        getCurrentPassword: {
            get() {
                return this.getDealer.currentPassword ?? "";
            },
            set(currentPassword) {
                this.$store.commit("SET_DEALER", { ...this.getDealer, currentPassword, });
            }
        }
    },

    methods: {
        _handleSave() {
            axios.patch(`/api/v1/dealer/${this.getDealer.id}/update`, { ...this.getDealer })
                .then((response) => {
                    this.$toast.success(response.data.message);
                }).catch((error) => {
                    this.$toast.error(error.response.data.message)
                })
        },

        toggleInputVisibility(property) {
            console.log("clicked")
            this.visible[property] = !this.visible[property];
        }
    }
}
</script>

<template>
    <section class="w-full flex vue-dealer-requests">
        <div class="mt-2 flex gap-5 grow">
            <div class="personal-items block w-full">
                <div class="block items-center gap-5">
                    <div class="grow">
                        <div class="mt-4 flex gap-3 items-center">
                            <div class="form-input-group w-full">
                                <div class="block font-medium text-sm text-gray-700">Voornaam</div>
                                <input
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    type="text" id="firstname" name="firstname" v-model="getFirstname" />
                            </div>
                            <div class="form-input-group w-full">
                                <div class="block font-medium text-sm text-gray-700">Achternaam</div>
                                <input
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    type="text" id="lastname" name="firstname" v-model="getLastname" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">E-mailadres</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="email" id="email" name="email" v-model="getEmail"/>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Telefoon nummer</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="tel" id="phonenumber" name="phonenumber" v-model="getPhonenumber" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Nieuw wachtwoord</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                :type="visible.password ? 'text' : 'password'" v-model="getPassword" />
                            <div class="eye-wrapper" @click="toggleInputVisibility('password')">
                                <i class="fas fa-eye password-icon"></i>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Nieuw wachtwoord herhalen</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                :type="visible.passwordRepeat ? 'text' : 'password'" v-model="getPasswordRepeat" />
                            <div class="eye-wrapper" @click="toggleInputVisibility('passwordRepeat')">
                                <i class="fas fa-eye password-icon"></i>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Huidig wachtwoord</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                :type="visible.currentPassword ? 'text' : 'password'" v-model="getCurrentPassword" />
                            <div class="eye-wrapper" @click="toggleInputVisibility('currentPassword')">
                                <i class="fas fa-eye password-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="company-info block w-full">
                <div class="block items-center gap-5">
                    <div class="grow">
                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Bedrijfsnaam</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" v-model="getCompanyName" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Kvk nummer</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" v-model="getKvkNumber" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Btw nummer</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" v-model="getBtwNumber" />
                        </div>

                        <div class="mt-4 flex gap-3 w-full items-center">
                            <div class="form-input-group w-11/12">
                                <div class="block font-medium text-sm text-gray-700">Straatnaam</div>
                                <input
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    type="text" id="streetname" name="streetname" v-model="getStreetname" />
                            </div>
                            <div class="form-input-group w-1/12">
                                <div class="block font-medium text-sm text-gray-700">Huisnummer</div>
                                <input
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    type="text" id="housenumber" name="housenumber" v-model="getHouseNumber" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Postcode</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" v-model="getPostalCode" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Plaats</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" v-model="getCity" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Provincie</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" v-model="getProvince" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Land</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" v-model="getCountry" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <div
                        class="flex rounded-lg cursor-pointer shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                        <button @click="_handleSave" class="text-green-500 font-bold">Opslaan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>