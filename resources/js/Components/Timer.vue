<template>
  <div
    id="app"
    class="bg-gray-100 rounded-lg py-4 md:px-8 shadow-xs my-10 border "
  >
    <h1 class="font-bold md:text-xl text-md pl-2">{{ currTimer.name }}</h1>
    <!-- Time Descriptors -->
    <div class="flex justify-around font-semibold text-md text-gray-500 mt-2">
      <h1>Hours</h1>
      <h1>Minutes</h1>
      <h1>Seconds</h1>
    </div>

    <!-- Time Display -->
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

    <!-- Timer Controls -->
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

    <!-- Timer Attributes -->
    <div
      class="md:rounded-xl mt-4 shadow-xs bg-gray-200 md:border border-gray-300"
    >
      <div class="text-sm md:text-md flex justify-around text-center">
        <h1 class="px-4 py-2 font-semibold float-left w-32 ">Sets:</h1>
        <h1 class="px-4 py-2 font-semibold float-center w-32">Total sets:</h1>
        <h1 class="px-4 py-2 font-semibold float-right w-32">Rest(s):</h1>
        <h1 class="px-4 py-2 font-semibold float-right w-32">Set time(s):</h1>
      </div>
      <!-- Temp Increment buttons -->
      <div class="flex justify-around text-center">
        <button class="px-5"
          @click="() => { currTimer.duration += 1; this.reset()}">
            
        </button>
        <button class="px-2 bg-green-500 rounded-xl"
          @click="() => { currTimer.sets += 1; this.reset()}">
            Inc
        </button>
        <button class="px-2 bg-green-500 rounded-xl"
          @click="() => { currTimer.rest += 1; this.reset()}">
            Inc
        </button>
        <button class="px-2 bg-green-500 rounded-xl"
          @click="() => { currTimer.duration += 1; this.reset()}">
            Inc
        </button>
      </div>
      <!-- Timer info -->
      <div class="text-sm md:text-md flex justify-around text-center">
        <h1 class="px-4 py-2 font-semibold float-left">{{ setsRemaining }}</h1>
        <h1 class="px-4 py-2 font-semibold float-center">{{ currTimer.sets }}</h1>
        <h1 class="px-4 py-2 font-semibold float-right">{{ currTimer.rest }}</h1>
        <h1 class="px-4 py-2 font-semibold float-right">{{ currTimer.duration }}</h1>
      </div>
      <!-- Temp Decrement buttons -->
      <div class="flex justify-around text-center mb-4">
        <button class="px-6"
          @click="() => { currTimer.duration -= 1; this.reset()}">
            
        </button>
        <button class="px-2 bg-red-500 rounded-xl"
          @click="() => { currTimer.sets -= 1; this.reset()}">
            Dec
        </button>
        <button class="px-2 bg-red-500 rounded-xl"
          @click="() => { currTimer.rest -= 1; this.reset()}">
            Dec
        </button>
        <button class="px-2 bg-red-500 rounded-xl"
          @click="() => { currTimer.duration -= 1; this.reset()}">
            Dec
        </button>
      </div>
    </div>
    <div></div>
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
    currTimer: Object,
    canLogin: Boolean,
    canRegister: Boolean,
  },
  data() {
    return {
      targetTime: this.currTimer.duration * 1000,
      restTime: this.currTimer.rest * 1000,
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
      this.targetTime = this.currTimer.duration * 1000;
      this.restTime = this.currTimer.rest * 1000;
      
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
        this.setCounter < this.currTimer.sets;
        this.setCounter++
      ) {
        await this.startSet();
        this.reset(false);
        this.setsRemaining;
      }
      this.reset(true);
      this.started = false;
    },
    updateCurrTimer(newTimer) {
      this.currTimer = newTimer;
    }
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
      return this.currTimer.sets - this.setCounter;
    },
  },
};
</script>