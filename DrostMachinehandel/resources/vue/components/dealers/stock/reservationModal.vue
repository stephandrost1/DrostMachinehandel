<script>

export default {

}

</script>

<template>
    <div class="relative z-20">
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-lg bg-white border-2 border-primary text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-truck-pickup text-green-600"></i>
                            </div>
                            <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Machine reserveren
                            </h3>
                        </div>
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left grow">

                                <div class="mt-2 flex flex-col gap-5">
                                    <div class="flex items-center justify-between">
                                        <div class="font-bold">Bericht:</div>
                                        <textarea placeholder="Type hier uw bericht..." v-model="content"
                                            @change="_handleInput" rows="2"
                                            class="w-1/2 sm:!w-7/12 rounded-lg border-2 border-primary pl-2"></textarea>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="font-bold">Aantal:</div>
                                        <input placeholder="Bijv. 5"
                                            class="w-1/2 sm:!w-7/12 h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                            type="text" id="amount" />
                                    </div>
                                    <div class="flex flex-row items-start sm:items-center justify-between">
                                        <div class="font-bold">Datum:</div>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <div class="flex items-center gap-2 sm:block">
                                                <div>Van:</div>
                                                <input
                                                    class="h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                    type="date" id="from-date" />
                                            </div>
                                            <div class="flex items-center gap-2 sm:block">
                                                <div>Tot:</div>
                                                <input
                                                    class="h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                                    type="date" id="until-date" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="font-bold">Postcode:</div>
                                        <input placeholder="Bijv. 3911VE"
                                            class="w-1/2 sm:!w-7/12 h-12 rounded-lg border-2 border-primary pl-2 focus:ring-0 focus:border-primary"
                                            type="text" id="postalcode" />
                                    </div>



                                    <div class="flex justify-end items-center gap-5">
                                        <div>
                                            <div
                                                class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-red-500 bg-red-200 text-red-500 font-bold">
                                                Annuleren</div>
                                        </div>
                                        <div>
                                            <div
                                                class="cursor-pointer flex w-min rounded-lg shadow-xl py-2 px-5 border-2 border-green-500 bg-green-200 text-green-500 font-bold">
                                                Aanvragen</div>
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