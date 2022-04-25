<template>
    <Head title="Devices" />

    <BreezeAuthenticatedLayout>
        <h1 class="my-4 py-3 font-bold text-3xl">Devices</h1>
        <div class="mb-6 flex justify-between items-center">
            <div class="w-full max-w-md mr-4">
                <div class="flex items-center">
                    <div class="flex w-full bg-white shadow rounded">
                        <input
                            class="relative w-full px-6 py-3 rounded focus:ring"
                            autocomplete="off"
                            type="text"
                            name="search"
                            placeholder="Search…"
                            v-model="form.search"
                        />
                    </div>
                    <button
                        class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
                        type="button"
                        @click="reset"
                    >Reset</button>
                </div>
            </div>
            <div class="space-x-2">
                <Link
                    class="px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400"
                    :href="route('device.upload')"
                >
                    <span>Upload</span>&nbsp;
                    <span class="hidden md:inline">CSV</span>
                </Link>
                <Link
                    class="px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400"
                    :href="route('device.create')"
                >
                    <span>New</span>&nbsp;
                    <span class="hidden md:inline">Device</span>
                </Link>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white border-b border-gray-200">
                <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                        <tr>
                            <th
                                class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-gray-400 text-left"
                            >IMEI</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >Container Serial</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >Ship Name</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >WiFi</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >Password</th>
                            <th
                                class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-gray-400 text-left"
                            ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(device, index) in devices.data" :key="`device-${index}`">
                            <td
                                class="border-b border-gray-100 p-4 pl-8 text-gray-600"
                            >{{ device.imei }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ device.container_serial }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ device.ship !== null ? device.ship.name : '' }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ device.ship !== null ? device.ship.ssid : '' }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ device.ship !== null ? device.ship.ssid_password : '' }}</td>
                            <td class="border-b border-gray-100 p-4 pr-8 text-gray-600">
                                <Link
                                    :href="route('device.edit', device.id)"
                                    class="text-sm text-gray-700 underline"
                                >Edit</Link>
                            </td>
                        </tr>
                        <tr v-if="devices.data.length === 0">
                            <td colspan="6">
                                <span class="px-6 py-2 flex items-center">No Devices found.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <BreezePagination class="pt-4" :links="devices.links" />
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import BreezeSearchFilter from '@/Components/SearchFilter.vue'
import BreezePagination from '@/Components/Pagination.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeSearchFilter,
        BreezePagination,
        Head,
        Link,
    },
    props: {
        filters: Object,
        devices: Object,
    },
    methods: {
        reset() {
            console.log('reset')
            this.form = mapValues(this.form, () => null)
        },
    },
    data() {
        return {
            form: {
                search: this.filters.search,
            },
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(this.route('device'), pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
}
</script>
