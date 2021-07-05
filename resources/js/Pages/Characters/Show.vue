<template>
    <div>
        <breeze-authenticated-layout>
            <inertia-head :title="title" />

            <template #header>
                <h2
                    class="font-semibold text-xl text-gray-800 leading-tight"
                    v-text="title"
                ></h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div class="p-6 bg-white border-b border-gray-200">
                            <breeze-validation-errors class="mb-4" />
                            <flash-messages class="mb-4" />

                            <form
                                @submit.prevent="submit"
                                class="flex flex-col space-y-4"
                            >
                                <div class="mt-4">
                                    <breeze-label for="name" value="Name:" />

                                    <breeze-input
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                    />
                                </div>

                                <div class="mt-4">
                                    <breeze-label
                                        for="gender"
                                        value="Gender:"
                                    />

                                    <breeze-input
                                        id="gender"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.gender"
                                    />
                                </div>

                                <template
                                    v-for="(value, key) in character"
                                    :key="character.id"
                                >
                                    <div class="mt-4">
                                        <p>
                                            {{ key }}:
                                            <span>{{ value }}</span>
                                        </p>
                                    </div>
                                </template>

                                <div class="flex items-center">
                                    <breeze-button
                                        class="text-star-wars"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Save
                                    </breeze-button>
                                </div>
                            </form>

                            <div v-if="form.isDirty" class="mt-4">
                                There are unsaved form changes.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </breeze-authenticated-layout>
    </div>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import BreezeLabel from '@/Components/Label';
import BreezeButton from '@/Components/Button';
import BreezeInput from '@/Components/Input';
import BreezeValidationErrors from '@/Components/ValidationErrors';
import FlashMessages from '@/Components/FlashMessages';

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeLabel,
        BreezeInput,
        BreezeButton,
        BreezeValidationErrors,
        FlashMessages,
    },
    props: {
        character: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                id: this.id,
                name: this.character.name,
                gender: this.character.gender,
            }),
        };
    },
    computed: {
        title() {
            return this.character.name;
        },
    },
    methods: {
        submit() {
            this.form.patch(
                route('characters.update', this.character.id),
                this.form
            );
        },
    },
};
</script>
