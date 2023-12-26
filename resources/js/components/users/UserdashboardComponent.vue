<template>
    <div class="w-full h-[800px] flex items-start gap-5">

        <div class="h-full w-full flex flex-col gap-2">

            <div class="bg-[#00B0F0] desktop:h-[300px] laptop:h-[200px] flex rounded-md overflow-hidden">
                <div class="flex flex-col items-start justify-between p-10 w-full">
                    <div class="bg-blue-300 rounded-lg px-5 py-2">
                        <span class="text-white text-sm font-semibold">
                            {{ date }}
                        </span>
                    </div>
                    <div class="flex flex-col justify-evenly items-start">
                        <span class="text-2xl text-white font-semibold flex items-center justify-center gap-1">Good Day,
                            {{ user.first_name }} {{ user.last_name }}
                            <img src="../../assets/images/party-popper.png" alt="party popper" class="h-7 w-7 object-cover">
                        </span>
                        <span class="text-sm text-white">Have a nice {{ day }}.</span>
                    </div>
                </div>
            </div>
            <!-- overview container starts here... -->
            <div class="over-view-container bg-white desktop:h-[200px] w-full rounded-md grid grid-cols-3 gap-x-3 p-2">
                <div class="bg-blue-300 rounded-md flex flex-col justify-between desktop:p-5 laptop:p-2">
                    <i class="fa-regular fa-clock text-white self-end desktop:text-3xl laptop:text-lg"></i>
                    <div>
                        <span class="block text-white text-sm">Total Logs</span>
                        <span class="block text-white desktop:text-5xl laptop:text-3xl">{{ countLogs }}</span>
                    </div>
                </div>
                <div class="bg-green-300 rounded-md flex flex-col justify-between desktop:p-5 laptop:p-2">
                    <i class="fa-solid fa-user-check text-white self-end desktop:text-3xl laptop:text-lg"></i>
                    <div>
                        <span class="block text-white desktop:text-3xl laptop:text-2xl">Status</span>
                        <span class="block text-white text-sm capitalize">Position: {{ user.position }}</span>
                    </div>
                </div>
                <div class="bg-orange-300 rounded-md flex flex-col justify-between desktop:p-5 laptop:p-2">
                    <i class="fa-regular fa-calendar text-white self-end desktop:text-3xl laptop:text-lg"></i>
                    <div>
                        <span class="block text-white desktop:text-3xl laptop:text-2xl">Schedule</span>
                        <div>
                            <span class="block text-white desktop:text-sm laptop:text-xs">Day: Monday-Staturday</span>
                            <span class="block text-white desktop:text-sm laptop:text-xs">Off: Sunday</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table container starts here... -->
            <div class="table-container bg-white flex-1 w-full rounded-md desktop:p-5 laptop:p-3 pb-0 flex flex-col items-start justify-evenly">
                <!-- title -->
                <span class="capitalize text-sm mb-5">Recent logs</span>
                <!-- tabale -->
                <div v-if="logs.length > 0" class="h-[300px] w-full bg-gray-200 grid grid-rows-3 justify-items-center items-center p-2 rounded-md flex-1">
                    <div v-for="(log, index) in logs" :key="index"
                        class="odd:bg-white bg-gray-100 rounded-md w-full desktop:h-[92px] laptop:h-full flex overflow-hidden desktop:p-5">
                        <div class="flex-1 flex items-center justify-between border-r-[1px] p-5">
                            <div class="flex items-center justify-center flex-col flex-wrap">
                                <span class="block text-gray-400 text-xs">Day</span>
                                <span class="capitalize desktop:text-base laptop:text-xs">{{ log.day }}</span>
                            </div>
                            <div class="flex items-center justify-center flex-col flex-wrap">
                                <span class="block text-gray-400 text-xs">Time In</span>
                                <span class="capitalize desktop:text-base laptop:text-xs">{{ log.time_in !== null ? log.time_in : '--' }}</span>
                            </div>
                            <div class="flex items-center justify-center flex-col flex-wrap">
                                <span class="block text-gray-400 text-xs">Date</span>
                                <span class="capitalize desktop:text-base laptop:text-xs">{{ dateConverter(log.created_at) }}</span>
                            </div>
                        </div>

                        <div class="flex-1 flex items-center justify-between p-5">
                            <div class="flex items-center justify-center flex-col flex-wrap">
                                <span class="block text-gray-400 text-xs">Day</span>
                                <span class="capitalize desktop:text-base laptop:text-xs">{{ log.day }}</span>
                            </div>
                            <div class="flex items-center justify-center flex-col flex-wrap">
                                <span class="block text-gray-400 text-xs">Time Out</span>
                                <span class="capitalize desktop:text-base laptop:text-xs">{{ log.time_out !== null ? log.time_out : '--' }}</span>
                            </div>
                            <div class="flex items-center justify-center flex-col flex-wrap">
                                <span class="block text-gray-400 text-xs">Date</span>
                                <span class="capitalize desktop:text-base laptop:text-xs">{{ dateConverter(log.created_at) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="h-[300px] w-full bg-gray-200 flex items-center justify-center flex-col p-2 rounded-md">
                    <i class="fa-solid fa-clock text-gray-400 text-2xl"></i>
                    <span class=" text-gray-400 ">No logs yet.</span>
                </div>

                <!-- pagination -->
                <div class="h-[35px] flex items-center justify-center w-full">
                    <button v-if="logs.length > 0" @click="goToPage"
                        class="text-blue-300 font-semibold text-sm capitalize hover:underline">view
                        logs</button>
                    <button v-else @click="goToPage"
                        class="text-blue-300 font-semibold text-sm capitalize hover:underline hidden">view
                        logs</button>
                </div>
            </div>

        </div>


    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useNow, useDateFormat } from '@vueuse/core'

const day = ref(useDateFormat(useNow(), 'dddd'))
const date = ref(useDateFormat(useNow(), 'MMMM D, YYYY'))
const user = ref({})
const logs = ref([])
const countLogs = ref(0)
const goToPage = () => {
    window.location.href = '/user/attendance'
}

const getData = async () => {
    try {
        const res = await axios.get('/user/user-data/dashboard')
        user.value = res.data.user
        logs.value = res.data.recentLogs.data
        countLogs.value = res.data.totalLogs
    } catch (e) {
        console.log(e)
    }
}
const dateConverter = (date) => {

    // Create a Date object using the input date
    const dateObj = new Date(date);

    // Define an array of month names
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    // Get the components of the date
    const year = dateObj.getFullYear();
    const month = dateObj.getMonth(); // Month is zero-based, so we need to adjust
    const day = dateObj.getDate();

    // Format the date in long format
    const longDateFormat = `${monthNames[month]} ${day}, ${year}`;
    return longDateFormat
}
onMounted(() => {
    getData()
})
</script>

<style lang="scss" scoped>
.table-container,
.over-view-container {
    box-shadow: 0 0 3px rgba(0, 0, 0, .3);
}</style>