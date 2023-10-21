<template>
    <div class="relative">
        <div style="border-top: 1px solid rgb(55,55,55);" class="flex flex-row flex-nowrap lg:p-3 w-full items-center justify-between">
            <InputText type="text"
                  v-model="message"
                  @keyup.enter="sendMessage()"
                  placeholder="Message..."
                  class="rounded outline-none p-1 mt-1 text-sm font-medium w-[95%]" />

            <Button v-if="!isSending"
                @click="sendMessage()"
                severity="info"
                    class="justify-self-end"
                    :pt="{icon: {
                        class: 'text-2xl'
                    }}"
                    style="color: rgb(10, 124, 255)"
                icon="pi pi-send"
                    size="large"
            />
            <ProgressSpinner v-else style="width: 35.48px; height: 24px"/>
        </div>
    </div>
</template>

<script>
import InputText from "primevue/inputtext";
import Button from "primevue/button";
import Listbox from "primevue/listbox";
import Dropdown from "primevue/dropdown";
import ProgressSpinner from 'primevue/progressspinner';


export default {
    name: "inputMessage",
    props: ['room'],components: {
        Button,
        InputText,
        ProgressSpinner
    },
    data: function (){
        return{
            message: '',
            isSending: false
        }
    },
    methods:{
        async sendMessage(){
            if(this.isSending || this.message === ''){
                return;
            }
            this.isSending = true;
            try {
                await axios.post('/chat/rooms/' + this.room.id + '/message', {
                    message: this.message
                })
                    .then(response => {
                        if (response.status == 201) {
                            this.message = '';
                            this.$emit('messagesent');
                        }
                    }).catch(error => {
                        console.log(error);
                    })
            }catch (error){
                console.log(error)
            }finally {
                this.isSending = false;
            }
        }
    }
}
</script>

<style scoped>

</style>
