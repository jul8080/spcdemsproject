<template>
    <div class="bg-white h-full">
        <div class="flex flex-col p-3 bg-white gap-3 h-[750px]">
            <div class="add-container h-[100px] flex items-center justify-between px-5 rounded-md">
                <div class="flex flex-col">
                    <span class="text-gray-700 font-semibold">Manage Your Employees</span>
                    <span class="text-gray-400 font-normal text-xs">Use the form to create employee.</span>
                </div>
                <button @click="activeModal" class="bg-green-400 text-white px-2 py-3 rounded-md font-semibold text-xs">
                    <i class="fa-sharp fa-light fa-plus"></i>
                    New Employee
                </button>
            </div>
            <div class="searh-container h-[70px] flex items-center justify-between px-5 rounded-md">
                <div class="flex items-center justify-between gap-1">
                    <div class="w-[300px] h-10">
                        <input v-model="search" type="text" id="search" name="search"
                        class="border-blue-200 outline-none focus:border-blue-500 pl-2 h-full w-full bg-[#f1f1f1]"
                        placeholder="search employee" @input="applyFilter">
                    </div>
                    <div class="bg-[#00B0F0] px-3 py-2">
                        <i class="fa-solid fa-magnifying-glass text-white"></i>
                    </div>
                </div>
            </div>
            <div class="h-[350px] bg-white">
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
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- pagination starts here... -->
            <ButtonComponent @prev-page="getAllUsers" @next-page="getAllUsers" @last-page="getAllUsers" :page="pages" :totalPages="totalPages">
            </ButtonComponent>
            <!-- pagination ends here... -->
        </div>
        <ModalComponent :modalActive="modalActive" type="bblur">
            <transition name="moda-animation-inner">
                <div ref="modal" v-show="modalActive" class="modal-container bg-white w-[1000px] rounded-md flex flex-col p-10">
                    <!-- Modal content -->
                    <div class="h-[250px] bg-gray-200 px-[300px] rounded-tl-md rounded-tr-md">
                        <div class=" w-full h-full">

                           <img src="../../assets/images/logo-2.png" alt="recordit-png" class="object-fit h-full w-full"> 
                        </div>
                    </div>

                    <div class="bg-white flex-1 flex flex-col px-5 pt-10">
                        <RegistrationComponent @get-api="getAllUsers" :date="date" @close="closeModal"></RegistrationComponent>
                    </div>
                </div>
            </transition>
        </ModalComponent>
    </div>
</template>
<!-- <script>
import QRCodeVue3 from "qrcode-vue3";
import ModalComponent from '../../components/modal/ModalComponent.vue';
import RegistrationComponent from '../form/RegistrationComponent.vue';
import ButtonComponent from '../helpers/ButtonComponent.vue';
export default {
    props: ['date'],
    components: {
        QRCodeVue3,
        ModalComponent,
        RegistrationComponent,
        ButtonComponent
    },
    data() {
        return {
            loading: false,
            users: [],
            modalActive: false,
            page: 1,
            totalPages: 1,
            search: '',
            modal: null
        }
    },
    methods: {
        async getAllUsers(page) {
            this.loading = true
            try {
                const res = await axios.get(`/admin/user-lists?page=${page}&search=${this.search}`)
                this.users = res.data.users.data
                this.page = res.data.users.current_page
                this.totalPages = res.data.users.last_page
            } catch (err) {
                console.log(err.message)
            } finally {
                this.loading = false
                console.log('Done fetching...')
            }
        },
        activeModal() {
            this.modalActive = !this.modalActive
        },
        closeModal() {
            this.modalActive = !this.modalActive
        },
        handleClose(event) {
            if (event.key == 'Escape') {
                this.modalActive = false
            }
        },
        applyFilter() {
            this.getAllUsers(1);
        },

    },
    mounted() {
        this.getAllUsers(this.page)
        document.addEventListener('keyup', this.handleClose)
    },
    unmounted() {
        document.removeEventListener('keyup', this.handleClose)
    },
    computed: {}

}
</script> -->
<script>
import { ref, onMounted, onUnmounted } from 'vue';
import QRCodeVue3 from "qrcode-vue3";
import { onClickOutside } from '@vueuse/core'
import ModalComponent from '../../components/modal/ModalComponent.vue';
import RegistrationComponent from '../form/RegistrationComponent.vue';
import ButtonComponent from '../helpers/ButtonComponent.vue';
export default {
    components: {
        QRCodeVue3,
        ModalComponent,
        RegistrationComponent,
        ButtonComponent
    },
    props: ['date'],
    setup() {

        const loading = ref(false)
        const users = ref([])
        const modalActive = ref(false)
        const pages = ref(1)
        const totalPages = ref(1)
        const modal = ref(null)
        const search = ref('')

        onClickOutside(modal, () => (modalActive.value = false))
        const getAllUsers = async (page) => {
            loading.value = true
            try {
                const res = await axios.get(`/admin/user-lists?page=${page}&search=${search.value}`)
                users.value = res.data.users.data
                pages.value = res.data.users.current_page
                totalPages.value = res.data.users.last_page
            } catch (err) {
                console.log(err)
            } finally {
                loading.value = false
                console.log('Done fetching...')
            }
        }

        const activeModal =() => {
            modalActive.value = !modalActive.value
        }
        const closeModal =() => {
            modalActive.value = !modalActive.value
        }
        const applyFilter =() => {
            getAllUsers(1);
        }
        const handleClose = (event) => {
            if (event.key == 'Escape') {
                modalActive.value = false
            }
        }

        onMounted(() => {
            document.addEventListener('keyup', handleClose)
            getAllUsers(pages.value)
        })
        onUnmounted(() => {
            document.removeEventListener('keyup', handleClose)
        })
    

        return {
            loading,
            users,
            modalActive,
            pages,
            totalPages,
            modal,
            search,
            applyFilter,
            activeModal,
            closeModal,
            getAllUsers,
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

.add-container,
.searh-container {
    box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}
.modal-container {
    box-shadow: 0 0 20px rgba(0, 0, 0, .3);
}
</style>