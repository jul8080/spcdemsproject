<template>
    <div class="bg-red-500 h-full">
        <div class="flex flex-col p-3 bg-white gap-1 h-[750px]">
            <div class="border h-[50px] flex items-center justify-end px-5">
                <button @click="activeModal" class="bg-[#00B0F0] text-white px-3 py-2 rounded-sm">Add Employee</button>
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
                            <td class="text-sm font-semibold text-slate-500 capitalize">{{ user.last_name }} {{
                                user.first_name }} {{ user.middle_name }}</td>
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
        <ModalComponent :modalActive="modalActive" type="primary">
            <transition name="moda-animation-inner">
                <div v-show="modalActive" class="bg-white shadow-2xl bg-white/5 w-[1200px] flex flex-col">
                    <!-- Modal content -->
                    <div class="bg-[#f1f1f1] h-[300px] flex items-center justify-center py-5">
                        <div class="w-full h-full flex items-center justify-center">
                            <img src="../../assets/images/recordit.png" alt="recordit-png"
                                class="object-contain h-[750px] w-[750px]">
                        </div>
                    </div>
                    <div class="bg-white flex-1 flex flex-col px-5 pt-10">
                        <RegistrationComponent :date="date" @close="closeModal"></RegistrationComponent>
                    </div>

                </div>
            </transition>
        </ModalComponent>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
import { TailwindPagination } from 'laravel-vue-pagination';
import QRCodeVue3 from "qrcode-vue3";
import ModalComponent from '../modal/ModalComponent.vue';
import RegistrationComponent from '../form/RegistrationComponent.vue';
export default {
    components: {
        TailwindPagination,
        QRCodeVue3,
        ModalComponent,
        RegistrationComponent
    },
    props: ['date'],
    setup(props, { emit }) {
        const message = ref('Hello')
        const loading = ref(false)
        const users = ref({ 'data': [] })
        const modalActive = ref(false)

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
        const activeModal = () => {
            modalActive.value = !modalActive.value
        }
        const closeModal = () => {
            modalActive.value = !modalActive.value
        }

        const handleClose = (event) => {
            console.log('closing modal')
            if (event.key == 'Escape') {
                modalActive.value = false
            }
        }
        onMounted(() => {
            document.addEventListener('keyup', handleClose)
            getAllUsers()

        })
        onUnmounted(() => {
            document.removeEventListener('keyup', handleClose)
        })

        return {
            users,
            message,
            modalActive,
            activeModal,
            closeModal,
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

.moda-animation-inner-enter-active {
    transition: all .3s cubic-bezier(0.52, 0.02, 0.19, 1.02) 0.15s;
}

.moda-animation-inner-leave-active {
    transition: all .3s cubic-bezier(0.52, 0.02, 0.19, 1.02);
}

.moda-animation-inner-enter-from {
    opacity: 0;
    transform: scale(0.8);
}

.moda-animation-inner-leave-to {
    transform: scale(0.8);
}

@keyframes spinner {
    to {
        transform: rotate(360deg);
    }
}

.is-loading {
    color: transparent;
}

.is-loading:before {
    content: '';
    box-sizing: border-box;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin-top: -10px;
    margin-left: -10px;
    border-radius: 50%;
    border: 2px solid transparent;
    border-top-color: #07d;
    border-bottom-color: #07d;
    animation: spinner .8s ease infinite;
}
</style>