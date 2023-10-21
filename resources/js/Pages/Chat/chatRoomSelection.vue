<template>
    <div class="">
        <div class="w-full">
            <div class="w-full pb-4">
                <Dropdown
                    v-model="selected"
                    :options="rooms"
                    optionLabel="name"
                    placeholder="Select a room"
                    track-by="id"
                    @change="$emit('roomchanged', selected)"
                    class="d-block w-full relative rounded-lg bg-slate-300"
                    filter
                    :pt="{
                            panel: {class:'bg-slate-300'},
                            header: {class:'bg-slate-300'},
                            filterContainer: {class:'bg-slate-300'},
                            filterInput: {class: 'rounded-2xl'}
                    }"
                >
                </Dropdown>
            </div>
            <div class="hidden lg:block w-full">
                <Listbox
                    v-model="selected"
                    @change="$emit('roomchanged', selected)"
                    class="none lg:block w-full overflow-y-hidden overflow-x-hidden ChatSelection"
                    style=""
                    optionLabel="name"
                    :options="rooms"
                    :size="rooms.length-2"
                    >

<!--                    <template #option="slotProps">-->
<!--                                {{slotProps.option.name}}-->
<!--            </template>-->

                </Listbox>
            </div>
        </div>
    </div>
</template>

<script>

// import JetButton from '@/Jetstream/Button.vue';
import Button from 'primevue/button';
import Listbox from 'primevue/listbox';
import Dropdown from 'primevue/dropdown';
export default {
    name: "chatRoomSelection",
    props: ['rooms', 'currentRoom'],
    components: {
        Button,
        Listbox,
        Dropdown
    },
    data: function (){
        return {
            selected: '',
        }
    },
    created() {
        this.selected = this.currentRoom;
    }

}
</script>

<style scoped>

.ChatSelection{
    background-image: none;
    padding-right: 0;
    border: unset;
}
</style>
