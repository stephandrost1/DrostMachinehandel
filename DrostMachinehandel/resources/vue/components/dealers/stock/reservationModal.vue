<script>
import axios from 'axios';

export default {
    data() {
        return {
            startDate: "",
            endDate: "",
            currentUser: [],
            showPopup: false,
            errorMessage: "",
            succesMessage: "",
            submitButtonDisabled: false,
        }
    },

    mounted() {
        this.fetchUser();
    },

    computed: {
        getVehicleName() {
            return document.querySelector("#detailsContainer #hcontact-block .vehicleTitle").innerHTML ?? "Niet gevonden...";
        },

        getVehicleImage() {
            const imageElement = document.querySelector("#detailsContainer .photoHolder .slick-slide img")

            return imageElement.src;
        },

        getStreetname() {
            return `${this.currentUser["address"] ? this.currentUser["address"]["streetname"] : ''} ${this.currentUser["address"] ? this.currentUser["address"]["housenumber"] : ''}`;
        },
 
        getPostalCode() {
            return this.currentUser["address"] ? this.currentUser["address"]["postalcode"] : '';
        },

        getCity() {
            return this.currentUser["address"] ? this.currentUser["address"]["city"] : '';
        },

        getCountry() {
            return this.currentUser["address"] ? this.currentUser["address"]["country"] : '';
        }
    },

    methods: {
        addSlashes(string) {
            var result = "";
            for (var i = 0; i < string.length; i++) {
                result += string[i];
                if (i == 1 || i == 3) result += '/';
            }
            return result;

        },

        fetchUser() {
            axios.get('/api/v1/dealer')
                .then(response => {
                    this.currentUser = response.data.dealer;
                });
        },

        _handleSave() {
            this.submitButtonDisabled = true;

            const vehicleId = document.querySelector("#get-vehicle-id").dataset.vehicleid ?? null;

            axios.post('/api/v1/vehicle/reservation', {
                "vehicleId": vehicleId,
                "startDate": this.startDate,
                "endDate": this.endDate,
            }).then((response) => {
                this.succesMessage = response.data.message
            }).catch((error) => {
                this.errorMessage = error.response.data.message
            })

            setTimeout(() => {
                if (this.succesMessage != "") {
                    this._handleCloseModal();
                }

                this.errorMessage = "";
                this.succesMessage = "";
                this.submitButtonDisabled = false;
            }, 5000);
        },

        _handleCloseModal() {
            const reservationModal = document.querySelector("#svm-canvas .vue-reservation-modal");

            reservationModal.classList.add("hidden");
        }
    },

    watch: {
        startDate: function (value) {
            const date = value.replace(/[^0-9]/g, "");

            this.startDate = this.addSlashes(date.substr(0, 8));
        },

        endDate: function (value) {
            const date = value.replace(/[^0-9]/g, "");

            this.endDate = this.addSlashes(date.substr(0, 8));
        }
    }
}

</script>

<template>
    <div class="relative z-20 vue-reservation-modal">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="parent w-full h-full">
                <div class="modal-wrapper">
                    <div class="error-message bg-red-500" v-if="errorMessage !== ''">
                        <p class="message">{{ errorMessage }}</p>
                    </div>
                    <div class="error-message bg-green-500" v-if="succesMessage !== ''">
                        <p class="message">{{ succesMessage }}</p>
                    </div>
                    <div @click="_handleCloseModal" class="cursor-pointer close-icon">
                        <div class="icon">
                            <div class="mark">x</div>
                        </div>
                    </div>
                    <div class="modal-title">
                        <h1>Machine reserveren</h1>
                    </div>
                    <div class="selected-vehicle">
                        <div class="input-wrapper">
                            <div class="label">
                                <p class="label-text">Geselecteerde machine:</p>
                            </div>
                            <input readonly v-model="getVehicleName" class="selected-vehicle" type="text">
                            <div class="icon">
                                <img :src="getVehicleImage" alt="selected vehicle image">
                            </div>
                        </div>
                    </div>
                    <div class="group">
                        <div class="date-wrapper">
                            <div class="fake-input-label">
                                <p class="input-label-text">Datum:</p>
                            </div>
                            <div class="fake-input">
                                <p class="from">Van</p>
                                <input type="text" class="from-input input" v-model="startDate">
                                <p class="to">Tot</p>
                                <input type="text" class="to-input input" v-model="endDate">
                            </div>
                        </div>
                    </div>
                    <div class="section">
                        <div class="header">
                            <h2>Uw gegevens</h2>
                        </div>
                        <div class="body">
                            <div class="group">
                                <div class="streetname">
                                    <div class="label">
                                        <p class="label-text">Straat & huisnummer:</p>
                                    </div>
                                    <input type="text" readonly class="item-input" v-model="getStreetname">
                                </div>
                                <div class="postalcode">
                                    <div class="label">
                                        <p class="label-text">Postcode</p>
                                    </div>
                                    <input type="text" readonly class="item-input" v-model="getPostalCode">
                                </div>
                            </div>
                            <div class="group">
                                <div class="city">
                                    <div class="label">
                                        <p class="label-text">Woonplaats:</p>
                                    </div>
                                    <input type="text" readonly class="item-input" v-model="getCity">
                                </div>
                                <div class="country">
                                    <div class="label">
                                        <p class="label-text">Land</p>
                                    </div>
                                    <input type="text" readonly class="item-input" v-model="getCountry">
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <p>Wanneer u op reserveren klikt zal u een bevestigingsmail krijgen met daarin de gegevens van de reservering!</p>
                        </div>
                    </div>
                    <div class="submit">
                        <div class="submit-button">
                            <button @click="_handleSave" :disabled="submitButtonDisabled" class="button">Machine reserveren</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>