<template>
  <div
    id="app"
    class="bg-gray-100 rounded-lg px-1 py-4 shadow-xs my-10 border md:px-8 "
  >
    <h1 class="font-bold text-md pl-2 md:text-xl">
      {{ currTimer.name }}
    </h1>
    <!-- Time Descriptors -->
    <div class="flex justify-around font-semibold text-md text-gray-500 mt-2">
      <h1>Hours</h1>
      <h1>Minutes</h1>
      <h1>Seconds</h1>
    </div>

    <!-- Time Display -->
    <div class="mx-auto flex justify-center bg-gray-200 mb-4 shadow-xs  border-gray-300 md:border md:rounded-xl">
      <!-- Active set -->
      <DisplayTime v-if="targetTime > 0" class="text-gray-700"> {{ formattedTime }} </DisplayTime>
      <!-- Rest set -->
      <DisplayTime v-else-if="restTime > 0" class="text-orange-500"> {{ formattedTime }} </DisplayTime>
      <!-- Reached zero -->
      <DisplayTime v-else class="text-red-500"> {{ formattedTime }} </DisplayTime>
    </div>

    <!-- Timer Controls -->
    <div class="mx-auto flex justify-around">
      <!-- Start -->
      <TimerButton v-if="!started | paused" @click="allSets" class="bg-green-500 hover:bg-green-400">Start</TimerButton>
      <!-- Disabled Start -->
      <TimerButton v-else class="bg-gray-600 line-through" >Start</TimerButton>
      <!-- Pause -->
      <TimerButton v-if="started && !paused" @click="stop" class="bg-gray-400 hover:bg-gray-300">Pause</TimerButton>
      <!-- Disabled Pause -->
      <TimerButton v-else class="bg-gray-600 line-through">Pause</TimerButton>
      <!-- Reset -->
      <TimerButton @click="reset" class="bg-red-500 hover:bg-red-400">Reset</TimerButton>
    </div>

    <!-- Timer Attributes -->
    <div
      class=" mt-4 shadow-xs bg-gray-200 md:border border-gray-300 md:rounded-xl"
    >
      <div class="text-sm  flex justify-around text-center md:text-md">
        <InfoHeader>Sets:</InfoHeader>
        <InfoHeader>Rest(s):</InfoHeader>
        <InfoHeader>Duration(s):</InfoHeader>
      </div>

      <!-- Timer info -->
      <div class="text-sm  flex justify-around text-center  md:text-md pb-4">
        <!-- Sets -->
        <InfoInput :val="setsRemaining" name="sets" 
          @getVal="getVal($event)"/>
        <!-- Rest -->
        <InfoInput :val="currTimer.rest" name="rest"
          @getVal="getVal($event)"/>
        <!-- Duration -->
        <InfoInput :val="currTimer.duration" name="duration"
          @getVal="getVal($event)"/>
      </div>
    </div>
    <div></div>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import StandardLayout from "@/Layouts/Standard.vue";
import InfoInput from "@/Components/InfoInput.vue";
import TimerButton from "@/Components/TimerButton.vue";
import DisplayTime from "@/Components/DisplayTime.vue";
import InfoHeader from "@/Components/InfoHeader.vue";

export default {
  layout: StandardLayout,
  components: {
    Head,
    Link,
    InfoInput,
    InfoHeader,
    TimerButton,
    DisplayTime,
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
      paused: false,
    };
  },
  methods: {
    async wait(duration, rest) {
      return await new Promise((resolve) => {
        this.paused = false;
        this.timer = setInterval(() => {
          duration -= 1000;
          // Reduces the actual values used in displaying the timer
          rest ? this.restTime -= 1000 : this.targetTime -= 1000;
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
        this.paused = true;
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
      this.paused = false;
    },

    // helper function for allSets() and for when pause is clicked.
    // if the active portion of the timer has finished, start the rest period immediately; otherwise run the full set
    async startSet() {
      this.targetTime < 1000 ? await this.wait(this.restTime, true) : await this.start(); await this.wait(this.restTime, true);
    },

    // runs startSet() as long as there are still sets to be completed
    async allSets() {
      this.started = true;
      for (this.setCounter; this.setCounter < this.currTimer.sets; this.setCounter++) {
        await this.startSet();
        this.reset(false);
        this.setsRemaining;
      }
      // reset the timer to default settings upon completion of the workout
      this.reset(true);
      this.started = false;
    },

    getVal(newVal){
      if (newVal.attrName == 'sets') {
        this.currTimer.sets = newVal.newVal
      } 
      else if (newVal.attrName == 'rest') {
        this.currTimer.rest = newVal.newVal
      }
      else {
        this.currTimer.duration = newVal.newVal
      }
      this.reset()
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