<template>
    <div class="bg-red-500 h-full">
        <div class="flex flex-col p-3 bg-white gap-1 h-[750px]">
            <div class="border h-[50px] flex items-center justify-end px-5">
                <h1>Header</h1>
            </div>
            <div class="bg-white flex-1">
                <table class="w-full whitespace-nowrap z-10 ">
                    <thead class="bg-[#00B0F0] text-justify h-14">
                        <tr>
                            <th class="text-white capitalize pl-5">ID</th>
                            <th class="text-white capitalize">Employee Name</th>
                            <th class="text-white capitalize">Gender</th>
                            <th class="text-white capitalize">Department</th>
                            <th class="text-white capitalize">Position</th>
                            <th class="text-white capitalize">Email</th>
                            <th class="text-white capitalize">QR Code</th>
                            <th class="text-white capitalize">action</th>
                        </tr>
                    </thead>
                    <tbody class="opacity-80">
                        <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" v-for="(user, index) in users"
                            :key="index">
                            <td class="text-sm font-semibold text-slate-500 capitalize pl-5">{{ user.school_id }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ user.last_name }} {{ user.first_name}} {{ user.middle_name }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ user.gender }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ user.department }}</td>
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ user.position }}</td>
                            <td class="text-sm font-semibold text-slate-500">{{ user.email }}</td>
                            <td class="text-sm font-semibold text-slate-500">
                                {{ user.qrcode }}
                                <!-- <QRCodeVue3 :width="50" :height="50" :value="user.qrcode" margin=2
                                    :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'M' }"
                                    :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }" :dotsOptions="{
                                        type: 'classy',
                                        color: '#facc15',
                                        gradient: {
                                            type: 'linear',
                                            rotation: 0,
                                            colorStops: [
                                                { offset: 0, color: '#7f1d1d' },
                                                { offset: 1, color: '#000' },
                                            ],
                                        },
                                    }" :backgroundOptions="{ color: '#fff' }"
                                    :cornersSquareOptions="{ type: 'Dot', color: '#7f1d1d' }"
                                    :cornersDotOptions="{ type: undefined, color: '#000000' }" fileExt="png"
                                    :download="true" myclass="my-qr" imgclass="img-qr" downloadButton="my-button"
                                    :downloadOptions="{ name: user.last_name, extension: 'png' }" /> -->
                            </td>
                            <td class="text-sm font-semibold text-slate-500 capitalize"></td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-green-500">
                <h1>123</h1>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
import { TailwindPagination } from 'laravel-vue-pagination';
import QRCodeVue3 from "qrcode-vue3";
export default {
    components: {
        TailwindPagination,
        QRCodeVue3
    },
    setup() {
        const message = ref('Hello')
        const loading = ref(false)
        const users = ref({ 'data': [] })

        const getAllUsers = async () => {
            loading.value = true
            try {
                const res = await axios.get('/admin/user-lists')
                if (!res.data.status) {
                    throw Error('Something went wrong!')
                } else {
                    users.value = await res.data.users
                    console.log(users.value)
                }
            } catch (err) {
                console.log(err.message)
            } finally {
                loading.value = false
                console.log('Done fetching...')
            }
        }
        onMounted(() => {
            getAllUsers()
        })
        return {
            users,
            message,
        }
    }
}
</script>

<style>
.my-button {
    font-size: xx-small;
    background-color: #00B0F0;
    padding: .2px 3px .2px 3px;
    color: #fff
}
</style>