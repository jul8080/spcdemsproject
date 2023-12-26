<template>
    <div class="bg-slate-200 h-full flex justify-center items-center flex-col">
        <div class="flex gap-2 h-[750px]">
            <div class="flex gap-1 overflow-hidden">
                <div
                    class="bg-white gap-1 desktop:w-[900px] laptop:w-[700px] flex flex-col relative item-center justify-center desktop:p-5 laptop:p-3 rounded-md">
                    <img src="../assets/images/logo-2.png" alt="samson logo"
                        class="w-[700px] h-[700px] object-contain opacity-20 absolute top-32 left-0 right-0 bottom-0 m-auto">
                    <div class="border p-3">
                        <div class="flex justify-between items-center">
                            <h1 class="font-semibold text-gray-500">Employee logs</h1>
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
                        <table v-if="logs.data.length > 0" class="w-full whitespace-nowrap z-10 ">
                            <thead class="bg-[#00B0F0] text-justify h-14">
                                <tr>
                                    <th class="laptop:text-xs desktop:text-base text-white capitalize pl-5">No.</th>
                                    <th class="laptop:text-xs desktop:text-base text-white capitalize">Fullname</th>
                                    <th class="laptop:text-xs desktop:text-base text-white capitalize">time in</th>
                                    <th class="laptop:text-xs desktop:text-base text-white capitalize">time out</th>
                                    <th class="laptop:text-xs desktop:text-base text-white capitalize">day</th>
                                    <th class="laptop:text-xs desktop:text-base text-white capitalize">date</th>

                                </tr>
                            </thead>
                            <tbody class="opacity-80">
                                <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify"
                                    v-for="(log, index) in filterLogs" :key="index">
                                    <td class="laptop:text-xs desktop:text-base font-semibold text-slate-500 capitalize pl-5">{{ index + 1 }}</td>
                                    <td class="laptop:text-xs desktop:text-base font-semibold text-slate-500 capitalize">{{ log.last_name }} {{
                                        log.first_name }} {{ log.middle_name.substr(0, 1) }}.</td>
                                    <td class="laptop:text-xs desktop:text-base font-semibold text-slate-500 capitalize">{{ log.time_in }}</td>
                                    <td class="laptop:text-xs desktop:text-base font-semibold text-slate-500 capitalize">{{ log.time_out }}</td>
                                    <td class="laptop:text-xs desktop:text-base font-semibold text-slate-500 capitalize">{{ log.day }}</td>
                                    <td class="laptop:text-xs desktop:text-base font-semibold text-slate-500 capitalize">{{ newDate(log.created_at)
                                    }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else class="bg-gray-100 h-[100px] w-full flex items-center justify-center rounded-md">
                            <span class="text-gray-400">No available data</span>
                        </div>
                    </div>
                    <div class="z-10">
                        <TailwindPagination :data="logs" @pagination-change-page="getLogs" />
                    </div>

                </div>

                <!-- qr scanner starts here... -->

                <div
                    class="bg-white h-full desktop:w-[500px] laptop:w-[330px] flex items-center justify-center flex-col gap-5 py-10 relative rounded-md">
                    <!-- <img src="../assets/images/samson-school.jpg" alt="samson school"
                        class="opacity-20 absolute h-full w-full top-0 right-0 bottom-0 left-0 m-auto object-cover"> -->
                    <!-- <div class="bg-[#00B0F0]/10 w-full h-full absolute top-0 right-0 bottom-0 left-0 m-auto"></div> -->
                    <div
                        class="bg-red-500 desktop:w-80 laptop:w-[250px] desktop:h-80 laptop:h-[250px] flex items-center flex-col z-10">
                        <div :class="{ 'bg-red-400': fail }" class="bg-green-400 w-full h-full p-3 relative">
                            <div
                                class="bg-white desktop:w-[200px] laptop:w-[150px] h-full absolute bottom-0 left-0 right-0 top-0 m-auto" />
                            <div
                                class="bg-white desktop:w-[200px] laptop:w-[150px] h-full absolute rotate-90 bottom-0 left-0 right-0 top-0 m-auto" />
                            <div class="bg-white  w-full h-full">
                                <!-- <div class="scanner-overlay z-10" ref="scannerOverlay"></div> -->
                                <qrcode-stream @init="onInit" @decode="onDecode" :track="drawOutline" :config="scannerConfig"></qrcode-stream>
                            </div>
                        </div>

                    </div>
                    <span class="font-mono font-extrabold text-slate-300">
                        <i class="fa-solid fa-qrcode desktop:text-base laptop:text-sm"></i> Tap your QRCode here.
                    </span>
                    <!-- message success & error starts here... -->
                    <span v-show="fail" class="font-semibold text-red-400 desktop:text-base laptop:text-sm">{{ fail }}</span>
                    <span v-show="successTimeIn" class="font-semibold text-green-400 desktop:text-base laptop:text-sm">{{ successTimeIn }}</span>
                    <span v-show="successTimeOut" class="font-semibold text-green-400 desktop:text-base laptop:text-sm">{{ successTimeOut }}</span>
                    <!-- message success & error ends here... -->
                </div>
            </div>
            <!-- qr scanner starts here... -->
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
            successTimeIn: '',
            successTimeOut: '',
            fail: '',
            decodeString: '',
            logs: { 'data': [] },
            category: 'all',
            formattedDay: useDateFormat(useNow(), "dddd", { locales: 'en-US' }),
            formattedDate: useDateFormat(useNow(), "YYYY-MM-DD", { locales: 'en-US' }),
            scannerConfig: {
                qrbox: 250, // Adjust the size of the QR code scanner box
                aspectRatio: 2, // Set the aspect ratio to 1 for a square box
            }
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
                this.logs = await res.data.users
            } catch (err) {
                console.log(err.message)
            } finally {
                this.loading = false
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
                        this.successTimeIn = res.data.success_time_in
                        this.successTimeOut = res.data.success_time_out
                        this.fail = res.data.fail
                        setTimeout(() => {
                            this.fail = ''
                            this.successTimeIn = ''
                            this.successTimeOut = ''
                        }, 5000);
                        this.speakMessage(this.successTimeIn, 'female');
                        this.speakMessage(this.successTimeOut, 'female');
                        this.speakMessage(this.fail, 'female');
                        
                    }).catch(err => {
                        console.log(err.message)
                    })
            } else {
                return
            }
            this.getLogs()
        },

        speakMessage(message, gender = 'female') {
            const utterance = new SpeechSynthesisUtterance(message);

            // Get available voices
            const voices = window.speechSynthesis.getVoices();

            // Find a female voice (you may need to adjust this logic based on actual voice names)
            const femaleVoice = voices.find(voice => voice.name.includes('female') && voice.name.includes(gender));

            // Use the female voice if available, otherwise, use the default voice
            utterance.voice = femaleVoice || voices[0];

            speechSynthesis.speak(utterance);
        },
        async onInit(promise) {
            // show loading indicator
            try {
                const { capabilities } = await promise
                // console.log(capabilities)
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
<style scoped>
/* Add your styles if needed */

.scanner-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 200px; /* Adjust the size to match the qrbox size */
  height: 200px; /* Adjust the size to match the qrbox size */
  border: 2px solid red; /* Change the color and thickness as needed */
  box-sizing: border-box;
  pointer-events: none; /* Allow interactions with the QR code underneath */
}
</style>