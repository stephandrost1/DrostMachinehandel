<script>
import axios from 'axios';

export default {
    data() {
        return {
            startDate: "10/01/2023",
            endDate: "15/01/2023",
            amount: "1",
            user: {
                firstname: "henrik",
                insertion: "",
                lastname: "hannewijk",
                email: "henrikH2004@hotmail.com",
                phonenumber: "0624141779",
                streetname: "pelikaanstraat",
                housenumber: "12",
                postalcode: "3903AH",
                city: "Veenendaal",
                country: "Nederland",
                company: {
                    name: "Hhannewijk",
                    kvknumber: "0987654321",
                }
            },
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
            return document.querySelector(".page-verhuurDetail .detail-wrapper .specs-wrapper .vehicle-title").innerHTML ?? "Niet gevonden...";
        },

        getVehicleImage() {
            const imageElement = document.querySelector(".page-verhuurDetail .detail-wrapper .images-wrapper .main-image");

            return imageElement.src;
        },

        getDatePlaceHolder() {
            let date = new Date();

            return `${(date.getDate() < 10 ? "0" : "") + date.getDate()}/${(date.getMonth() + 1 < 10 ? "0" : "") + (date.getMonth() + 1)}/${date.getFullYear()}`;
        },

        userStreetHouseNumer: {
            get() {
                return `${this.user.streetname} ${this.user.housenumber}`;
            },
            set(value) {
                const splittedValue = value.split(/(\d+)/);

                this.user.streetname = splittedValue[0] ? splittedValue[0].trim() : '';

                splittedValue.shift();
                
                this.user.housenumber = splittedValue.join("") ?? '';
            }
        },

        getPricePerDay() {
            const price = document.querySelector(".page-verhuurDetail .price-block .price-wrapper .price-per-day");

            return price.innerHTML ?? 'Niet gevonden!';
        },

        getPricePerWeek() {
            const price = document.querySelector(".page-verhuurDetail .price-block .price-wrapper .price-per-week");

            return price.innerHTML ?? 'Niet gevonden!';
        },
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
            axios.get('/api/v2/dealer')
                .then(response => {
                    this.currentUser = response.data.dealer;
                });
        },

        _handleSave() {
            this.submitButtonDisabled = true;

            const vehicleId = document.querySelector("#get-vehicle-id").dataset.vehicleid ?? null;

            axios.post('/api/v2/vehicle/reservation', {
                "vehicleId": vehicleId,
                "startDate": this.startDate,
                "endDate": this.endDate,
                "amount": this.amount,
                "user": this.user,
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
            const reservationModal = document.querySelector("#reservation-popup-rent-detail");

            reservationModal.classList.add("hidden");
        },

        onStartDateKeyDown(event) {
            if (event.inputType == 'deleteContentBackward') {
                return this.startDate = event.target.value;
            }

            const date = event.target.value.replace(/[^0-9]/g, "");

            this.startDate = this.addSlashes(date.substr(0, 8));
        },

        onEndDateKeyDown(event) {
            console.log(event);
            if (event.inputType == 'deleteContentBackward') {
                return this.endDate = event.target.value;
            }

            const date = event.target.value.replace(/[^0-9]/g, "");
     
            this.endDate = this.addSlashes(date.substr(0, 8));
        }
    },

    watch: {
        "user.postalcode": function (value) {
            this.user.postalcode = value.replace(' ', '');
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
                    <!-- <div class="message">
                        <div class="error-message bg-red-500" v-if="errorMessage !== ''">
                            <p class="message">{{ errorMessage }}</p>
                        </div>
                        <div class="succes-message bg-green-500" v-if="succesMessage !== ''">
                            <p class="message">{{ succesMessage }}</p>
                        </div>
                    </div> -->
                    <div class="header">
                        <div @click="_handleCloseModal" class="cursor-pointer close-icon">
                            <div class="icon">
                                <div class="mark">x</div>
                            </div>
                        </div>
                        <div class="modal-title">
                            <h1>Machine reserveren</h1>
                        </div>
                    </div>
                    <div class="body">
                        <div class="col-left">
                            <div class="row">
                                <div class="column">
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Aantal:</p>
                                        </div>
                                        <input type="text" v-model="amount" placeholder="10" class="form-input amount">
                                    </div>
                                    <div class="item date">
                                        <div class="label">
                                            <p class="label-text">Datum:</p>
                                        </div>
                                        <div class="date-input-wrapper">
                                            <div class="label-input">
                                                <p class="label-text">Van</p>
                                            </div>
                                            <input type="text" class="start-date date-input" v-model="startDate" @input="onStartDateKeyDown" :placeholder="getDatePlaceHolder">
                                            <div class="label-input">
                                                <p class="label-text">Tot</p>
                                            </div>
                                            <input type="text" class="end-date date-input" v-model="endDate" @input="onEndDateKeyDown" :placeholder="getDatePlaceHolder">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row-header column">
                                    <h1>Uw gegevens:</h1>
                                </div>
                                <div class="column">
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Voornaam:</p>
                                        </div>
                                        <input type="text" v-model="user.firstname" placeholder="John" class="form-input firstname">
                                    </div>
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Tussenvoegsel:</p>
                                        </div>
                                        <input type="text" v-model="user.insertion" class="form-input insertion">
                                    </div>
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Achternaam:</p>
                                        </div>
                                        <input type="text" v-model="user.lastname" placeholder="Doe" class="form-input lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">E-mailadres:</p>
                                        </div>
                                        <input type="email" v-model="user.email" placeholder="John@doe.nl" class="form-input email">
                                    </div>
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Telefoonnummer:</p>
                                        </div>
                                        <input type="text" v-model="user.phonenumber" placeholder="0612345678" class="form-input phonenumber">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Straat & huisnummer:</p>
                                        </div>
                                        <input type="email" v-model="userStreetHouseNumer" placeholder="Voorbeeldstraat 1"
                                            class="form-input street-and-housenumber">
                                    </div>
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Postcode:</p>
                                        </div>
                                        <input type="text" v-model="user.postalcode" placeholder="10000AA" class="form-input postalcode">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="column">
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Woonplaats:</p>
                                        </div>
                                        <input type="email" v-model="user.city" placeholder="Amsterdam" class="form-input city">
                                    </div>
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Land:</p>
                                        </div>
                                        <input type="text" v-model="user.country" placeholder="Nederland" class="form-input country">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="row-header column">
                                    <h1>Bedrijfsgegevens: (Optioneel)</h1>
                                </div>
                                <div class="column">
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Bedrijfsnaam:</p>
                                        </div>
                                        <input type="text" v-model="user.company.name" placeholder="Voorbeeld bedrijfsnaam"
                                            class="form-input companyname">
                                    </div>
                                    <div class="item">
                                        <div class="label">
                                            <p class="label-text">Kvknumber:</p>
                                        </div>
                                        <input type="text" v-model="user.company.kvknumber" placeholder="00987654321"
                                            class="form-input kvknumber">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-right">
                            <div class="basket">
                                <div class="basket-header">
                                    <h1>Geselecteerde machine:</h1>
                                </div>
                                <div class="basket-item">
                                    <div class="item-col-left item-col">
                                        <div class="item-logo">
                                            <img :src="getVehicleImage" alt="selected vehicle image" />
                                        </div>
                                    </div>
                                    <div class="item-col-right item-col">
                                        <div class="item-name">
                                            <p>{{ getVehicleName }}</p>
                                        </div>
                                        <div class="item-border"></div>
                                        <div class="item-prices">
                                            <div class="price">
                                                <div class="name">
                                                    <p class="title">Prijs per dag:</p>
                                                </div>
                                                <div class="value">
                                                    <p class="title">{{ getPricePerDay }}</p>
                                                </div>
                                            </div>
                                            <div class="price">
                                                <div class="name">
                                                    <p class="title">Prijs per week:</p>
                                                </div>
                                                <div class="value">
                                                    <p class="title">{{ getPricePerWeek }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alerts" v-if="errorMessage !== '' || succesMessage !== ''" :class="{ 'bg-red-500': errorMessage !== '', 'bg-green-500': succesMessage !== '' }">
                                <p class="alert-text">{{ errorMessage ? errorMessage : succesMessage }}</p>
                            </div>
                            <div class="footer">
                                <div class="alert">
                                    <p>Wanneer u op reserveren klikt zal u een bevestigingsmail krijgen met daarin de gegevens van de reservering!</p>
                                </div>
                                <div @click="_handleSave" class="submit-form cursor-pointer">
                                    <p class="title">Machine reserveren</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>