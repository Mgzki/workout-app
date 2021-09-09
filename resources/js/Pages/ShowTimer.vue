<template>
  <div id="app">
    <timer
      :canLogin="canLogin"
      :canRegister="canRegister"
      :timers="timer"
    ></timer>
  </div>
</template>

<script>
import StandardLayout from '@/Layouts/Standard.vue';
import Timer from "../Components/Timer.vue";

export default {
  layout: StandardLayout,
  props: {
    timer: Object,
    canLogin: Boolean,
    canRegister: Boolean,
  },
  components: {
      Timer,
  }
};
</script>