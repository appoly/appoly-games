<template>
    <Head title="Appoly Games" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Appoly Games
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div v-for="game in games" class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105">
                        <a :href="game.route" class="bg-white overflow-hidden shadow-sm rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105">
                            <div class="p-2 text-center">
                                <img 
                                    :src="game.image" 
                                    alt="Game Image" 
                                    class="w-full h-48 object-cover rounded-t-lg mb-2"
                                />
                                <h3 class="text-sm font-semibold text-gray-800">
                                    {{ game.name }}
                                </h3>
                            </div>
                        </a>
                    </div>
                    <!-- Repeat this div 3 more times -->
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue'

const props = defineProps(['games']);
const games = ref(props.games);

</script>
