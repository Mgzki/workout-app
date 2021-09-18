<template>
    <section class="px-3 py-4 md:px-6 md:py-8">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <img src="/images/Site-Logo.png" width="165" height="16">
                </a>
            </div>

            <div v-if="canLogin" class="hidden fixed right-1 px-8 py-4 sm:block">
                <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm text-gray-500 underline">
                    Dashboard
                </Link>

                <template v-else>
                    <Link :href="route('login')" class="text-xs font-bold text-gray-700 underline uppercase">
                        Log in
                    </Link>

                    <Link v-if="canRegister" :href="route('register')" class="ml-4 text-xs font-bold text-gray-700 underline uppercase">
                        Register
                    </Link>
                </template>
            </div>
        </nav>

        <div class="mx-auto flex justify-center flex-wrap">
            <slot></slot>
        </div>
        

        <footer id="newsletter"
            class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="/images/Site-Logo.png" alt="" class="mx-auto mb-3">

            <div class="mt-10">
                <div class="relative inline-block mx-auto rounded-full">
                    Nothing here yet
                </div>
            </div>
        </footer>
    </section>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
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