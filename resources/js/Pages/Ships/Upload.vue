<template>
    <BreezeAuthenticatedLayout>
        <h1 class="my-4 py-3 font-bold text-3xl">
            <Link :href="route('dashboard')" class="text-indigo-400 hover:text-indigo-600">Ships</Link>
            <span class="p-2 text-indigo-400 font-medium">/</span>
            <Link
                :href="route('ship.edit', ship.id)"
                class="text-indigo-400 hover:text-indigo-600"
            >{{ ship.name }}</Link>
            <span class="p-2 text-indigo-400 font-medium">/</span>
            <span>Upload CSV</span>
        </h1>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <div class="p-8 bg-white border-b border-gray-200">
                <!-- Drag and Drop File Upload Begin -->
                <div
                    v-if="csvDevices === null"
                    class="p-12 bg-gray-100 border border-gray-300"
                    @dragover="dragover"
                    @dragleave="dragleave"
                    @drop="drop"
                >
                    <input
                        type="file"
                        name="fields[assetsFieldHandle][]"
                        id="assetsFieldHandle"
                        class="w-px h-px opacity-0 overflow-hidden absolute"
                        @change="onChange"
                        ref="file"
                        accept=".csv"
                    />

                    <label for="assetsFieldHandle" class="block cursor-pointer text-center">
                        <div>
                            Drag and drop CSV file in here
                            or
                            <span
                                class="underline"
                            >click here</span> to upload CSV
                        </div>
                    </label>
                </div>
                <!-- Drag and Drop File Upload End -->
                <table v-if="csvDevices !== null" class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-4 pb-2">IMEI</th>
                            <th class="px-6 pt-4 pb-2">Container Serial</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(device, index) in csvDevices" :key="`device-${index}`">
                            <td>
                                <span class="px-6 py-2 flex items-center">{{ device.imei }}</span>
                            </td>
                            <td>
                                <span class="px-6 py-2 flex items-center">{{ device.serial }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div
                v-if="csvDevices !== null"
                class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
            >
                <button
                    v-if="true"
                    class="text-red-600 hover:underline"
                    tabindex="-1"
                    type="button"
                    @click="reset"
                >Reset</button>
                <BreezeButton class="ml-auto" @click="uploadCsv">Upload</BreezeButton>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>


<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

import Papa from 'papaparse';

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        Head,
        Link,
    },
    props: {
        ship: Object,
    },
    data() {
        return {
            csvFile: '',
            csvDevices: null,
            isCsvLoaded: false,
        }
    },
    methods: {
        reset() {
            this.isCsvLoaded = false
            this.csvDevices = null
            this.$refs.file.value = null
        },
        uploadCsv() {
            console.log('postTest()')
            console.log(this.csvDevices)
            // this.$inertia.post(`/ship/${this.ship.id}/upload`,{'Test': 123})
            this.$inertia.post(`/ship/${this.ship.id}/upload`, this.csvDevices)
        },
        onPapaComplete(results, file) {
            this.csvDevices = results.data;
        },
        onChange() {
            console.log('onChange()')
            var file = this.$refs.file.files[0]
            const reader = new FileReader()
            reader.onload = e => {
                this.isCsvLoaded = true
                // console.log(file)
                // this.csvFile = e.target.result
            }
            reader.readAsText(file)

            Papa.parse(file, {
                header: true,
                complete: this.onPapaComplete,
            })
        },
        dragover(event) {
            event.preventDefault();
            // Add some visual fluff to show the user can drop its files
            if (!event.currentTarget.classList.contains('bg-green-300')) {
                event.currentTarget.classList.remove('bg-gray-100');
                event.currentTarget.classList.add('bg-green-300');
            }
        },
        dragleave(event) {
            // Clean up
            event.currentTarget.classList.add('bg-gray-100');
            event.currentTarget.classList.remove('bg-green-300');
        },
        drop(event) {
            event.preventDefault();
            this.$refs.file.files = event.dataTransfer.files;
            this.onChange(); // Trigger the onChange event manually
            // Clean up
            event.currentTarget.classList.add('bg-gray-100');
            event.currentTarget.classList.remove('bg-green-300');
        }
    },
}
</script>
