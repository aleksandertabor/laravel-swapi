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
                            <label class="block text-gray-700">Gender:</label>
                            <select
                                v-model="form.gender"
                                class="mt-1 w-full form-select"
                            >
                                <option value="" selected>All</option>
                                <option
                                    v-for="gender in genders"
                                    :key="gender"
                                    :value="gender"
                                >
                                    {{ gender }}
                                </option>
                            </select>
                            <search-filter
                                v-model="form.search"
                                class="w-full max-w-md mr-4"
                                @reset="reset"
                            >
                            </search-filter>
                            <div
                                class="
                                    bg-white
                                    rounded-md
                                    shadow
                                    overflow-x-auto
                                "
                            >
                                <table
                                    class="table-auto w-full whitespace-nowrap"
                                >
                                    <tr class="text-left font-bold">
                                        <th class="px-6 pt-6 pb-4">Name</th>
                                        <th class="px-6 pt-6 pb-4">
                                            Height (cm)
                                        </th>
                                        <th class="px-6 pt-6 pb-4">
                                            Mass (kg)
                                        </th>
                                        <th class="px-6 pt-6 pb-4">
                                            Hair color
                                        </th>
                                        <th class="px-6 pt-6 pb-4">
                                            Skin color
                                        </th>
                                        <th class="px-6 pt-6 pb-4">
                                            Eye color
                                        </th>
                                        <th class="px-6 pt-6 pb-4">
                                            Birth year
                                        </th>
                                        <th class="px-6 pt-6 pb-4">Gender</th>
                                        <th class="px-6 pt-6 pb-4" colspan="2">
                                            Films
                                        </th>
                                        <th class="px-6 pt-6 pb-4"></th>
                                    </tr>

                                    <tr
                                        v-for="character in characters.data"
                                        :key="character.id"
                                        class="
                                            hover:bg-gray-100
                                            focus-within:bg-gray-100
                                        "
                                    >
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.name }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.height }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.mass }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.hair_color }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.skin_color }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.eye_color }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.birth_year }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t">
                                            <inertia-link
                                                class="
                                                    px-6
                                                    py-4
                                                    flex
                                                    items-center
                                                    focus:text-indigo-500
                                                "
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                            >
                                                {{ character.gender }}
                                            </inertia-link>
                                        </td>
                                        <td class="border-t w-px">
                                            <inertia-link
                                                class="px-4 flex items-center"
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                                tabindex="-1"
                                            >
                                                Star Wars 1
                                            </inertia-link>
                                        </td>
                                        <td class="border-t w-px">
                                            <inertia-link
                                                class="px-4 flex items-center"
                                                :href="
                                                    route(
                                                        'characters.show',
                                                        character.id
                                                    )
                                                "
                                                tabindex="-1"
                                            >
                                                <span
                                                    class="
                                                        text-4xl text-star-wars
                                                    "
                                                    >&rsaquo;</span
                                                >
                                            </inertia-link>
                                        </td>
                                    </tr>
                                    <tr v-if="characters.data.length === 0">
                                        <td
                                            class="border-t px-6 py-4"
                                            colspan="4"
                                        >
                                            No characters found.
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <pagination
                                class="mt-6"
                                :links="characters.meta.links"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </breeze-authenticated-layout>
    </div>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import BreezeButton from '@/Components/Button';
import Pagination from '@/Components/Pagination';
import SearchFilter from '@/Components/SearchFilter';
import pickBy from 'lodash/pickBy';
import throttle from 'lodash/throttle';
import mapValues from 'lodash/mapValues';

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
        Pagination,
        SearchFilter,
    },
    props: {
        filters: Object,
        characters: Object,
        genders: Array,
    },
    data() {
        return {
            title: '🧑 Characters from Star Wars',
            form: {
                search: this.filters.search,
                gender: this.filters.gender,
            },
        };
    },
    watch: {
        form: {
            handler: throttle(function () {
                this.$inertia.get(this.route('characters'), pickBy(this.form), {
                    preserveState: true,
                });
            }, 500),
            deep: true,
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null);
        },
    },
};
</script>
