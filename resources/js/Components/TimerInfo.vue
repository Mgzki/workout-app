<template>
  <button @click='updateCurrTimer'
    class=" py-4 md:px-2 my-10 flex flex-grow divide-x-2 divide-gray-300"
  >
    <div class="px-2 w-44 sm:w-60">
        <h1 class="font-bold text-left">{{timer.name}}</h1>
    </div>
    <div class="flex  w-40 sm:w-56 justify-between">
        <p class="px-2">{{ timer.sets }}</p>
        <p class="px-2">{{ timer.rest }}</p>
        <p class="px-2">{{ timer.duration }}</p>
    </div>
  </button>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
  components: {
      Link,
  },
  props: {
    timer: Object,
  },
  methods: {
      updateCurrTimer() {
          this.$emit('updateCurrTimer', this.timer)
      }
  }

};
</script>