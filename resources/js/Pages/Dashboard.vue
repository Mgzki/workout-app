<template>
  <Head title="Account Dashboard" />
  <div v-if="timers.length >= 1">
    <timer
      :canLogin="canLogin"
      :canRegister="canRegister"
      :currTimer="this.currTimer"
    />

    <!-- Selectable timers -->
    <div v-if="timers.length > 1" class="bg-gray-100 rounded-lg shadow border overflow-auto max-h-60">
      <div v-for="timer in timers" :key="timer.id">
        <div class="-my-8 max-w-4xl">
          <TimerInfo
            :timer="timer"
            @updateCurrTimer="updateCurrTimer($event)"
          />
        </div>
        <hr>
      </div>
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
import StandardLayout from "@/Layouts/Standard.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
  layout: StandardLayout,
  components: {
    BreezeAuthenticatedLayout,
    Head,
    TimerInfo,
    Timer,
  },
  data() {
    return {
      currTimer: this.timers[0],
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
    },
  },
};
</script>
