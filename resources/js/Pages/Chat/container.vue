<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
                {{currentRoom.name}}
            </h2>
        </template>
        <div class="py-12 grid md:grid-cols-6">
            <div class="sm:col-span-6 md:col-span-1 sm:mb-2">
                <!--class="max-w-3xl mx-auto sm:px-6 lg:px-4" -->
                    <chat-room-selection
                        v-if="currentRoom.id"
                        :rooms="chatRooms"
                        :currentRoom="currentRoom"
                        v-on:roomchanged="setRoom($event)"
                    />

            </div>
            <div class="sm:col-span-6 md:col-span-5 sm:mt-3">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mx-auto sm:mt-6" >
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
                    this.chatRooms.forEach((value, index)=>{
                        try {
                            let temp = JSON.parse(value.name);
                            value.name = temp[this.$page.props.user.id];
                        } catch (e) {
                        }
                    });
                    this.setRoom(response.data[0]);
                }).catch(error=>{console.log(error);})
        },
        getPrivilages(){
            axios.get('/chat/room/'+this.currentRoom.id+'/privilages').then(
                response => {
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
