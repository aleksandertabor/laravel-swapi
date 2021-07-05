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
                                    <p>
                                        <strong>Name:</strong>

                                        <breeze-input
                                            id="name"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.name"
                                        />
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Gender:</strong>

                                        <breeze-input
                                            id="gender"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.gender"
                                        />
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Culture:</strong>

                                        <breeze-input
                                            id="gender"
                                            type="text"
                                            class="mt-1 block w-full"
                                            v-model="form.culture"
                                        />
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Born:</strong>

                                        {{ bornYear }}
                                        <breeze-input
                                            id="born"
                                            type="number"
                                            step="0.1"
                                            class="mt-1 block w-full"
                                            v-model="form.born"
                                        />
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Died:</strong>
{{ diedYear }}
                                        <breeze-input
                                            id="died"
                                            type="number"
                                            step="0.1"
                                            class="mt-1 block w-full"
                                            v-model="form.died"
                                        />
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Mass (kg): </strong>
                                        <span>{{ character.mass }}</span>
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Height (cm): </strong>
                                        <span>{{ character.height }}</span>
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Hair color: </strong>
                                        <span>{{ character.hair_color }}</span>
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Skin color: </strong>
                                        <span>{{ character.skin_color }}</span>
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Eye color: </strong>
                                        <span>{{ character.eye_color }}</span>
                                    </p>
                                </div>

                                <div class="mt-4">
                                    <p>
                                        <strong>Titles:</strong>
                                        <ul class="list-disc">
                                            <li
                                                v-for="(
                                                    title, key
                                                ) in character.titles"
                                                :key="key"
                                                v-text="title"
                                                class="ml-5"
                                            ></li>
                                        </ul>
                                    </p>
                                </div>

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
                culture: this.character.culture,
                born: this.character.born,
                died: this.character.died,
            }),
        };
    },
    computed: {
        title() {
            return this.character.name;
        },
        bornYear() {
            return this.starWarsYear(this.form.born);
        },
        diedYear() {
            return this.starWarsYear(this.form.died);
        },
    },
    methods: {
        submit() {
            this.form.patch(
                route('characters.update', this.character.id),
                this.form
            );
        },
        starWarsYear(year) {
            if (year === null || year === '') {
                return '-';
            }

            return year > 0 ? `${year}ABY` : `${Math.abs(year)}BBY`;
        }
    },
};
</script>
