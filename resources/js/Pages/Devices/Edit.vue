<template>
    <Head title="Edit Device" />

    <BreezeAuthenticatedLayout>
        <h1 class="my-4 py-3 font-bold text-3xl">
            <Link :href="route('device')" class="text-indigo-400 hover:text-indigo-600">Devices</Link>
            <span class="p-2 text-indigo-400 font-medium">/</span>
            <span>Edit</span>
        </h1>

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <BreezeValidationErrors class="mb-4" />
            <form @submit.prevent="update">
                <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                    <div class="pr-6 pb-8 w-full">
                        <BreezeLabel for="ship_id" value="Ship" />
                        <!-- <BreezeInput
                                id="ship_id"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.ship_id"
                                autofocus
                        />-->
                        <select
                            id="ship_id"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                            v-model="form.ship_id"
                        >
                            <option :value="null">-- Empty --</option>
                            <option
                                v-for="(ship, index) in ships"
                                :key="`ship-${index}`"
                                :value="ship.id"
                            >{{ ship.name }}</option>
                        </select>
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <BreezeLabel for="container_serial" value="Container Serial" />
                        <BreezeInput
                            id="container_serial"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.container_serial"
                            required
                            autofocus
                        />
                    </div>
                    <div class="pr-6 pb-8 w-full lg:w-1/2">
                        <BreezeLabel for="imei" value="IMEI" />
                        <BreezeInput
                            id="imei"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.imei"
                            required
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
                    >Delete Device</button>
                    <BreezeButton
                        class="ml-auto"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >Update</BreezeButton>
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
        device: Object,
        ships: Array,
    },
    remember: 'form',
    data() {
        return {
            shipSelected: '',
            form: this.$inertia.form({
                "ship_id": this.device.ship_id,
                "container_serial": this.device.container_serial,
                imei: this.device.imei,
            }),
        }
    },
    methods: {
        update() {
            this.form.put(this.route('device.update', this.device.id))
        },
        destroy() {
            if (confirm('Are you sure you want to delete this device?')) {
                this.$inertia.delete(this.route('device.destroy', this.device.id))
            }
        },
    },
}
</script>
