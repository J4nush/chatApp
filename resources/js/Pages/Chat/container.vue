<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
                {{currentRoom.name}}
            </h2>
        </template>
        <div class="py-12 grid grid-cols-6">
            <div class="mx-auto">
                <!--class="max-w-3xl mx-auto sm:px-6 lg:px-4" -->
                    <chat-room-selection
                        v-if="currentRoom.id"
                        :rooms="chatRooms"
                        :currentRoom="currentRoom"
                        v-on:roomchanged="setRoom($event)"
                    />
                <!--class="max-w-7xl mx-auto sm:px-6 lg:px-8" -->
            </div>
            <div class="col-span-5">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mx-auto" >
                    <message-container
                        :messages="messages"
                    />
                    <input-message
                        :room="currentRoom"
                        v-on:messagesent="getMessages()"
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import MessageContainer from "./messageContainer";
import InputMessage from "./inputMessage";
import ChatRoomSelection from "./chatRoomSelection";
export default {
    name: "container",
    components: { ChatRoomSelection, InputMessage, MessageContainer, AppLayout},
    data: function (){
        return {
            chatRooms: [],
            currentRoom: [],
            messages: [],
            isAdmin: 0,
            isModalVisible: false,
        }
    },
    watch: {
        currentRoom(val, oldVal ){
            this.connect();
        }
    },
    methods:{
        connect(){
            if(this.currentRoom.id){
                let vm = this;
                this.getMessages();
                window.Echo.private("chat."+this.currentRoom.id)
                .listen('.message.new', e => {
                    vm.getMessages();
                })
            }
        },
        disconnect(room){
            window.Echo.leave("chat."+room.id);
        },
        getRooms(){
            axios.get('/chat/rooms').then(
                response => {
                    this.chatRooms = response.data;
                    this.setRoom(response.data[0]);
                }).catch(error=>{console.log(error);})
        },
        getPrivilages(){
            axios.get('/chat/room/'+this.currentRoom.id+'/privilages').then(
                response => {
                    console.log(response);
                    this.isAdmin = response.data;
                }).catch(error=>{console.log(error);})
        },
        setRoom(room){
            this.currentRoom = room;
            this.getPrivilages();
        },
        getMessages(){
            axios.get('/chat/rooms/'+this.currentRoom.id+'/messages')
            .then(response =>{
                this.messages = response.data;
            }).catch(error =>{console.log(error);})
        },
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        }
    },
    created(){
        this.getRooms();
    }
}
</script>

<style scoped>

</style>
