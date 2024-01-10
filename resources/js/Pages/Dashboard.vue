<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Jetstream/Welcome.vue';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import Card from "primevue/card";
import Divider from "primevue/divider";
</script>

<template>
    <AppLayout title="Dashboard">
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
    </AppLayout>
</template>
