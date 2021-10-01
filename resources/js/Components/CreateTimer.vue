<template>
  <form @submit.prevent="submit">
    <div class="px-1 py-6 md:px-2 flex flex-grow divide-x-2 divide-gray-300 relative">
        <div class="px-2 w-28 sm:w-60">
            <!-- Name Input -->
            <input v-model="form.name" type="text" placeholder="Name" 
                class="px-2 py-2 font-semibold float-left bg-white border border-gray-300 rounded-lg w-full s:w-36 md:w-full text-left">
        </div>
        <div class="flex w-30 sm:w-56 justify-between">
            <!-- Sets -->
            <input v-model="form.sets" type="number" placeholder="Sets" class="w-8 sm:w-16 mx-1 py-2 font-semibold float-left bg-white border border-gray-300 rounded-lg text-left">
            <!-- Rest -->
            <input v-model="form.rest" type="number" placeholder="Rest" class="w-8 sm:w-16 py-2 font-semibold float-left bg-white border border-gray-300 rounded-lg text-left">
            <!-- Duration -->
            <input v-model="form.duration" type="number" placeholder="Duration" class="w-8 sm:w-16 mx-1 py-2 font-semibold float-left bg-white border border-gray-300 rounded-lg text-left">
        </div>
        <div class="flex">
        <!-- Save -->
            <button type="submit" :disabled="form.processing" class="px-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
            </button>
        </div>
    </div>
  </form>
  
</template>

<script>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

export default {
  setup() {
    const form = reactive({
        name: null,
        sets: null,
        rest: null,
        duration: null,
    })
    function submit() {
        Inertia.post('/dashboard', form)
    }
    return { form, submit }
  }
}
</script>
