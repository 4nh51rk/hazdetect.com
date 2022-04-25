<template>
    <Head title="New Ship" />

    <BreezeAuthenticatedLayout>
        <h1 class="my-4 py-3 font-bold text-3xl">
            <Link :href="route('dashboard')" class="text-indigo-400 hover:text-indigo-600">Ships</Link>
            <span class="p-2 text-indigo-400 font-medium">/</span>
            <span>New</span>
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <BreezeValidationErrors class="mb-4" />
            <form @submit.prevent="store">
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
                            required
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
                            required
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
                    <BreezeButton
                        class="ml-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >Save</BreezeButton>
                </div>
            </form>
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
    remember: 'form',
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                imo: null,
                ssid: null,
                "ssid_password": null,
                ipv4: null,
                "wifi_ping": null,
                "gsm_ping": null,
            }),
        }
    },
    methods: {
        store() {
            this.form.post(this.route('ship.store'))
        },
    },
}
</script>
