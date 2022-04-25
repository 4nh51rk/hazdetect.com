<template>
    <Head title="Welcome" />

    <div class="bg-welcome bg-cover">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
            <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="text-sm text-gray-700 underline"
                >Dashboard</Link>

                <template v-else>
                    <Link :href="route('login')" class="text-sm text-gray-700 underline">Log in</Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="ml-4 text-sm text-gray-700 underline"
                    >Register</Link>
                </template>
            </div>

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <p class="mb-0 text-white sm:text-xl">Welcome to</p>
                <div
                    class="text-9xl font-bold text-gray-900 "
                >
                    <span>Haz</span>
                    <span class="text-green-500">Detect</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        Link,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        laravelVersion: String,
        phpVersion: String,
    },
}
</script>
