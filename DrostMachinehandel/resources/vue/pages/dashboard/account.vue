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

    computed: {
        getDealer() {
            return this.$store.getters.getDealer;
        },

        getName() {
            return this.getDealer.firstname;
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
    <section class="w-full vue-dealer-requests">
        <div class="mt-2">
            <form method="POST">
                <div class="block items-center gap-5">
                    <div class="grow">
                        <div class="mt-4 flex gap-3 items-center">
                            <div class="form-input-group w-full">
                                <div class="block font-medium text-sm text-gray-700">Voornaam</div>
                                <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" type="text" id="firstname" name="firstname" />
                            </div>
                            <div class="form-input-group w-full">
                                <div class="block font-medium text-sm text-gray-700">Achternaam</div>
                                <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" type="text" id="lastname" name="firstname" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">E-mailadres</div>
                            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" type="email" id="email" name="email" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Nieuw wachtwoord</div>
                            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" type="password" :v-model="password" />
                            <i class="fas fa-eye password-icon" @click="togglePasswordVisibility()"></i>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Nieuw wachtwoord herhalen</div>
                            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" type="password" :v-model="passwordRepeat" />
                            <i class="fas fa-eye password-icon" @click="togglePasswordVisibility()"></i>
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Huidig wachtwoord</div>
                            <input class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" type="password" :v-model="currentPassword" />
                            <i class="fas fa-eye password-icon" @click="togglePasswordVisibility()"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <div class="flex rounded-lg cursor-pointer shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                        <button @click="_handleSave" class="text-green-500 font-bold">Opslaan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>