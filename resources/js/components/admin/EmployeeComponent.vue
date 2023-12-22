<template>
    <div class="h-full">
        <div class="flex flex-col p-3 bg-white gap-3 h-[750px] w-full">
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
                    <form @submit.prevent="getAllUsers" class="w-[300px] desktop:h-[48px] laptop:h-[35px] flex">
                        <input v-model="search" type="text" id="search" name="search"
                            class="border-blue-200 rounded-tl-md rounded-bl-md outline-none focus:border-blue-500 pl-2 h-full w-full bg-[#f1f1f1] desktop:text-sm laptop:text-xs"
                            placeholder="search employee">

                        <button :disabled="loading" type="submit"
                            class="bg-blue-300 hover:bg-blue-400 desktop:py-2 desktop:w-[70px] laptop:w-[50px] rounded-tr-md rounded-br-md relative"
                            :class="{ 'is_loading': loading, 'bg-blue-200': loading }">
                            <i class="fa-solid fa-magnifying-glass text-white laptop:text-xs desktop:text-sm" :class="{ 'hidden': loading }"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- success message starts here... -->
            <div v-show="success" class="bg-green-300 w-full h-14 rounded-md flex items-center justify-center">
                <span class="text-white font-semibold">{{ success }}</span>
            </div>
            <!-- success message ends here... -->

            <div class="h-[350px] bg-white">
                <table v-if="users.length > 0" class="w-full z-10">
                    <thead class="bg-[#00B0F0] text-justify h-14">
                        <tr>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize pl-5">Employee Name</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize">Gender</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize">Position</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize">Email</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize">QR Code</th>
                            <th class="laptop:text-xs desktop:text-sm text-white capitalize"></th>
                        </tr>
                    </thead>
                    <tbody class="opacity-80 w-full">
                        <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" v-for="(user, index) in users"
                            :key="index">
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize pl-5">{{
                                user.last_name }} {{user.first_name }} {{ user.middle_name }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize">{{
                                user.gender }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500 capitalize">{{
                                user.position }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500">{{ user.email }}</td>
                            <td class="desktop:text-sm laptop:text-xs font-semibold text-slate-500">
                                <button @click="generateQrcode(user.qrcode)"
                                    class="bg-green-300 rounded-md text-white px-3 py-1">{{ user.qrcode }}</button>
                            </td>
                            <td class="">
                                <button @click="openPositionModal(user.id)" class="text-blue-500 outline-none">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="bg-gray-100 h-[100px] w-full flex items-center justify-center rounded-md">
                    <span class="text-gray-400">No available data</span>
                </div>
            </div>
            <div v-if="users.length > 0">
                <!-- pagination starts here... -->
                <ButtonComponent @prev-page="getAllUsers" @next-page="getAllUsers" @last-page="getAllUsers" :page="pages"
                    :totalPages="totalPages">
                </ButtonComponent>
                <!-- pagination ends here... -->
            </div>
        </div>

        <!-- modal for registration form starts here... -->
        <ModalComponent :modalActive="modalActive" type="bblur">
            <transition name="moda-animation-inner">
                <div ref="modal" v-show="modalActive"
                    class="modal-container desktop:w-[1000px] laptop:w-[700px] rounded-md flex flex-col desktop:p-10 laptop:p-3 bg-white">
                    <!-- Modal content -->
                    <div class="desktop:h-[250px] laptop:h-[170px] w-full bg-gray-200 desktop:px-[300px] laptop:px-[200px] rounded-tl-md rounded-tr-md">
                        <div class="w-full h-full">
                            <img src="../../assets/images/logo-2.png" alt="recordit-png" class="laptop:object-cover desktop:object-fit h-full w-full">
                        </div>
                    </div>

                    <div class="bg-white flex-1 flex flex-col desktop:px-5 laptop:px-2 pt-10">
                        <RegistrationComponent @get-api="getAllUsers" :date="date" @close="closeModal">
                        </RegistrationComponent>
                    </div>
                </div>
            </transition>
        </ModalComponent>
        <!-- modal for registration form ends here... -->

        <!-- modal for editing user position form starts here... -->
        <ModalComponent :modalActive="positionModalActive" type="primary">
            <div ref="positionModal" class="bg-white w-[500px] rounded-md p-10 flex flex-col">
                <div class="flex">
                    <div class="flex items-center justify-center px-5">
                        <i class="fa-solid fa-user-pen text-3xl"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-base font-semibold">Manage Employee</span>
                        <span class="text-xs text-gray-500">Use this form to edit employee "position".</span>
                    </div>
                </div>
                <form @submit.prevent="submitData" class="flex-1 mt-5 border-t-[1px] p-5">
                    <div class="flex flex-col gap-2">
                        <label>Position:</label>
                        <div class="flex items-start h-[50px] bg-gray-300 rounded-md overflow-hidden">
                            <select class="h-full w-full focus:outline-blue-500 bg-[#f1f1f1] p-2 capitalize" v-model="position">
                                <option value="" selected>{{ user.position }}</option>
                                <option value="employee" :class="{ 'hidden': user.position == 'employee' }"
                                    class="bg-white">
                                    Employee</option>
                                <option value="secretary" :class="{ 'hidden': user.position == 'secretary' }"
                                    class="bg-white">
                                    Secretary</option>
                                <option value="checker" :class="{ 'hidden': user.position == 'checker' }" class="bg-white">
                                    Checker</option>
                            </select>
                        </div>
                    </div>
                    <button :disabled="position != '' ? submitFormCondition : true" type="submit"
                        class="bg-blue-400 w-full text-white rounded-md py-3 font-semibold mt-1 text-xs disabled:hidden">Submit</button>
                </form>
            </div>
        </ModalComponent>
        <!-- modal for editing user position form ends here... -->

        <!-- modal for qrcode generator  starts here... -->
        <ModalComponent :modalActive="qrModal" type="primary">
            <div ref="qrRef" class="bg-white rounded-md w-[350px] p-10 flex  flex-col items-center justify-center gap-5">
                <div>
                    <span class="text-base font-semibold">QR Code Generator</span>
                </div>
                <input disabled type="text"
                    class="bg-red-500 w-full py-3 rounded-md text-white font-semibold px-5 text-center" v-model="qrcode" />
                <div class="qr-container">
                    <QRCodeVue3 v-if="qrcode" :width="200" :height="200" :value="qrcode" :margin="10"
                        :qrOptions="{ typeNumber: 0, mode: 'Byte', errorCorrectionLevel: 'H' }"
                        :imageOptions="{ hideBackgroundDots: true, imageSize: 0.4, margin: 0 }" :dotsOptions="{
                            type: 'extra-rounded',
                            color: '#26249a',
                            gradient: {
                                type: 'linear',
                                rotation: 0,
                                colorStops: [
                                    { offset: 0, color: '#000000' },
                                    { offset: 1, color: '#000000' },
                                ],
                            },
                        }" :backgroundOptions="{ color: 'white' }"
                        :cornersSquareOptions="{ type: 'square', color: '#000000' }"
                        :cornersDotOptions="{ type: undefined, color: '#000000' }" fileExt="png" :download="true"
                        myclass="my-qur" imgclass="img-qr" downloadButton="my-button"
                        :downloadOptions="{ name: 'vqr', extension: 'png' }" />
                </div>
            </div>
        </ModalComponent>
        <!-- modal for qrcode generator  ends here... -->
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted, watch } from 'vue';
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
        const message = ref(null)
        const success = ref('')
        const position = ref('')
        const submitFormCondition = ref(false)
        const loading = ref(false)
        const users = ref([])
        const user = ref({})
        const modalActive = ref(false)
        const positionModalActive = ref(false)
        const confirmMessage = ref(false)
        const pages = ref(1)
        const totalPages = ref(1)
        const modal = ref(null)
        const positionModal = ref(null)
        const search = ref('')
        const qrcode = ref(null)
        const qrModal = ref(false)
        const qrRef = ref(null)

        onClickOutside(modal, () => (modalActive.value = false))
        onClickOutside(qrRef, () => (qrModal.value = false, qrcode.value = null))
        onClickOutside(positionModal, () => (positionModalActive.value = false, position.value = ''))


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

        const openPositionModal = async (id) => {
            positionModalActive.value = !positionModalActive.value
            try {
                const res = await axios.get(`/admin/user-id/${id}`);
                user.value = res.data.user
                //  console.log(user.value)
            } catch (error) {
                console.log(error.message)
            }
            console.log(id)
        }
        const submitData = async () => {
            try {
                const res = await axios.post('/admin/user/store', { 'id': user.value.id, 'position': position.value })
                success.value = res.data.success
                setTimeout(() => {
                    success.value = ''
                }, 5000)
            } catch (error) {
                console.log(error.message)
            } finally {
                positionModalActive.value = false
                getAllUsers()
            }

        }
        const generateQrcode = (value) => {
            qrModal.value = !qrModal.value
            return qrcode.value = value
            console.log(qrcode.value)
        }
        const activeModal = () => {
            modalActive.value = !modalActive.value
        }
        const closeModal = () => {
            modalActive.value = !modalActive.value
        }
        const applyFilter = () => {
            getAllUsers(1);
        }
        const handleClose = (event) => {
            if (event.key == 'Escape') {
                modalActive.value = false
            }
        }
        const handleClosePositionModal = (event) => {
            if (event.key == 'Escape') {
                positionModalActive.value = false
                position.value = ''
            }
        }
        const handleCloseQrModal = (event) => {
            if (event.key == 'Escape') {
                qrModal.value = false
                setTimeout(() => {
                    qrcode.value = null
                }, 500)
            }
        }

        onMounted(() => {
            document.addEventListener('keyup', handleClosePositionModal)
            document.addEventListener('keyup', handleClose)
            document.addEventListener('keyup', handleCloseQrModal)
            getAllUsers(pages.value)
        })
        onUnmounted(() => {
            document.removeEventListener('keyup', handleClosePositionModal)
            document.removeEventListener('keyup', handleClose)
            document.removeEventListener('keyup', handleCloseQrModal)
        })


        return {
            message,
            qrRef,
            qrcode,
            qrModal,
            success,
            submitFormCondition,
            position,
            loading,
            users,
            user,
            modalActive,
            pages,
            totalPages,
            modal,
            positionModal,
            confirmMessage,
            search,
            applyFilter,
            activeModal,
            closeModal,
            getAllUsers,
            positionModalActive,
            openPositionModal,
            submitData,
            generateQrcode
        }
    }
}
</script>

<style>
@keyframes spinner {
    to {
        transform: rotate(360deg);
    }
}

.is_loading:before {
    content: '';
    box-sizing: border-box;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 1px solid #ccc;
    border-top-color: rgb(0, 82, 153);
    animation: spinner .6s linear infinite;
}

.my-button {
    background-color: #00B0F0;
    padding: .2px 3px .2px 3px;
    color: #fff;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
    border-radius: 50px;
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
}</style>