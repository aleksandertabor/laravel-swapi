<template>
    <div class="flex h-full items-center">
        <div class="flex w-full bg-white shadow rounded">
            <input
                class="relative w-full px-6 rounded-r sm:border-l-0 focus:ring"
                autocomplete="off"
                type="text"
                name="search"
                placeholder="Search…"
                :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)"
            />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: String,
        maxWidth: {
            type: Number,
            default: 300,
        },
    },
};
</script>
