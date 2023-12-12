<template>
    <div class="bg-white h-full">
        <div class="flex flex-col p-3 bg-white gap-3 h-[750px]">
            <div class="csv-container h-[100px] flex items-center justify-between px-5">
                <div class="flex flex-col">
                    <span class="text-gray-700 font-semibold">Manage Employee Logs</span>
                    <span class="text-gray-400 font-normal text-xs">Export employee logs as csv.</span>
                </div>
                <form @submit.prevent="exportCSV">
                    <button class="bg-green-400 text-white font-semibold px-5 py-2 rounded-md capitalize" type="submit">
                        <i class="fa-solid fa-file-csv"></i>
                        export
                    </button>
                </form>
            </div>

            <!-- filter container starts here... -->
            <div class="filter-container h-[70px] flex items-center justify-between px-5">
                <div class="flex gap-2">
                    <!-- <select @change="applyFilter" v-model="filter.day" name="filter" id="filter"
                        class="bg-green-200 text-gray-500 px-5 py-1">
                        <option class="bg-white" v-for="(data, index) in columns" :key="index" :value="data.day">{{ data.day
                        }}
                        </option>
                    </select> -->
                    <input class="bg-[#00B0F0] text-white px-3 py-2 rounded-md font-semibold outline-none"
                        @input="applyFilter" type="date" name="date" id="date" v-model="filter.date">
                </div>
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
import { ref, onMounted, onUnmounted, computed } from 'vue'
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
        // const loading = ref(false)
        // const logs = ref([])
        // const pages = ref(1)
        // const totalPages = ref(1)
        const filter = ref({day: '', date: ''})

        const { getApiLogs, loading, pages, totalPages, logs } = composableApi(filter.value)

        const newDate = (data) => {
            const { insertDateHere } = date()
            return insertDateHere(data)
        }
        // const getApiLogs = async (page) => {
        //     loading.value = true
        //     try {
        //         const res = await axios.get(`/admin/api-logs?page=${page}&filter=${filter.value.day}&date=${filter.value.date}`)
        //         logs.value = res.data.attendance.data
        //         pages.value = res.data.attendance.current_page
        //         totalPages.value = res.data.attendance.last_page
        //     } catch (error) {
        //         console.log(error)
        //     } finally {
        //         loading.value = false
        //         console.log('Done fetching!')
        //     }
        // }
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
<!-- <script>
import ButtonComponent from '../helpers/ButtonComponent.vue'
import date from '../composables/date'
import apiCall from '../composables/api/apiCall'
export default {
    components: {
        ButtonComponent,
        date
    },
    data() {
        return {
            columns: [
                { day: 'Monday' },
                { day: 'Tuesday' },
                { day: 'Thursday' },
                { day: 'Friday' },
                { day: 'Saturday' }],
            loading: false,
            error: null,
            filterLogs: [],
            logs: [],
            page: 1,
            totalPages: 1,
            filter: { day: '', date: '' },
        }
    },
    watch: {},
    created() {
        this.getApiLogs(this.page)
    },
    methods: {

        newDate(data) {
            const { insertDateHere } = date()
            return insertDateHere(data)
        },
        convertToCSV(data) {
            const headers = Object.keys(data[0])
            const rows = data.map(obj => headers.map(header => obj[header]))
            const headerRow = headers.join(',')
            const csvRows = [headerRow, ...rows.map(row => row.join(','))]
            return csvRows.join('\n')
        },
        exportCSV() {

            if (this.filter.day != '') {
                const filtering = this.logs.filter(x => x.day == this.filter.day)
                const csvContent = this.convertToCSV(filtering)
                const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url
                link.setAttribute('download', `${this.hashedString}-${this.is_completed}.csv`);
                link.click();
            }
            if (this.filter.date != '') {
                apiCall(this.filter.date)
            }
            if (this.filter.day == '' && this.filter.date == '') {
                apiCall(this.filter.date)
            }
            console.log(this.filter.date)
        },
        async getApiLogs(page) {
            this.loading = true
            try {
                const res = await axios.get(`/admin/api-logs?page=${page}&filter=${this.filter.day}&date=${this.filter.date}`)
                this.logs = res.data.attendance.data
                this.page = res.data.attendance.current_page
                this.totalPages = res.data.attendance.last_page
            } catch (error) {
                console.log(error)
            } finally {
                this.loading = false
                console.log('Done fetching!')
            }
        },
        applyFilter() {
            this.getApiLogs(1);
        },
    },
    computed: {
        computedLogs() {
            return this.logs
        }
    }
}
</script> -->
<!-- <script>
import { ref, onMounted, onUnmounted, computed } from 'vue'
import { TailwindPagination } from 'laravel-vue-pagination';

export default {
    components: {
        TailwindPagination,
    },
    setup() {
        const days = ref([
            {day: 'Monday'},
            {day: 'Tuesday'},
            {day: 'Thursday'},
            {day: 'Friday'},
            {day: 'Saturday'},
        ])
        const loading = ref(false)
        const error = ref('')
        const logs = ref({ 'data': [] })
        const status = ref({
            day: null,
            date: null
        })

        const filterLogs = computed(() => {
            if(status.day != null) {
                return logs.value.filter(x => x.day == status.day.value)
            } else {

                return logs.value.filter(x => x.day == 'Tuesday')
            }
        })


        const getApiLogs = async (page = 1) => {
            loading.value = true
            try {
                const res = await axios.get(`/admin/api-logs?page=${page}`)
                logs.value = await res.data.attendace
                console.log(logs.value)
            } catch (error) {
                console.log(error)
            } finally {
                loading.value = false
                console.log('Done fetching!')
            }
        }
        onMounted(() => {
            getApiLogs()
        })
     
        return { loading, error, print, logs, getApiLogs, filterLogs, status, days }
    }
}
</script> -->

<!-- <script type="module">
import { usePaperizer } from 'paperizer'
import { TailwindPagination } from 'laravel-vue-pagination';
import ModalComponent from '../modal/ModalComponent.vue';
export default {
    components: {
        TailwindPagination,
        ModalComponent
    },
    data() {
        return {
            modalActive: false,
            loading: false,
            error: '',
            singleLog: '',
            print: 'print',
            logs: { 'data': [] },
            target: null
        }
    },
    mounted() {
        this.getApiLogs()
        this.keyUp()
    },
    methods: {
        handleClose(event){
            console.log('closing modal')
            if(event.key == 'Escape') {
                    this.modalActive = false
            }
        },
        keyUp() {
            document.addEventListener('keyup', this.handleClose)
        },
        async viewLog(id) {
            try {
                const res = await axios.get(`/admin/view-log/${id}`)
                this.singleLog = res.data.log
                console.log(this.singleLog)
            } catch (error) {
                console.log(error)
            } finally {
                console.log('Done fetching!')
            }
            this.modalActive = !this.modalActive
        },
        async getApiLogs(page = 1) {
            this.loading = true
            try {
                const res = await axios.get(`/admin/api-logs?page=${page}`)
                this.logs = res.data.attendace
                console.log(this.logs)
            } catch (error) {
                console.log(error)
            } finally {
                this.loading = false
                console.log('Done fetching!')
            }
        },
        toggleModal() {
            this.modalActive = !this.modalActive
        },
        printAttendance() {
            const { paperize } = usePaperizer(this.print)
            paperize()
        },
    }
}
</script> -->
<style scoped>
.csv-container,
.filter-container {
    box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}

.modal-content {
    background-color: white;
    height: 100%;
}
</style>