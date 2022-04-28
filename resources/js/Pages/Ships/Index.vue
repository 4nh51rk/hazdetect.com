<template>
    <Head title="Ships" />

    <BreezeAuthenticatedLayout>
        <h1 class="my-4 py-3 font-bold text-3xl">Ships</h1>
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
            <Link
                class="px-6 py-3 rounded bg-indigo-600 text-white text-sm leading-4 font-bold whitespace-nowrap hover:bg-orange-400 focus:bg-orange-400"
                :href="route('ship.create')"
            >
                <span>New</span>&nbsp;
                <span class="hidden md:inline">Ship</span>
            </Link>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white border-b border-gray-200">
                <table class="border-collapse table-auto w-full text-sm">
                    <thead>
                        <tr>
                            <th
                                class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-gray-400 text-left"
                            >Name</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >IMO</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >WiFi</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >Password</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >IP v4</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >WiFi Interval</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >GSM Interval</th>
                            <th
                                class="border-b font-medium p-4 pt-0 pb-3 text-gray-400 text-center"
                            >Devices</th>
                            <th
                                class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-gray-400 text-left"
                            ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ship, index) in ships.data" :key="`ship-${index}`">
                            <td
                                class="border-b border-gray-100 p-4 pl-8 text-gray-600"
                            >{{ ship.name }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ ship.imo }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ ship.ssid }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ ship.ssid_password }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ ship.ipv4 }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ ship.wifi_ping }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ ship.gsm_ping }}</td>
                            <td
                                class="border-b border-gray-100 p-4 text-gray-600 text-center"
                            >{{ ship.devices_count }}</td>
                            <td class="border-b border-gray-100 p-4 pr-8 text-gray-600">
                                <Link
                                    :href="route('ship.edit', ship.id)"
                                    class="text-sm text-gray-700 underline"
                                >Edit</Link>
                                &nbsp;
                                <Link v-if="ship.devices_count"
                                    :href="route('ship.stowage', ship.id)"
                                    class="text-sm text-gray-700 underline"
                                >Stow</Link>
                            </td>
                        </tr>
                        <tr v-if="ships.data.length === 0">
                            <td colspan="8">
                                <span class="px-6 py-2 flex items-center">No Ships found.</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <BreezePagination class="pt-4" :links="ships.links" />
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
        ships: Object,
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
                this.$inertia.get(this.route('dashboard'), pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
}
</script>
