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
                <div class="flex flex-col justify-center items-center h-full px-2 py-2">
                    <i class="fas fa-cloud-upload-alt text-primary"></i>
                    <!-- <p class="mb-2 text-sm text-center text-primary"><span class="font-semibold">Click to upload</span> or
                        drag and
                        drop</p> -->
                    <!-- <p class="text-xs text-center text-primary">SVG, PNG, JPG or GIF</p> -->
                    <!-- <p class="text-xs text-center text-primary whitespace-nowrap">(MAX. 800x400px)</p> -->
                </div>
                <input @change="_handleDropzone" id="dropzone-file" multiple type="file" class="hidden">
            </label>
        </div>
    </div>

</template>
