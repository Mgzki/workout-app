<template>
    <div>
        <h6 class="text-8xl text-gray-700 "> 12:00 </h6>
    </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import StandardLayout from '@/Layouts/Standard.vue'

export default {
    layout: StandardLayout,
    components: {
      Head,
      Link,
    },
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    },
}
</script>
