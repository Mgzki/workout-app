<template>
  <button
    @click='updateCurrTimer'
    id="app"
    class="bg-gray-100 rounded-lg py-4 px-6 shadow-xs my-10 border flex flex-grow mx-2 divide-x-2 divide-gray-300"
  >
    <div class="px-2 w-60">
        <h1 class="font-bold">{{timer.name}}</h1>
    </div>
    <div class="flex px-2">
        <p class="px-2">Sets: {{ timer.sets }}</p>
        <p class="px-2">Duration: {{ timer.duration }}</p>
        <p class="px-2">Rest Period: {{ timer.rest }}</p>
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
//   data() {
//     const timer = {
//         name: this.timer.name,
//         sets: this.timer.sets,
//         duration: this.timer.duration,
//         rest: this.timer.rest,
//     }
//   }
};
</script>