<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ character.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form
                            @submit.prevent="submit"
                            class="flex flex-col space-y-4"
                        >
                            <label for="name">Name:</label>
                            <input id="name" v-model="form.name" />
                            <label for="name">Gender:</label>
                            <input id="name" v-model="form.gender" />
                            <button type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';

export default {
    components: {
        BreezeAuthenticatedLayout,
    },
    props: {
        character: Object,
    },
    data() {
        return {
            form: {
                id: this.id,
                name: this.character.name,
                gender: this.character.gender,
            },
        };
    },
    methods: {
        submit() {},
    },
};
</script>
