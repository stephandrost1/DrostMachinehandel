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
        this.$store.dispatch("fetchAdmin");
    },

    computed: {
        getAdmin() {
            return this.$store.getters.getAdmin;
        },

        getName: {
            get() {
                return this.getAdmin.name ?? "";
            },
            set(name) {
                this.$store.commit("SET_ADMIN", { ...this.getAdmin, name })
            }
        },

        getEmail: {
            get() {
                return this.getAdmin.email ?? "";
            },
            set(email) {
                this.$store.commit("SET_ADMIN", { ...this.getAdmin, email })
            }
        },

        getPassword: {
            get() {
                return this.getAdmin.password ?? "";
            },
            set(password) {
                this.$store.commit("SET_ADMIN", { ...this.getAdmin, password, });
            }
        },

        getPasswordRepeat: {
            get() {
                return this.getAdmin.passwordRepeat ?? "";
            },
            set(passwordRepeat) {
                this.$store.commit("SET_ADMIN", { ...this.getAdmin, passwordRepeat, });
            }
        },

        getCurrentPassword: {
            get() {
                return this.getAdmin.currentPassword ?? "";
            },
            set(currentPassword) {
                this.$store.commit("SET_ADMIN", { ...this.getAdmin, currentPassword, });
            }
        }
    },

    methods: {
        _handleSave() {
            axios.patch(`/api/v1/user/${this.getAdmin.id}/update`, { ...this.getAdmin })
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
                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Naam</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="text" id="name" name="name" v-model="getName" />
                        </div>

                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">E-mailadres</div>
                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="email" id="email" name="email" v-model="getEmail" />
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

                <div class="flex items-center justify-end mt-4">
                    <div class="flex rounded-lg cursor-pointer shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                        <button @click="_handleSave" class="text-green-500 font-bold">Opslaan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>