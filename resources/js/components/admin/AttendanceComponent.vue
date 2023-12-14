<template>
    <div class="bg-white h-full">
        <div class="flex flex-col p-3 bg-white gap-3 h-[750px]">
            <div class="csv-container h-[100px] flex items-center justify-between px-5 rounded-md">
                <div class="flex flex-col">
                    <span class="text-gray-700 font-semibold">Manage Employee Logs</span>
                    <span class="text-gray-400 font-normal text-xs">Export employee logs as csv.</span>
                </div>
                <form @submit.prevent="exportCSV">
                    <button class="bg-green-400 text-white font-semibold px-3 py-2 text-sm rounded-md capitalize" type="submit">
                        <i class="fa-solid fa-file-csv"></i>
                        export
                    </button>
                </form>
            </div>

            <!-- filter container starts here... -->
            <div class="filter-container h-[150px] flex items-start justify-center gap-5  flex-col p-10 py-20 rounded-md">
                <span class="text-2xl font-semibold">Filter Logs</span>
                <div class="flex items-start w-full gap-5">
                    <div class="flex flex-col w-[150px]">
                        <span class="text-sm">Begin Date</span>
                        <input class="bg-red-500 text-white py-2 px-2 rounded-md text-xs outline-none"
                            @input="applyFilter" type="date" name="date" id="date" v-model="filter.date">
                    </div>
                    <div class="flex flex-col w-[150px]">
                        <span class="text-sm">End Date</span>
                        <input type="date" value="" class="bg-green-500 text-white py-2 px-2 rounded-md text-xs outline-none">
                    </div>
                </div>
                <span class="text-xs font-semibold">The data has been shown according to your given Information.</span>
            </div>
            <!-- filter container ends here... -->

            <div class="bg-white h-[350px]">
                <table class="w-full whitespace-nowrap z-10 ">
                    <thead class="bg-[#00B0F0] text-justify h-14">
                        <tr>
                            <th class="text-white capitalize pl-5 ">Fullname</th>
                            <th class="text-white capitalize ">time in</th>
                            <th class="text-white capitalize text-center">time out</th>
                            <th class="text-white capitalize text-center">day</th>
                            <th class="text-white capitalize text-center">date</th>
                        </tr>
                    </thead>
                    <tbody v-if="!loading" class="opacity-80">
                        <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" v-for="(log, index) in logs"
                            :key="index">
                            <td class="text-sm font-semibold text-slate-500 capitalize pl-5">{{ log.last_name }}
                                {{ log.first_name }} {{ log.middle_name.substr(0, 1) }}.</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.time_in }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize text-center">{{ log.time_out != null
                                ? log.time_out : '- -' }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize text-center">{{ log.day }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize text-center">{{
                                newDate(log.created_at) }}</td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                            <td colspan="6" class="text-sm font-semibold text-slate-500 pl-5">Loading data please wait...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- pagination starts here... -->
            <ButtonComponent @prev-page="getApiLogs" @next-page="getApiLogs" @last-page="getApiLogs" :page="pages"
                :totalPages="totalPages">
            </ButtonComponent>
            <!-- pagination ends here... -->

        </div>


    </div>
</template>
<script>
import { ref, onMounted } from 'vue'
import ButtonComponent from '../helpers/ButtonComponent.vue'
import date from '../composables/date'
import apiCall from '../composables/api/apiCall'
import composableApi from '../composables/api/composableApi'
export default {
    components: {
        ButtonComponent
    },
    props: [],
    setup() {
        const columns = ref([
                { day: 'Monday' },
                { day: 'Tuesday' },
                { day: 'Thursday' },
                { day: 'Friday' },
                { day: 'Saturday' }])
                const error = ref(null)
        const filter = ref({day: '', date: ''})

        const { getApiLogs, loading, pages, totalPages, logs } = composableApi(filter.value)

        const newDate = (data) => {
            const { insertDateHere } = date()
            return insertDateHere(data)
        }
        const applyFilter = () => {
            getApiLogs(1);
        }
        onMounted(() => {
            getApiLogs(1)
        })

        const exportCSV = () => {
            if (filter.value.date != '') {
                apiCall(filter.value.date)
            }
            if (filter.value.day == '' && filter.value.date == '') {
                apiCall(filter.value.date)
            }
        }
        return { 
            loading,
            columns,
            error,
            logs,
            pages,
            totalPages,
            filter,
            applyFilter,
            newDate,
            exportCSV,
            getApiLogs 
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