<template>
  <button @click='updateCurrTimer'
    class="px-1 py-6 md:px-2 flex flex-grow divide-x-2 divide-gray-300"
  >
    <div class="px-2 w-28 xs:w-44 sm:w-60">
        <h1 class="font-bold text-left">{{ timer.name }}</h1>
    </div>
    <div class="flex w-24 xs:w-40 sm:w-56 justify-between text-right">
        <p class="w-6">{{ timer.sets }}</p>
        <p class="w-6">{{ timer.rest }}</p>
        <p class="mr-2 px-1 w-10">{{ timer.duration }}</p>
    </div>
    <div class="flex">
      <!-- Save -->
      <form @submit.prevent="submit">
        <input type="number" v-model="updateSets" class="hidden" >
        <input type="number" v-model="updateRest" class="hidden" >
        <input type="number" v-model="updateDuration" class="hidden">
        <button type="submit" v-on:click.stop="updateTimer()" class="px-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
          </svg>
        </button>
      </form>
      
      <!-- Delete -->
      <form @submit.prevent="">
        <button v-on:click.stop="deleteTimer(timer.id)" class="px-0 md:px-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="h- w-6 hover:text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      </form>
        
      
    </div>
  </button>
  
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

export default {
  data () {
    return {
      updateSets: this.currAttr.sets,
      updateRest: this.currAttr.rest,
      updateDuration: this.currAttr.duration,
    }
  },
  components: {
    Link,
  },
  props: {
    timer: Object,
    currAttr: Object,
  },
  methods: {
      updateCurrTimer() {
          this.$emit('updateCurrTimer', this.timer)
      },
      deleteTimer(id) {
        if (confirm('Delete this timer?')) {
          this.$inertia.delete('/dashboard/' + id)
          .then(() => {   
            })
        }
      },
      updateTimer() {
        if (confirm('Update this timer?')) {
          Inertia.patch('/dashboard/' + this.currAttr.id, this.currAttr)
        }
        this.updateCurrTimer();
      }

  }

};
</script>