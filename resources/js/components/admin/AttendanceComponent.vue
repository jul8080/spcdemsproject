<template>
    <div class="h-full">
        <div class="flex flex-col p-3 bg-white gap-3 h-[750px]">
            <div class="csv-container h-[100px] flex items-center justify-between px-5 rounded-md">
                <div class="flex flex-col">
                    <span class="text-gray-700 font-semibold">Manage Employee Logs</span>
                    <span class="text-gray-400 font-normal text-xs">Export employee logs as csv.</span>
                </div>
                <form @submit.prevent="exportCSV">
                    <button v-if="logs.length > 0" :disabled="filterBtn"
                        class="disabled:bg-gray-300 disabled:text-[#f1f1f1] bg-green-400 text-white font-semibold px-3 py-2 text-sm rounded-md capitalize"
                        type="submit">
                        <i class="fa-solid fa-file-csv"></i>
                        export
                    </button>
                    <button v-else disabled
                        class="disabled:bg-gray-300 disabled:text-[#f1f1f1] bg-green-400 text-white font-semibold px-3 py-2 text-sm rounded-md capitalize"
                        type="submit">
                        <i class="fa-solid fa-file-csv"></i>
                        export
                    </button>
                </form>
            </div>

            <!-- filter container starts here... -->
            <div class="filter-container h-[150px] flex items-start justify-center gap-5  flex-col p-10 py-20 rounded-md">
                <span class="text-2xl font-semibold">Filter Logs</span>
                <form @submit.prevent="getApiLogs" class="flex items-end justify-center gap-1">
                    <div class="flex flex-col w-[150px]">
                        <span class="text-xs">Start Date</span>
                        <input :disabled="logs.length > 0 ? false : true" class="disabled:bg-gray-300 disabled:text-[#f1f1f1] bg-red-500 text-white py-2 px-2 rounded-md text-xs outline-none font-semibold"
                            type="date" name="date" id="date" v-model="startDate">
                    </div>
                    <div class="flex flex-col w-[150px]">
                        <span class="text-xs">End Date</span>
                        <input type="date" :disabled="startDate != '' ? false : true"
                            class="bg-green-500 text-white py-2 px-2 rounded-md text-xs outline-none font-semibold disabled:bg-gray-300 disabled:text-[#f1f1f1]"
                            v-model="endDate">
                    </div>
                    <button v-if="endDate != ''"
                        class="bg-blue-400 h-[38px] px-3 rounded-md text-white text-xs font-semibold hover:bg-blue-500"
                        type="submit">Filter</button>

                    <button v-else
                        class="bg-blue-400 h-[38px] px-3 rounded-md text-white text-xs font-semibold hover:bg-blue-500 hidden"
                        type="submit">Filter</button>

                        <span class="text-red-500 desktop:text-sm laptop:text-xs">{{ errorDate }}</span>
                </form>
                <span class="text-xs font-semibold">The data has been shown according to your given Information.</span>
            </div>
            <!-- filter container ends here... -->

            <div class="bg-white h-[350px]">
                <table v-if="logs.length > 0" class="w-full z-10">
                    <thead class="bg-[#00B0F0] text-justify h-14">
                        <tr>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize pl-5">Fullname</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize ">time in</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize text-center">time out</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize text-center">total hours</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize text-center">day</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize text-center">date</th>
                        </tr>
                    </thead>
                    <tbody class="opacity-80">
                        <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" v-for="(log, index) in logs"
                            :key="index">
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize pl-5">{{ log.last_name }}
                                {{ log.first_name }} {{ log.middle_name.substr(0, 1) }}.</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize">{{ log.time_in }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize text-center">{{ log.time_out != null
                                ? log.time_out : '- -' }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize text-center">{{
                                totalHours(log.time_in, log.time_out) }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize text-center">{{ log.day }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize text-center">{{
                                newDate(log.created_at) }}</td>
                        </tr>
                    </tbody>
            
                </table>
                <div v-else class="bg-gray-100 h-[100px] w-full flex items-center justify-center rounded-md">
                    <span class="text-gray-400">No available data</span>
                </div>
            </div>
            <!-- pagination starts here... -->
            <div v-if="logs.length > 0">
                <ButtonComponent @prev-page="getApiLogs" @next-page="getApiLogs" @last-page="getApiLogs" :page="pages"
                    :totalPages="totalPages">
                </ButtonComponent>
            </div>
            <!-- pagination ends here... -->
        </div>


    </div>
</template>
<script>
import { ref, onMounted, watch } from 'vue'
import ButtonComponent from '../helpers/ButtonComponent.vue'
import date from '../composables/date'
import downloader from '../composables/api/downloader'
import { useDateFormat, useNow } from '@vueuse/core'
export default {
    components: {
        ButtonComponent
    },
    props: [],
    setup() {
        const errorDate = ref(null)
        const columns = ref([
            { day: 'Monday' },
            { day: 'Tuesday' },
            { day: 'Thursday' },
            { day: 'Friday' },
            { day: 'Saturday' }])
        const error = ref(null)
        const startDate = ref('')
        const endDate = ref('')
        const loading = ref(false)
        const logs = ref([])
        const pages = ref(1)
        const totalPages = ref(1)
        const filterBtn = ref(false)
        const formatter = ref('MMMM D, YYYY')
        const formatted = useDateFormat(useNow(), formatter)
        const newDate = (data) => {
            const { insertDateHere } = date()
            return insertDateHere(data)
        }

        const getApiLogs = async (page) => {
            try {
                const start = startDate.value || '';
                const end = endDate.value || '';
                let url = `/admin/api-logs?page=${page}`

                if (start != '' && end != '') {
                    url += `&startDate=${start}&endDate=${end}`
                }
                const res = await axios.get(url)
                logs.value = res.data.logs.data
                pages.value = res.data.logs.current_page
                totalPages.value = res.data.logs.last_page
            } catch (err) {
                if(err.response.status) {
                    errorDate.value = err.response.data.message
                    setTimeout(() => errorDate.value = null, 5000)
                    console.log(errorDate.value)
                }
            }
        }
        watch(startDate, (newValue) => {
            if (!newValue) {
                endDate.value = '';
                filterBtn.value = false;
                getApiLogs()
            }
            if (newValue) {
                filterBtn.value = true;
            } else {
                filterBtn.value = false;
            }
        })
        watch(endDate, (newValue) => {
            if (newValue) {
                filterBtn.value = false;
            } else {
                filterBtn.value = true;
            }
        })

        const totalHours = (timeIn, timeOut) => {
            let [time, period] = timeIn.split(' ')
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
                return time + 'hr'
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
        const applyFilter = () => {
            getApiLogs(1);
        }
        onMounted(() => {
            getApiLogs(1)
        })

        const exportCSV = async () => {
            try {
                let start = startDate.value || ''
                let end = endDate.value || ''
                let url = `/admin/user/logs-csve-xport`
                if (start != '' && end != '') {
                    url += `?&startDate=${start}&endDate=${end}`
                }

                const res = await axios.get(url)
                const data = res.data.logs.map(x => {

                    const logs = {
                        last_name: x.last_name,
                        first_name: x.first_name,
                        middle_name: x.middle_name,
                        time_in: x.time_in,
                        time_out: x.time_out,
                        day: x.day,
                        date: new Date(x.created_at).toISOString().split('T')[0]
                    }
                    return logs
                })
                downloader(data)

            } catch (err) {
                console.log(err)
            }
        }
        return {
            startDate,
            endDate,
            loading,
            columns,
            error,
            logs,
            pages,
            totalPages,
            applyFilter,
            newDate,
            exportCSV,
            getApiLogs,
            totalHours,
            filterBtn,
            errorDate
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

.csv-container,
.filter-container {
    box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}

.modal-content {
    background-color: white;
    height: 100%;
}
</style>