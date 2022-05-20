<template>
    <div class="">
        <div class="h-96">
            <div class="h-full overflow-scroll overflow-x-hidden">
                <v-select
                    v-model="selected"
                    :options="rooms"
                    label="name"
                    track-by="id"
                    @change="$emit('roomchanged', selected)"
                    style=""
                >
                </v-select>
                <select
                    v-model="selected"
                    @change="$emit('roomchanged', selected)"
                    class="w-80 overflow-y-hidden overflow-x-hidden ChatSelection"
                    style=""
                    :size="rooms.length"
                    >
                       <option
                           v-for="(room, index) in rooms"
                           :key="index"
                           :value="room"
                           >
                       {{room.name}}
                   </option>

                </select>
            </div>
        </div>
    </div>
</template>

<script>
import {VueSelect} from 'vue-select'
import 'vue-select/dist/vue-select.css';
export default {
    name: "chatRoomSelection",
    props: ['rooms', 'currentRoom'],
    components: {
        'v-select': VueSelect
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
