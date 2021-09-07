<template>
    <div id="app" class="bg-gray-100 rounded-lg py-4 px-8 shadow-xs my-10">
        <h1 class="font-bold text-xl">{{timers.name}}</h1>
        <div class="flex justify-around font-semibold text-sm text-gray-500 mt-2">
            <h1>Hours</h1>
            <h1>Minutes</h1>
            <h1>Seconds</h1>
        </div>
        <div class="mx-auto justify-center bg-gray-200 rounded-xl mb-4 shadow-xs">
            <h6 v-if="elapsedTime > 0" class="text-8xl text-gray-700 px-4">{{ formattedElapsedTime }}</h6>
            <h6 v-else class="text-8xl text-red-500 px-4">00:00:00</h6>
        </div>
        <div class="mx-auto flex justify-around">
            <button @click="start" class="bg-green-500 py-2 px-6 mx-3 rounded">Start</button>
            <button @click="stop" class="bg-gray-400 py-2 px-6 mx-3 rounded">Stop</button>
            <button @click="reset" class="bg-red-500 py-2 px-6 mx-3 rounded">Reset</button>
        </div>
        <div class="bg-gray-200 rounded-xl mt-4 shadow-xs flex">
            <h1 class="px-4 py-2 font-semibold text-md float-left">Sets remaining: {{ setsRemaining }}</h1>
            <h1 class="px-4 py-2 font-semibold text-md float-right">Total sets: {{ timers.sets }} </h1>
            <h1 class="px-4 py-2 font-semibold text-md float-right">Rest duration: {{ timers.rest }}s </h1>
        </div>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import StandardLayout from '@/Layouts/Standard.vue';

export default {
    layout: StandardLayout,
    components: {
      Head,
      Link,
    },
    props: {
        timers: Object,
        canLogin: Boolean,
        canRegister: Boolean,
    },
    data() {
      return {
        elapsedTime: this.timers.duration * 1000,
        setCounter: 0,
        timer: undefined,
        // running: False,
      };
    },
    methods: {
      start() {
        this.timer = setInterval(() => {
          this.elapsedTime -= 1000;
        }, 1000)
        // this.running = True;
      },
      stop() {
        clearInterval(this.timer);
        // this.running = False,
      },
      reset() {
        this.elapsedTime = this.timers.duration * 1000;
      }
    },
    computed: {
    formattedElapsedTime() {
      const date = new Date(null);
      date.setSeconds(this.elapsedTime / 1000);
      const utc = date.toUTCString();
      return utc.substr(utc.indexOf(":") - 2, 8);
    },
    setsRemaining() {
      return this.timers.sets - this.setCounter;
    }
  },
}
</script>