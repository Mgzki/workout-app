<template>
  <Head title="Account Dashboard" />
  <div v-if="timers.length >= 1">
    <timer
      :key="this.timerKey"
      :canLogin="canLogin"
      :canRegister="canRegister"
      :currTimer="this.currTimer"
    />
    <!-- Timer Descriptors -->
    <div class="flex flex-1 justify-around font-semibold underline pt-2 text-xs md:text-lg">
        <p class="w-36 md:w-56 ml-2">Name</p>
        <p class="px-1 md:px-4">Sets</p>
        <p class="px-1 md:px-4">Rest(s)</p>
        <p class="px-1 md:px-4">Duration(s)</p>
    </div>
    <!-- Selectable timers -->
    <div v-if="timers.length > 1" class="bg-gray-100 rounded-lg shadow border overflow-auto max-h-60">
      <div v-for="timer in timers" :key="timer.id" class="hover:bg-blue-100 relative flex">
        <div class="">
          <TimerInfo
            :timer="timer"
            @updateCurrTimer="updateCurrTimer($event)"
          />
        </div>
        <hr>
      </div>
    </div>
    <div class="bg-gray-100 rounded-lg shadow border overflow-auto max-h-60 mt-2">
      <CreateTimer/>
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
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import TimerInfo from "../Components/TimerInfo.vue";
import Timer from "../Components/Timer.vue";
import CreateTimer from "../Components/CreateTimer.vue";
import StandardLayout from "@/Layouts/Standard.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
  layout: StandardLayout,
  components: {
    BreezeAuthenticatedLayout,
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
    canLogin: Boolean,
    canRegister: Boolean,
  },
  methods: {
    updateCurrTimer(newTimer) {
      this.currTimer = newTimer;
      this.timerKey += 1;
    },
    
  },
};
</script>
