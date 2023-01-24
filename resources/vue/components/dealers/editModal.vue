<script>

export default {
    computed: {
        getDealer() {
            return this.$store.getters.getEditDealer;
        },
    },

    methods: {
        _handleCancel() {
            this.$store.dispatch("updateDealer", []);
        },

        handleSave() {
            this.$store.dispatch("updateDealer", this.getDealer);
        }
    }
}

</script>

<template>
    <div class="relative z-20">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white border-2 border-primary text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-8 sm:pb-5">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-user-edit text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Dealer bewerken
                            </h3>
                        </div>
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left grow">

                                <div class="mt-2 flex flex-col gap-5">
                                    <div class="flex gap-3">
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Naam:</div>
                                            <input placeholder="John Doe" v-model="getDealer.name" type="text" name="name" id="name" class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"/>
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">E-mailadres:</div>
                                            <input placeholder="JohnDoe@example.com" v-model="getDealer.email"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="email" id="email" />
                                        </div>
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Telefoonnummer:</div>
                                            <input placeholder="06 12345678" v-model="getDealer.phonenumber"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="phonenumber" id="phonenumber" />
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Land:</div>
                                            <input placeholder="Nederland" v-model="getDealer.address.country"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="country" id="country" />
                                        </div>
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Provincie:</div>
                                            <input placeholder="Noord-Holland" v-model="getDealer.address.province"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="province" id="province" />
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Plaats:</div>
                                            <input placeholder="Amsterdam" v-model="getDealer.address.city"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="city" id="city" />
                                        </div>
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Postcode:</div>
                                            <input placeholder="3911VE" v-model="getDealer.address.postalcode"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="postalcode" id="postalcode" />
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Straatnaam:</div>
                                            <input placeholder="Boslandweg" v-model="getDealer.address.streetname"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="streetname" id="streetname" />
                                        </div>
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Huisnummer:</div>
                                            <input placeholder="148" v-model="getDealer.address.housenumber"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="number" name="housenumber" id="housenumber" />
                                        </div>
                                    </div>
                                    <div class="flex gap-3">
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">Bedrijfsnaam:</div>
                                            <input placeholder="Bedrijfsnaam b.v." v-model="getDealer.company.name"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="companyname" id="companyname" />
                                        </div>
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">KVK nummer:</div>
                                            <input placeholder="12345678" v-model="getDealer.company.kvknumber"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="kvknumber" id="kvknumber" />
                                        </div>
                                        <div class="flex flex-col grow items-start justify-between">
                                            <div class="font-bold">BTW nummer:</div>
                                            <input placeholder="NL123456789B01" v-model="getDealer.company.btwnumber"
                                                class="w-full h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                type="text" name="btwnumber" id="btwnumber" />
                                        </div>
                                    </div>


                                    <div class="flex justify-end items-center gap-5">
                                        <div>
                                            <div @click="_handleCancel" class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200 text-red-500 font-bold">Annuleren</div>
                                        </div>
                                        <div>
                                            <div @click="handleSave" class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 font-bold">Opslaan</div>
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