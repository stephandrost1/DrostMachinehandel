<script>
export default {
    methods: {
        _handleSave() {

        },

        togglePasswordVisibility(input) {
            if (input == 1) {
                var input = document.getElementById("new_password");
                var icon = document.getElementById("new_passwordIcon")
            } else if (input == 2) {
                var input = document.getElementById("confirm_new_password");
                var icon = document.getElementById("confirm_new_passwordIcon")
            } else {
                var input = document.getElementById("password");
                var icon = document.getElementById("passwordIcon")
            }

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
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
                        <!-- Name -->
                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Naam</div>


                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="password" id="name" name="name" />

                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">E-mailadres</div>

                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="password" id="email" name="email" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Nieuw wachtwoord</div>

                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="password" id="new_password" name="new_password" />

                            <i id="new_passwordIcon" class="fas fa-eye password-icon"
                                @click="togglePasswordVisibility(1)"></i>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Nieuw wachtwoord herhalen</div>

                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="password" id="confirm_new_password" name="confirm_new_password" />

                            <i id="confirm_new_passwordIcon" class="fas fa-eye password-icon"
                                @click="togglePasswordVisibility(2)"></i>
                        </div>

                        <!-- Current Password -->
                        <div class="mt-4">
                            <div class="block font-medium text-sm text-gray-700">Huidig wachtwoord</div>

                            <input
                                class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
                                type="password" id="password" name="password" />

                            <i id="passwordIcon" class="fas fa-eye password-icon"
                                @click="togglePasswordVisibility(3)"></i>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <div
                        class="flex rounded-lg cursor-pointer shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200">
                        <button @click="_handleSave" class="text-green-500 font-bold">Opslaan</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>