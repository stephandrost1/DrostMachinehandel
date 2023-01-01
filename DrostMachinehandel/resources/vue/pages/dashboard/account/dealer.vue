<script>
export default {
    data() {
        return {
            visible: {
                currentPassword: false,
                password: false,
                passwordRepeat: false,
            },
            password: "",
            passwordRepeat: "",
            currentPassword: "",
        }
    },

    mounted() {
        this.$store.dispatch("fetchDealer");
    },

    computed: {
        getDealer() {
            return this.$store.getters.getDealer;
        },

        getFirstname() {
            return this.getDealer.firstname;
        },

        getLastname() {
            return this.getDealer.lastname;
        },

        getEmail() {
            return this.getDealer.email;
        },

        getPhonenumber() {
            return this.getDealer.phonenumber;
        },

        getCompanyName() {
            return this.getDealer.companyname;
        },

        getKvkNumber() {
            return this.getDealer.kvknumber;
        },

        getBtwNumber() {
            return this.getDealer.btwnumber;
        },

        getAddress() {
            return this.getDealer.address;
        },

        getCountry() {
            return this.getAddress ? this.getAddress["country"] : '';
        },

        getProvince() {
            return this.getAddress ? this.getAddress["province"] : '';
        },

        getCity() {
            return this.getAddress ? this.getAddress["city"] : '';
        },

        getPostalCode() {
            return this.getAddress ? this.getAddress["postalcode"] : '';
        },

        getHouseNumber() {
            return this.getAddress ? this.getAddress["housenumber"] : '';
        },

        getStreetname() {
            return this.getAddress ? this.getAddress["streetname"] : '';
        }
    },

    methods: {
        _handleSave() {

        },

        togglePasswordVisibility(input) {
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
                                type="password" :v-model="password" />
                            <i class="fas fa-eye password-icon" @click="togglePasswordVisibility()"></i>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Nieuw wachtwoord herhalen</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="password" :v-model="passwordRepeat" />
                            <i class="fas fa-eye password-icon" @click="togglePasswordVisibility()"></i>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Huidig wachtwoord</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="password" :v-model="currentPassword" />
                            <i class="fas fa-eye password-icon" @click="togglePasswordVisibility()"></i>
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
                                type="text" :v-model="getCompanyName" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Kvk nummer</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" :v-model="getKvkNumber" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Btw nummer</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" :v-model="getBtwNumber" />
                        </div>

                        <div class="mt-4 flex gap-3 w-full items-center">
                            <div class="form-input-group w-11/12">
                                <div class="block font-medium text-sm text-gray-700">Straatnaam</div>
                                <input
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    type="text" id="firstname" name="firstname" :v-model="getStreetname" />
                            </div>
                            <div class="form-input-group w-1/12">
                                <div class="block font-medium text-sm text-gray-700">Huisnummer</div>
                                <input
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                    type="text" id="lastname" name="firstname" :v-model="getHouseNumber" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Postcode</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" :v-model="getPostalCode" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Provincie</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" :v-model="getProvince" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Land</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" :v-model="getCountry" />
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