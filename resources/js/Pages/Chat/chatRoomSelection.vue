<template>
    <div class="">
        <div class="sm:h-20 md:h-96 ">
            <div class="w-80 d-block">
                <v-select
                    v-model="selected"
                    :options="rooms"
                    label="name"
                    track-by="id"
                    @change="$emit('roomchanged', selected)"
                    class="d-block w-60 relative sm:rounded-lg"
                    style="background: white;"
                >
                </v-select>
            </div>
            <div class="h-full overflow-scroll overflow-x-hidden mt-2 relative sm:rounded-lg">
                <select
                    v-model="selected"
                    @change="$emit('roomchanged', selected)"
                    class="w-full md:w-80 overflow-y-hidden overflow-x-hidden ChatSelection"
                    style=""
                    :size="rooms.length"
                    >
                       <option
                           v-for="(room, index) in rooms"
                           :key="index"
                           :value="room"
                           class="sm:rounded-lg"
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
