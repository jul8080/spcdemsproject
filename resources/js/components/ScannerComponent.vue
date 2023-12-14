<template>
    <div class="bg-slate-200 h-full flex justify-center items-center flex-col">
        <div class="flex gap-2 h-[750px]">
            <div class="flex gap-1 bg-slate-200">
                <div class="bg-white gap-1 w-[900px] flex flex-col relative item-center justify-center py-5 px-5">
                    <img src="../assets/images/logo-2.png" alt="samson logo"
                        class="w-[500px] h-[500px] object-cover opacity-20 absolute top-32 left-0 right-0 bottom-0 m-auto">
                    <div class="border p-3">
                        <div class="flex justify-between items-center">
                            <h1 class="font-bold text-gray-500">Employee logs</h1>
                            <div class="flex gap-1 z-10">
                                <button v-on:click="category = 'all'"
                                    class="py-2 px-5 text-white text-sm rounded font-semibold"
                                    :class="category == 'all' ? 'bg-sky-300' : 'border text-slate-500'">All</button>
                                <button v-on:click="category = 'time in'"
                                    class="py-2 px-5 text-white text-sm rounded font-semibold"
                                    :class="category == 'time in' ? 'bg-sky-300' : 'border text-slate-500'">Time In ({{
                                        timeInLength }})</button>
                                <button v-on:click="category = 'time out'"
                                    class="py-2 px-5 text-white text-sm rounded font-semibold"
                                    :class="category == 'time out' ? 'bg-sky-300' : 'border text-slate-500'">Time Out ({{
                                        timeOutLength }})</button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <table class="w-full whitespace-nowrap z-10 ">
                            <thead class="bg-[#00B0F0] text-justify h-14">
                                <tr>
                                    <th class="text-white capitalize pl-5">No.</th>
                                    <th class="text-white capitalize">Fullname</th>
                                    <th class="text-white capitalize">time in</th>
                                    <th class="text-white capitalize">time out</th>
                                    <th class="text-white capitalize">day</th>
                                    <th class="text-white capitalize">date</th>

                                </tr>
                            </thead>
                            <tbody v-if="logs.data.length > 0" class="opacity-80">
                                <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify"
                                    v-for="(log, index) in filterLogs" :key="index">
                                    <td class="text-sm font-semibold text-slate-500 capitalize pl-5">{{ index + 1 }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.last_name }} {{
                                        log.first_name }} {{ log.middle_name.substr(0, 1) }}.</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.time_in }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.time_out }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ log.day }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ newDate(log.created_at) }}</td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                                    <td colspan="8" class="text-sm font-semibold text-slate-500 capitalize pl-5">
                                        {{ message }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="z-10">
                        <TailwindPagination :data="logs" @pagination-change-page="getLogs" />
                    </div>

                </div>
                <div class="bg-white h-full w-[500px] flex items-center justify-center flex-col gap-5 py-10 relative">
                    <!-- <img src="../assets/images/samson-school.jpg" alt="samson school"
                        class="opacity-20 absolute h-full w-full top-0 right-0 bottom-0 left-0 m-auto object-cover"> -->
                    <div class="bg-[#00B0F0]/10 w-full h-full absolute top-0 right-0 bottom-0 left-0 m-auto"></div>
                    <div class="bg-white w-80 h-80 flex items-center flex-col z-10">
                        <div class="bg-green-500 w-full h-full p-3 relative">
                            <div class="bg-white w-[200px] h-full absolute bottom-0 left-0 right-0 top-0 m-auto"/>
                            <div class="bg-white w-[200px] h-full absolute rotate-90 bottom-0 left-0 right-0 top-0 m-auto"/>
                            <div class="bg-white  w-full h-full">
                                <qrcode-stream @init="onInit" @decode="onDecode" :track="drawOutline"></qrcode-stream>
                            </div>
                        </div>
                      
                    </div>
                    <span class="font-mono font-extrabold text-slate-300">
                        <i class="fa-solid fa-qrcode"></i> Tap your QRCode here.
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { QrcodeStream } from 'vue3-qrcode-reader'
import { TailwindPagination } from 'laravel-vue-pagination';
import { useNow, useDateFormat } from '@vueuse/core'
import date from '../components/composables/date'
export default {
    props: ['time'],
    components: {
        QrcodeStream,
        TailwindPagination
    },
    data() {
        return {
            loading: false,
            message: '',
            decodeString: '',
            logs: { 'data': [] },
            category: 'all',
            formattedDay: useDateFormat(useNow(), "dddd", { locales: 'en-US' }),
            formattedDate: useDateFormat(useNow(), "YYYY-MM-DD", { locales: 'en-US' }),
        }
    },
    mounted() {
        this.getLogs()
    },
    methods: {
        newDate(data) {
            const { insertDateHere } = date()
            return insertDateHere(data)
        },
        async getLogs(page = 1) {
            this.loading = true
            try {
                const res = await axios.get(`/scanner/logs?page=${page}`)
                if(!res.data.status) {
                    throw Error('Something went wrong!')
                } else {
                    this.logs = await res.data.users
                }
            } catch (err) {
                console.log(err.message)
            } finally {
                this.loading = false
                console.log('Done fetching!')
            }
        },
        async onDecode(decodeString) {
            this.decodeString = decodeString
            if (this.decodeString !== '') {

                axios.post('/scanner/store',
                    {
                        'qrcode': this.decodeString,
                        'time': this.time,
                        'day': this.formattedDay,
                        'date': this.formattedDate
                    })
                    .then(res => {
                        this.message = res.data.message
                        console.log(res)
                    }).catch(err => {
                        console.log(err.message)
                    })
            } else {
                return
            }
            this.getLogs()
        },
        async onInit(promise) {
            // show loading indicator
            try {
                const { capabilities } = await promise
                console.log(capabilities)
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                    this.error = "user denied camera access permisson"
                } else if (error.name === 'NotFoundError') {
                    this.error = "no suitable camera device installed"
                } else if (error.name === 'NotSupportedError') {
                    this.error = "page is not served over HTTPS (or localhost)"
                } else if (error.name === 'NotReadableError') {
                    this.error = "maybe camera is already in use"
                } else if (error.name === 'OverconstrainedError') {
                    this.error = "did you requested the front camera although there is none?"
                } else if (error.name === 'StreamApiNotSupportedError') {
                    this.error = "browser seems to be lacking features"
                }
            } finally {
                console.log('success...')
            }
        },
        drawOutline(decodeData, context) {
            var points = []
            for (var k in decodeData) {
                switch (k) {
                    case 'topLeftCorner':
                        points[0] = decodeData[k]
                        break;
                    case 'topRightCorner':
                        points[1] = decodeData[k]
                        break;
                    case 'bottomRightCorner':
                        points[2] = decodeData[k]
                        break;
                    case 'bottomLeftCorner':
                        points[3] = decodeData[k]
                        break;
                    default:
                        break
                }

            }
            context.lineWidth = 10
            context.strokeStyle = 'green'
            context.beginPath()
            context.moveTo(points[0].x, points[0].y)
            for (const { x, y } of points) {
                context.lineTo(x, y)
            }
            context.lineTo(points[0].x, points[0].y)
            context.closePath()
            context.stroke()
        }
    },
    computed: {
        filterLogs() {
            if (this.category === 'all') {
                return this.logs.data
            } else if (this.category === 'time in') {
                return this.logs.data.filter(x => x.status == '0')
            } else if (this.category === 'time out') {
                return this.logs.data.filter(x => x.status == '1')
            }

        },
        timeInLength() {
            const logs = this.logs.data.filter(x => x.status == '0')
            return logs.length
        },
        timeOutLength() {
            const logs = this.logs.data.filter(x => x.status == '1')
            return logs.length
        }
    }
}
</script>