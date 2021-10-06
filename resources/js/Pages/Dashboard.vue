<template>
  <Head title="Account Dashboard" />
  <div>
    <div v-if="timers.length > 0">
      <timer
        :key="this.timerKey"
        :currTimer="this.currTimer"
      />
      <!-- Timer Descriptors -->
      <div class="flex flex-1 justify-around font-semibold underline px-1 text-xs md:text-lg">
        <p class="w-24 sm:w-36 md:w-56 ml-2">Name</p>
        <p class="px-1 md:px-4">Sets</p>
        <p class="px-1 md:px-4">Rest(s)</p>
        <p class="px-1 md:px-4">Duration(s)</p>
      </div>
    </div>
    
    <!-- Selectable timers -->
    <div v-if="timers.length > 0" :key="this.currTimer" class="bg-gray-100 rounded-lg shadow border overflow-auto max-h-60">
      <div v-for="timer in timers" :key="timer.id" class="hover:bg-blue-100 relative flex">
        <TimerInfo
          :timer="timer"
          :currAttr="currTimer"
          @updateCurrTimer="updateCurrTimer($event)"
        />
        <hr v-if="timers.length > 0">
      </div>
    </div>
    <div class="bg-gray-100 rounded-lg shadow border overflow-auto max-h-60 mt-2">
      <CreateTimer :key="this.currTimer"/>
    </div>
  </div>
</template>

<script>
import TimerInfo from "../Components/TimerInfo.vue";
import Timer from "../Components/Timer.vue";
import CreateTimer from "../Components/CreateTimer.vue";
import StandardLayout from "@/Layouts/Standard.vue";
import AuthenticatedLayout from "@/Layouts/StandardAuthenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
  layout: AuthenticatedLayout,
  components: {
    Head,
    TimerInfo,
    Timer,
    CreateTimer,
  },
  data() {
    return {
      currTimer: this.timers[0],
      timerKey: 0,
    };
  },
  props: {
    timers: [Object],
  },
  methods: {
    updateCurrTimer(newTimer) {
      this.currTimer = newTimer;
      this.timerKey += 1;
    },
    
  },
};
</script>
