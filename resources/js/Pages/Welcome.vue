<template>
    <div id="app">
      <timer :canLogin="canLogin" :canRegister="canRegister" :timers="test"></timer>
      <!-- <div>
        {{test.name}}
      </div> -->
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import StandardLayout from '@/Layouts/Standard.vue';
import Timer from '../Components/Timer.vue';

export default {
    layout: StandardLayout,
    components: {
      Head,
      Link,
      Timer,
    },
    props: {
        test: Object,
        canLogin: Boolean,
        canRegister: Boolean,
    },
    // props : ['test']
  
}
</script>
