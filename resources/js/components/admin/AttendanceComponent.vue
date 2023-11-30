<template>
    <div class="bg-white h-full">
        <div class="flex flex-col p-3 bg-white gap-1 h-[750px]">
            <div class="border h-[50px] flex items-center justify-end px-5">
                <h1>Header</h1>
            </div>
            <div class="bg-white flex-1">
                <table class="w-full whitespace-nowrap z-10 ">
                    <thead class="bg-[#00B0F0] text-justify h-14">
                        <tr>
                            <th class="text-white capitalize pl-5">Fullname</th>
                            <th class="text-white capitalize">time in</th>
                            <th class="text-white capitalize">time out</th>
                            <th class="text-white capitalize">day</th>
                            <th class="text-white capitalize">date</th>
                            <th class="text-white capitalize">action</th>
                        </tr>
                    </thead>
                    <tbody v-if="!loading" class="opacity-80">
                        <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" v-for="(log, index) in logs.data"
                            :key="index">
                            <td class="text-sm font-semibold text-slate-500 capitalize pl-5">{{ log.last_name }} {{
                                log.first_name }} {{ log.middle_name.substr(0, 1) }}.</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.time_in }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.time_out }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.day }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.date }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">
                                <button @click="viewLog(log.id)"
                                    class="bg-[#00B0F0] text-white px-3 py-2 rounded text-xs">view</button>
                            </td>
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
            <div v-if="!loading" class="h-[50px]">
                <TailwindPagination :data="logs" @pagination-change-page="getApiLogs" />
            </div>
            <div v-else class="h-[50px]">
            </div>
        </div>
        <ModalComponent @closeModal="toggleModal" :modalActive="modalActive">
            <div class="modal-content flex flex-col" >
                <div class="flex-1 bg-green-300 flex flex-col" :id="print">
                    <span>Fullname: {{ singleLog.last_name }} {{ singleLog.first_name }} {{ singleLog.middle_name }}</span>
                    <span>Time In: {{ singleLog.time_in }} </span>
                    <span>Time Out: {{ singleLog.time_out }} </span>
                    <span>Day: {{ singleLog.day }} </span>
                    <span>Date: {{ singleLog.date }} </span>
                </div>
                <div class="flex justify-end gap-3 p-5">
                    <button class="print-button" @click="toggleModal">Close</button>
                    <button class="print-button" @click="printAttendance">Print</button>
                </div>
            </div>
        </ModalComponent>
       
    </div>
</template>
<script>
import { onClickOutside } from '@vueuse/core'
import { ref, onMounted, onUnmounted } from 'vue'
import { TailwindPagination } from 'laravel-vue-pagination';
import { usePaperizer } from 'paperizer'
import ModalComponent from '../modal/ModalComponent.vue';

export default {
    components: {
        TailwindPagination,
        ModalComponent
    },
    setup() {
        const target = ref(null)
        const modalActive = ref(false)
        const loading = ref(false)
        const error = ref('')
        const singleLog = ref({})
        const print = ref('print')
        const logs = ref({ 'data': [] })



        const viewLog = async (id) => {
            try {
                const res = await axios.get(`/admin/view-log/${id}`)
                singleLog.value = await res.data.log
                console.log(singleLog.value.first_name)
            } catch (error) {
                console.log(error)
            } finally {
                console.log('Done fetching!')
            }
            modalActive.value = !modalActive.value
        }

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
        const toggleModal = () => {
            modalActive.value = !modalActive.value
        }
        const printAttendance = () => {
            const { paperize } = usePaperizer(print.value)
            paperize()
        }
        onClickOutside(target, () => modalActive.value = false)
        const handleClose = (event) => {
            console.log('closing modal')
            if (event.key == 'Escape') {
                modalActive.value = false
            }
        }

        onMounted(() => {
            document.addEventListener('keyup', handleClose)
            getApiLogs()
        })
        onUnmounted(() => {
            document.removeEventListener('keyup', handleClose)
        })
        return {singleLog, loading, error, print, modalActive, logs, getApiLogs, toggleModal, viewLog, target, printAttendance }
    }
}
</script>

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
<style lang="scss" scoped>
.modal-content {
    background-color: white;
    height: 100%;
}
</style>