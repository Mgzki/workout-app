<template>
    <Head title="Account Dashboard" />
    <div v-for="timer in timers" :key='timer.id'>
        <div class="-my-8">
            <TimerInfo :timer="timer" />
        </div>
    </div>

    <!-- <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout> -->
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import TimerInfo from '../Components/TimerInfo.vue'
import StandardLayout from '@/Layouts/Standard.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Standard from '@/Layouts/Standard.vue';

export default {
    layout: StandardLayout,
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Standard,
        TimerInfo,
    },
    props: {
        timers: [Object],
        canLogin: Boolean,
        canRegister: Boolean,
    }
}
</script>
