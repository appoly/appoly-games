<template>
    <Head title="Tic Tac Toe" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Tic Tac Toe
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg py-4 px-6 "
                >
                    <Link :href="route('games.tic-tac-toe.store')" method="post" as="button" class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900">Create Game</Link>

                    <ul class="divide-y mt-6">
                        <li v-for="room in rooms" :key="room.id" class="px-2 py-1.5 flex justify-between items-center">
                            <span>{{ room.player_one.name }}</span>
                            <Link :href="room.player_one_id == user.id || room.player_two_id == user.id ? route('games.tic-tac-toe.rejoin', room) : route('games.tic-tac-toe.join', room)" method="post" as="button" class="hover:bg-gray-50 transition-colors p-2 rounded">{{ room.player_one_id == user.id || room.player_two_id == user.id ? 'Rejoin Game' : 'Join Game' }}</Link>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue'


const props = defineProps(['rooms']);
const rooms = ref(props.rooms.data);
const page = usePage();
const user = computed(() => page.props.auth.user);


Echo.private('lobby').listen('GameJoined', (event) => {
    console.log(event);
    rooms.value = rooms.value.filter((room) => room.id !== event.room.id);

    if(rooms.value.length < 5) {
        router.reload({ only: ['rooms'], onSuccess: () => rooms.value = props.rooms.data});
    }
});

</script>
