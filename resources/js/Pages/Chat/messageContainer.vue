<template>
    <div class="h-full w-full">
        <ScrollPanel class="h-[73vh] p-2 " :pt="{content: {class: 'flex flex-col-reverse'}}">
                        <template v-for="(message, index) in messages" :key="index">
                            <message-item :message="message" />
                        </template>
        </ScrollPanel>

<!--        <div class="h-full p-2 flex flex-col-reverse overflow-scroll overflow-x-hidden dark:bg-gray-600">-->
<!--            <div v-for="(message, index) in messages" :key="index">-->
<!--                <message-item :message="message" />-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
import MessageItem from "./messageItem";
import ScrollPanel from 'primevue/scrollpanel';
export default {
    name: "messageContainer",
    components: {MessageItem, ScrollPanel},
    props: ['messages']
}
</script>

<style scoped>

</style>
