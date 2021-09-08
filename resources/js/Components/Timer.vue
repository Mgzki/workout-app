<template>
  <div
    id="app"
    class="bg-gray-100 rounded-lg py-4 md:px-8 shadow-xs my-10 border"
  >
    <h1 class="font-bold md:text-xl text-md pl-2">{{ timers.name }}</h1>
    <div class="flex justify-around font-semibold text-md text-gray-500 mt-2">
      <h1>Hours</h1>
      <h1>Minutes</h1>
      <h1>Seconds</h1>
    </div>
    <div
      class="
        mx-auto
        flex
        justify-center
        bg-gray-200
        md:rounded-xl
        mb-4
        shadow-xs
        md:border
        border-gray-300
      "
    >
      <h1 v-if="targetTime > 0" class="md:text-8xl text-6xl text-gray-700 px-4">
        {{ formattedTime }}
      </h1>
      <h1
        v-else-if="restTime > 0"
        class="md:text-8xl text-6xl text-orange-500 px-4"
      >
        {{ formattedTime }}
      </h1>
      <h1 v-else class="md:text-8xl text-6xl text-red-500 px-4">
        {{ formattedTime }}
      </h1>
    </div>
    <div class="mx-auto flex justify-around">
      <button v-if="!started" @click="allSets" class="bg-green-500 py-2 px-6 mx-3 rounded">
        Start
      </button>
      <button v-else class="bg-gray-600 py-2 px-6 mx-3 rounded line-through">
        Start
      </button>
      <button @click="stop" class="bg-gray-400 py-2 px-6 mx-3 rounded">
        Stop
      </button>
      <button @click="reset" class="bg-red-500 py-2 px-6 mx-3 rounded">
        Reset
      </button>
    </div>
    <div
      class="md:rounded-xl mt-4 shadow-xs bg-gray-200 md:border border-gray-300"
    >
      <div class="text-sm md:text-md flex justify-around">
        <h1 class="px-4 py-2 font-semibold float-left">Sets:</h1>
        <h1 class="px-4 py-2 font-semibold float-center">Total sets:</h1>
        <h1 class="px-4 py-2 font-semibold float-right">Rest(s):</h1>
        <h1 class="px-4 py-2 font-semibold float-right">Set time(s):</h1>
      </div>
      <div>
        <button
          @click="() => { timers.duration += 1; this.reset()}">
            Inc
        </button>
      </div>
      <div class="text-sm md:text-md flex justify-around text-center">
        <h1 class="px-4 py-2 font-semibold float-left">{{ setsRemaining }}</h1>
        <h1 class="px-4 py-2 font-semibold float-center">{{ timers.sets }}</h1>
        <h1 class="px-4 py-2 font-semibold float-right">{{ timers.rest }}</h1>
        <h1 class="px-4 py-2 font-semibold float-right">{{ timers.duration }}</h1>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import StandardLayout from "@/Layouts/Standard.vue";

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
      targetTime: this.timers.duration * 1000,
      restTime: this.timers.rest * 1000,
      setCounter: 0,
      timer: null,
      started: false,
    };
  },
  methods: {
    async wait(duration, rest) {
      return await new Promise((resolve) => {
        this.timer = setInterval(() => {
          duration -= 1000;
          if (rest) {
            this.restTime -= 1000;
          } else {
            this.targetTime -= 1000;
          }
          if (duration < 1000) {
            clearInterval(this.timer);
            resolve("resolved");
          }
        }, 1000);
      });
    },
    async start() {
      this.timer = await this.wait(this.targetTime, false);
    },
    stop() {
      if (this.timer) {
        clearInterval(this.timer);
        this.timer = null;
      }
    },
    reset(end) {
        if (end) {
          this.setCounter = 0;
          this.started = false;
          this.stop();
      }
      this.targetTime = this.timers.duration * 1000;
      this.restTime = this.timers.rest * 1000;
      
    },

    async startSet() {
      await this.start(); //starts set timer
      await this.wait(this.restTime, true); //starts rest period timer
    },

    // runs startSet() as long as there are still sets to be completed
    async allSets() {
      this.started = true;
      for (
        this.setCounter;
        this.setCounter < this.timers.sets;
        this.setCounter++
      ) {
        await this.startSet();
        this.reset(false);
        this.setsRemaining;
      }
      this.reset(true);
      this.started = false;
    },
  },
  computed: {
    formattedTime() {
      const date = new Date(null);
      this.targetTime > 0
        ? date.setSeconds(this.targetTime / 1000)
        : date.setSeconds(this.restTime / 1000);
      const utc = date.toUTCString();
      return utc.substr(utc.indexOf(":") - 2, 8);
    },
    setsRemaining() {
      return this.timers.sets - this.setCounter;
    },
  },
};
</script>