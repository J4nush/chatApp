<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';

import JetNavLink from '@/Jetstream/NavLink.vue';
import Divider from "primevue/divider";
import Card from "primevue/card";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
                            <JetApplicationMark class="block h-9 w-auto" />
                        </Link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <JetNavLink :href="route('login')">
                            Login
                        </JetNavLink>
                        <JetNavLink :href="route('register')">
                            Register
                        </JetNavLink>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="flex flex-row justify-center">
        <div class="md:w-4/6">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex flex-row items-center">
                        <JetApplicationMark class="w-1/3"/>
                        <div class="w-2/3 text-6xl text-center">
                            Connect instantly with<br/><b>JJChat App</b>
                        </div>
                    </div>
                    <Divider />
                    <div class="w-full flex flex-row flex-wrap justify-between">
                        <Card class="w-1/4">
                            <template #header>
                                <img alt="fast connection icon" src="../../images/fast.webp" />
                            </template>
                            <template #title><p class="text-center">Fast messaging</p></template>
                        </Card>
                        <Card class="w-1/4">
                            <template #header>
                                <img alt="user header" src="../../images/remote.webp" />
                            </template>
                            <template #title><p class="text-center">Remote connection</p></template>
                        </Card>
                        <Card class="w-1/4">
                            <template #header>
                                <img alt="user header" src="../../images/secure.webp" />
                            </template>
                            <template #title><p class="text-center">Secure conversations</p></template>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>
