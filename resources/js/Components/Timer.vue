<template>
    <div id="app" class="bg-gray-100 rounded-lg py-4 md:px-8 shadow-xs my-10 border">
        <h1 class="font-bold md:text-xl text-md pl-2">{{timers.name}}</h1>
        <div class="flex justify-around font-semibold text-md text-gray-500 mt-2">
            <h1>Hours</h1>
            <h1>Minutes</h1>
            <h1>Seconds</h1>
        </div>
        <div class="mx-auto flex justify-center bg-gray-200 md:rounded-xl mb-4 shadow-xs md:border border-gray-300">
            <h1 v-if="elapsedTime > 0" class="md:text-8xl text-6xl text-gray-700 px-4">{{ formattedElapsedTime }}</h1>
            <h1 v-else-if="restTime > 0" class="md:text-8xl text-6xl text-orange-500 px-4">{{formattedElapsedTime}}</h1>
            <h1 v-else class="md:text-8xl text-6xl text-red-500 px-4">{{formattedElapsedTime}}</h1>
        </div>
        <div class="mx-auto flex justify-around">
            <button @click="allSets" class="bg-green-500 py-2 px-6 mx-3 rounded">Start</button>
            <button @click="stop" class="bg-gray-400 py-2 px-6 mx-3 rounded">Stop</button>
            <button @click="reset" class="bg-red-500 py-2 px-6 mx-3 rounded">Reset</button>
        </div>
        <div class="bg-gray-200 md:rounded-xl mt-4 shadow-xs flex md:border border-gray-300 text-sm md:text-md">
            <h1 class="px-4 py-2 font-semibold float-left">Sets remaining: {{ setsRemaining }}</h1>
            <h1 class="px-4 py-2 font-semibold float-right">Total sets: {{ timers.sets }} </h1>
            <h1 class="px-4 py-2 font-semibold float-right">Rest duration: {{ timers.rest }}s </h1>
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
        restTime: this.timers.rest * 1000,
        setCounter: 0,
        timer: null,
        running: false,
      };
    },
    methods: {
      async wait(duration, rest) {
          return await new Promise(resolve => { this.timer = setInterval(() => {
              duration -= 1000;
              if (rest) {
                  this.restTime -= 1000;
              } else {
                  this.elapsedTime -= 1000;
              }
              if (duration < 1000) {
                  clearInterval(this.timer);
                  resolve('resolved');
              }
          },1000)})
      },
      async start() {
        this.timer = await this.wait(this.elapsedTime, false);
      },
        stop() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
      },

      reset() {
        this.elapsedTime = this.timers.duration * 1000;
        this.restTime = this.timers.rest * 1000;
      },

      async startSet() {
        await this.start(); //starts set timer
        await this.wait(this.restTime, true); //starts rest period timer
      },
      
      // runs startSet() as long as there are still sets to be completed
      async allSets() {
        for (this.setCounter; this.setCounter < this.timers.sets; this.setCounter++){
            await this.startSet();
            this.reset();
            this.setsRemaining;
        }
      }
    },
    computed: {
    formattedElapsedTime() {
      const date = new Date(null);
      (this.elapsedTime > 0 ? date.setSeconds(this.elapsedTime / 1000) : date.setSeconds(this.restTime / 1000))
      const utc = date.toUTCString();
      return utc.substr(utc.indexOf(":") - 2, 8);
    },
    setsRemaining() {
      return this.timers.sets - this.setCounter;
    }
  },
}
</script>