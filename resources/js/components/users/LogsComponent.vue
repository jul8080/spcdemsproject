<template>
    <div class="h-full flex flex-col gap-2">

        <div class="filter-container bg-white h-48 rounded-md flex items-start flex-col gap-5 justify-center p-10">
            <span class="text-2xl font-semibold">Filter Logs</span>
            <form @submit.prevent="getLogs" class="flex gap-5">
                <div class="flex flex-col w-full">
                    <span class="text-sm">Begin Date</span>
                    <input v-model="filterDate.beginDate" type="date" class="bg-red-500 text-white py-2 px-2 rounded-md text-xs outline-none">
                </div>
                <div class="flex flex-col w-[150px]">
                    <span class="text-sm">End Date</span>
                    <input v-model="filterDate.endDate" type="date" class="bg-green-500 text-white py-2 px-2 rounded-md text-xs outline-none">
                </div>
                <button type="submit">filter</button>
            </form>
            <span class="text-xs font-semibold">The data has been shown according to your given Information.</span>
        </div>

        <div class="bg-orange-500">
            <div class="flex-1">
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-[#00B0F0] text-justify h-14">
                        <tr>
                            <th class="text-white capitalize pl-10">date</th>
                            <th class="text-white capitalize">day</th>
                            <th class="text-white capitalize text-center">time in</th>
                            <th class="text-white capitalize text-center">time out</th>
                            <th class="text-white capitalize text-center">total hours</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" v-for="(log, index) in logs"
                            :key="index">
                            <td class="text-sm font-semibold text-slate-500 capitalize pl-10">{{
                                insertDateHere(log.created_at) }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.day }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize text-center">{{ log.time_in }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize text-center">{{ log.time_out != null
                                ? log.time_out : '- -' }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize text-center">{{
                                totalHours(log.time_in, log.time_out) }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="logs.length > 0" class=" h-20">
            <!-- pagination starts here... -->
            <ButtonComponent @prev-page="getLogs" @next-page="getLogs" @last-page="getLogs" :page="pages"
                :totalPages="totalPages">
            </ButtonComponent>
            <!-- pagination ends here... -->
        </div>
        <div v-else class=" h-20">
      
        </div>
    </div>
</template>

<script>
import { ref, onMounted, computed } from 'vue'
import ButtonComponent from '../helpers/ButtonComponent.vue'
import newDate from '../composables/date'
import convertToMilitaryTime from '../composables/time/military'
export default {
    props: [],
    components: {
        ButtonComponent
    },
    setup() {
        const { insertDateHere } = newDate()
        const filterDate = ref({beginDate: '', endDate: ''})
        const logs = ref([])
        const pages = ref(1)
        const totalPages = ref(1)

        const getLogs = async (page) => {
            try {
                const res = await axios.get(`/user/logs-api?page=${page}&beginDate=${filterDate.value.beginDate}&endDate=${filterDate.value.endDate}`);
                logs.value = res.data.logs.data
                pages.value = res.data.logs.current_page
                totalPages.value = res.data.logs.last_page
                console.log(res.data.logs.data)
            } catch (err) {
                console.log(err.message)
            } finally {
                console.log('Done fetching...')
            }
        }
        const applyFilter = () => {
            getLogs(1);
        }
        const totalHours = (timeIn, timeOut) => {
            if (timeOut != null) {
                if (isValidTime(timeIn) && isValidTime(timeOut)) {
                    const totalMinutes = calculateTotalMinutes(timeIn, timeOut);
                    const hours = Math.floor(totalMinutes / 60);
                    const minutes = totalMinutes % 60;
                    let hrs = 0;
                    let min = 0
                    if (hours < 12) hrs = '0' + Math.abs(hours)
                    if (hours > 12) hrs = Math.abs(hours)
                    if (minutes < 10) min = '0' + Math.abs(minutes)
                    if (minutes > 10) min = Math.abs(minutes)

                 
                    return hours + '.' + min + 'hr'
                    // return hrs + ':' + min
                } else {
                    console.log('Invalid time format. Please enter valid times.');
                }
            } else {
                return '- -'
            }
        }
        //calculate the time and convert hours to minutes.
        const calculateTotalMinutes = (timeIn, timeOut) => {
            const [hoursIn, minutesIn, periodIn] = parseTime(timeIn);
            const [hoursOut, minutesOut, periodOut] = parseTime(timeOut);

            let totalMinutes = 0;

            if (timeOut < timeIn) {
                const validate = (hoursOut - hoursIn)

                if (Math.sign(validate) < 0) {
                    totalMinutes = (validate + 24) * 60 + (minutesOut - minutesIn)
                } else {
                    totalMinutes = (validate) * 60 + (minutesOut - minutesIn)
                }
            } else {
                let result = (hoursOut - hoursIn)
                if (Math.sign(result) < 0) {
                    totalMinutes = (result + 24) * 60 + (minutesOut - minutesIn)
                } else {
                    totalMinutes = result * 60 + (minutesOut - minutesIn)
                }
            }
            return totalMinutes;
        }
        //parsing the time to separate the hours, minutes, and period.
        const parseTime = (time) => {
            const [timePart, period] = time.split(' ');
            const [hours, minutes] = timePart.split(':').map(Number);
            const adjustedHours = period.toLowerCase() === 'pm' && hours !== 12 ? hours + 12 : hours;

            return [adjustedHours, minutes, period.toLowerCase()];
        }
        // first checking the time if it is valid.
        const isValidTime = (time) => {
            // Simple validation for HH:mm AM/PM format
            const timeRegex = /^(0[1-9]|1[0-2]):[0-5][0-9] (AM|PM)$/i;
            return timeRegex.test(time);
        }
        onMounted(() => {
            getLogs()
        })
        return {
            filterDate,
            logs,
            pages,
            totalPages,
            getLogs,
            insertDateHere,
            totalHours,
            applyFilter,
        }
    }
}
</script>
<style scoped>
::-webkit-calendar-picker-indicator {
    background-color: white;
    padding: 5px;
    cursor: pointer;
    border-radius: 3px;
}
.filter-container {
    box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}
</style>