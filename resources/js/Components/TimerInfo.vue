<template>
  <button @click='updateCurrTimer'
    class=" py-6 md:px-2 flex flex-grow divide-x-2 divide-gray-300"
  >
    <div class="px-2 w-44 sm:w-60">
        <h1 class="font-bold text-left">{{timer.name}}</h1>
    </div>
    <div class="flex  w-40 sm:w-56 justify-between">
        <p class="px-2">{{ timer.sets }}</p>
        <p class="px-2">{{ timer.rest }}</p>
        <p class="px-2">{{ timer.duration }}</p>
    </div>
    <div class="flex">
      <!-- Save -->
        <button v-on:click.stop="aaaa" class="px-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
          </svg>

        </button>
      
      <!-- Delete -->
        <button v-on:click.stop="deleteTimer(timer.id)" class="px-0 md:px-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h- w-6 hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      
    </div>
  </button>
  
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  data () {
    return {
      
    }
  },
  components: {
      Link,
  },
  props: {
    timer: Object,
  },
  methods: {
      updateCurrTimer() {
          this.$emit('updateCurrTimer', this.timer)
      },
      aaaa() {
        console.log('button')
      },
      deleteTimer(id) {
      if (confirm('Delete this timer?')) {
        this.$inertia.delete('/dashboard/' + id)
        .then(() => {
          
        })
      }
    }
  }

};
</script>