<template>
  <div
    id="app"
    class="bg-gray-100 rounded-lg py-4 px-6 shadow-xs my-10 border w-64 mx-2 divide-y-2 divide-gray-300"
  >
    <div>
        <!-- <Link :href="route('timer', timer)" class="font-bold">{{ timer.name }}</Link> -->
        <Link :href="route('timer', timer)" class="font-bold">{{ timer.name }}</Link>
    </div>
    <div>
        <p>Sets: {{ timer.sets }}</p>
        <p>Duration: {{ timer.duration }}</p>
        <p>Rest Period: {{ timer.rest }}</p>
    </div>
  </div>
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