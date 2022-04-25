<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white shadow rounded">
            <input
                class="relative w-full px-6 py-3 rounded-r focus:ring"
                autocomplete="off"
                type="text"
                name="search"
                placeholder="Search…"
                :value="value"
                @input="$emit('input', $event.target.value)"
            />
        </div>
        <button
            class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
            type="button"
            @click="$emit('reset')"
        >Reset</button>
    </div>
</template>

<script>
export default {
    // emits: ['input','reset'],
    props: {
        value: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
}
</script>
