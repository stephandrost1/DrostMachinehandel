<script>

export default {
    data() {
        return {
            Dropzone: null
        }
    },

    computed: {
        getVehicleId() {
            return this.$store.getters.getSelectedVehicle.id;
        },

        getLastVehicleImage() {
            const vehicleImages = this.$store.getters.getSelectedVehicleImages;

            if (vehicleImages.length > 0) {
                return vehicleImages[vehicleImages.length - 1];
            }

            return null
        }
    },

    methods: {
        _handleDropzone(event) {
            _.forEach((event.target.files), async (file) => {
                const image = await this.uploadFile(file);
                    
                if (image) {
                    this.addImageToVehicle(image);
                }
            })
        },

        async uploadFile(file) {
            let formData = new FormData();
            formData.append("file", file);
            formData.append("vehicleId", this.getVehicleId);

            return await axios.post("vehicles/images/upload", formData).then(response => {
                return response.data;
            }).catch((error) => {
                return false;
            })
        },

        addImageToVehicle(image) {
            const imageObject = {
                image_location: `/vehicles/${this.getVehicleId}/`,
                image_name: image.fileName,
                image_type: image.fileExtension,
                vehicle_id: this.getVehicleId,
                id: this.getLastVehicleImage ? this.getLastVehicleImage.id + 1 : 1,
            }

            this.$store.commit("ADD_VEHICLE_IMAGE", imageObject)

        }
    }
}

</script>

<template>
    
    <div class="w-full flex items-center justify-center h-full">
        <div id="dropzone" class="flex justify-center items-center h-full w-full dropzone">
            <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-full cursor-pointer">
                <div class="flex flex-col justify-center items-center h-full pt-5 pb-6">
                    <svg aria-hidden="true" class="mb-3 w-10 h-10 text-primary" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                        </path>
                    </svg>
                    <p class="mb-2 text-sm text-center text-primary"><span class="font-semibold">Click to upload</span> or
                        drag and
                        drop</p>
                    <p class="text-xs text-center text-primary">SVG, PNG, JPG or GIF
                        (MAX. 800x400px)</p>
                </div>
                <input @change="_handleDropzone" id="dropzone-file" multiple type="file" class="hidden">
            </label>
        </div>
    </div>

</template>
