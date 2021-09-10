<template>
  <div id="app">
    <timer
      :canLogin="canLogin"
      :canRegister="canRegister"
      :currTimer="guestTimer"
    ></timer>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import StandardLayout from "@/Layouts/Standard.vue";
import Timer from "../Components/Timer.vue";

export default {
  layout: StandardLayout,
  components: {
    Head,
    Link,
    Timer,
  },
  props: {
    guestTimer: Object,
    canLogin: Boolean,
    canRegister: Boolean,
  },
};
</script>
