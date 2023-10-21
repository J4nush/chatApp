<template>
    <div>
        <div v-if=" $page.props.user.id == message.user.id" class="w-full mb-1.5 flex flex-row flex-nowrap justify-end">
            <div class="max-w-[80%] md:max-w-[50%] w-fit flex flex-col ">
                <div class="pr-2 text-slate-500	" style="font-size: .9rem; text-align: right; line-height: .9rem ">
                    {{message.user.name }}
                </div>
                <div v-tooltip="{
                    value:formatDate(message.created_at),
                    pt: {
                        text: {class:'text-sm rounded-2xl bg-slate-600'}
                    }
                }" class="rounded-2xl p-1 pl-3 pr-3 text-white" style="background: rgb(10, 124, 255);text-align: right;">
                    {{message.message}}
                </div>
            </div>

        </div>
        <div v-else class="w-full mb-1.5 flex flex-row flex-nowrap justify-start">
            <div class="max-w-[80%] md:max-w-[50%] w-fit flex flex-col gap:0">
                <div class="pl-2 text-slate-500	" style="font-size: .9rem; line-height: .9rem ">
                {{message.user.name }}
                </div>
                <div v-tooltip="{
                    value:formatDate(message.created_at),
                    pt: {
                        text: {class:'text-sm rounded-2xl bg-slate-600'}
                    }
                }" class="rounded-2xl p-1 pl-3 pr-3" style="background: #E4E6EB">
                    {{message.message}}
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "messageItem",
    props: ['message'],
    methods: {
        formatDate(dateStr) {
            const inputDate = new Date(dateStr);
            const currentDate = new Date();

            const isSameDay = inputDate.getDate() === currentDate.getDate() &&
                inputDate.getMonth() === currentDate.getMonth() &&
                inputDate.getFullYear() === currentDate.getFullYear();

            const isSameYear = inputDate.getFullYear() === currentDate.getFullYear();

            const monthShortNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const month = monthShortNames[inputDate.getMonth()];

            if (isSameDay) {
                return `${this.pad(inputDate.getHours())}:${this.pad(inputDate.getMinutes())}`;
            } else if (isSameYear) {
                return `${inputDate.getDate()} ${month} ${this.pad(inputDate.getHours())}:${this.pad(inputDate.getMinutes())}`;
            } else {
                return `${inputDate.getDate()} ${month} ${inputDate.getFullYear()} ${this.pad(inputDate.getHours())}:${this.pad(inputDate.getMinutes())}`;
            }
        },
        pad(num) {
            return num < 10 ? '0' + num : num;
        },
    },



}

</script>

<style scoped>

</style>
