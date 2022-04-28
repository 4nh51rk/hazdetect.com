<template>
    <Head title="Edit Ship" />

    <BreezeAuthenticatedLayout>
        <h1 class="my-4 py-3 font-bold text-3xl">
            <Link :href="route('dashboard')" class="text-indigo-400 hover:text-indigo-600">Ships</Link>
            <span class="p-2 text-indigo-400 font-medium">/</span>
            <span>{{ ship.name }}</span>
            <span class="p-2 text-indigo-400 font-medium">/</span>
            <span>Stowage</span>
        </h1>

        <div v-if="false">
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <BreezeValidationErrors class="mb-4" />
            <form @submit.prevent="update">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <BreezeLabel for="name" value="Name" />
                        <BreezeInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                        />
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <BreezeLabel for="imo" value="IMO" />
                        <BreezeInput
                            id="imo"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.imo"
                            autofocus
                        />
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <BreezeLabel for="ssid" value="SSID" />
                        <BreezeInput
                            id="ssid"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.ssid"
                            autofocus
                        />
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <BreezeLabel for="ssid_password" value="SSID Password" />
                        <BreezeInput
                            id="ssid_password"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.ssid_password"
                            autofocus
                        />
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/3">
                        <BreezeLabel for="ipv4" value="IP v4" />
                        <BreezeInput
                            id="ipv4"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.ipv4"
                            autofocus
                        />
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/3">
                        <BreezeLabel for="wifi_ping" value="WiFi Ping Interval" />
                        <BreezeInput
                            id="wifi_ping"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.wifi_ping"
                            autofocus
                        />
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/3">
                        <BreezeLabel for="gsm_ping" value="GSM Ping Interval" />
                        <BreezeInput
                            id="gsm_ping"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.gsm_ping"
                            autofocus
                        />
                    </div>
                </div>
                <div
                    class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
                >
                    <button
                        v-if="true"
                        class="text-red-600 hover:underline"
                        tabindex="-1"
                        type="button"
                        @click="destroy"
                    >Delete Ship</button>
                    <BreezeButton
                        class="ml-auto"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >Update</BreezeButton>
                </div>
            </form>
        </div>

        <div class="max-w-3xl mt-7 mb-1 py-2">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-2xl">Devices</h2>
                <Link
                    class="px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400"
                    :href="route('ship.upload', ship.id)"
                >
                    <span>Upload</span>&nbsp;
                    <span class="hidden md:inline">CSV</span>
                </Link>
            </div>
        </div>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <div class="p-8 bg-white border-b border-gray-200">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="text-left font-bold">
                            <th class="px-6 pt-4 pb-2">IMEI</th>
                            <th class="px-6 pt-4 pb-2">Container Serial</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(device, index) in ship.devices" :key="`device-${index}`">
                            <td>
                                <span class="px-6 py-2 flex items-center">{{ device.imei }}</span>
                            </td>
                            <td>
                                <span
                                    class="px-6 py-2 flex items-center"
                                >{{ device.container_serial }}</span>
                            </td>
                        </tr>
                        <tr v-if="ship.devices.length === 0">
                            <td colspan="2">
                                <span class="px-6 py-2 flex items-center">No Devices found.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
    // remember: 'form',
    // data() {
    //     return {
    //         form: this.$inertia.form({
    //             name: this.ship.name,
    //             imo: this.ship.imo,
    //             ssid: this.ship.ssid,
    //             "ssid_password": this.ship.ssid_password,
    //             ipv4: this.ship.ipv4,
    //             "wifi_ping": this.ship.wifi_ping,
    //             "gsm_ping": this.ship.gsm_ping,
    //         }),
    //     }
    // },
    // methods: {
    //     update() {
    //         this.form.put(this.route('ship.update', this.ship.id))
    //     },
    //     destroy() {
    //         if (confirm('Are you sure you want to delete this ship?')) {
    //             this.$inertia.delete(this.route('ship.destroy', this.ship.id))
    //         }
    //     },
    // },
}
</script>
