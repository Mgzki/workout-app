<template>
  <button @click='updateCurrTimer'
    class=" py-4 px-6 my-10 flex flex-grow mx-2 divide-x-2 divide-gray-300"
  >
    <div class="px-2 w-60">
        <h1 class="font-bold text-left">{{timer.name}}</h1>
    </div>
    <div class="flex px-2">
        <p class="px-2">Sets: {{ timer.sets }}</p>
        <p class="px-2">Rest(s): {{ timer.rest }}</p>
        <p class="px-2">Duration(s): {{ timer.duration }}</p>
        
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