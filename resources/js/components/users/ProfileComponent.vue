<template>
    <div class="white h-full w-full p-28">
        <div class="h-full w-full flex flex-row">

            <div class="bg-white h-full w-[350px] flex flex-col gap-10 p-5">
                <div class="image-container bg-white h-full w-full flex flex-col rounded-sm p-3">
                    <div class="bg-slate-700 flex-1 rounded-md flex items-center justify-center overflow-hidden">
                        <img v-if="user.image !== null" :src="`/images/${user.image}`" class="h-full w-full object-cover">
                        <span v-else class="uppercase text-white font-semibold text-9xl">{{ user.first_name[0] }}{{ user.last_name[0] }}</span>
                    </div>
                    <div class="h-[60px] flex items-center justify-center bg-white">
                        <button @click="openModal"
                            :disabled="modalActive"
                            class="disabled:bg-gray-300 w-[300px] h-[50px] bg-blue-500 rounded-md text-white font-semibold">Change
                            Profile
                        </button>
                    </div>
                </div>

                <div class="profile-detail-container bg-white h-[500px] w-full flex flex-col p-3 rounded-sm gap-3">
                    <h1 class="text-3xl">Profile detail</h1>
                    <div class="flex-1 bg-white">
                        <div class="flex flex-col gap-5">
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">ID #:</span>
                                <span class="">{{ user.school_id }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Email:</span>
                                <span class="">{{ user.email }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Phone no:</span>
                                <span class="">{{ personalInfo ? personalInfo.phone_no : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Gender:</span>
                                <span class="">{{ user.gender }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col gap-10 p-5 pl-0">
                <div class="personal-info-container bg-white flex-1 flex flex-col p-10 gap-3">
                    <span class="text-3xl capitalize">Personal Information</span>
                    <div class="bg-white flex-1 flex">
                        <div class="bg-white flex-1 flex flex-col gap-3">
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Full name:</span>
                                <span class="">{{ user.first_name }} {{ user.middle_name }} {{ user.last_name }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Department:</span>
                                <span class="">{{ user.department }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Position:</span>
                                <span class="">{{ user.position }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Address:</span>
                                <span class="">{{ personalInfo ? personalInfo.address : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Date of Birth:</span>
                                <span class="">{{ personalInfo ? personalInfo.dob : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Birth Place:</span>
                                <span class="">{{ personalInfo ? personalInfo.birth_place : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Age:</span>
                                <span class="">{{ personalInfo ? personalInfo.age : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400">Status:</span>
                                <span class="">{{ personalInfo ? personalInfo.status : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="emergency-contact-container bg-white h-[250px] flex flex-col p-10 py-2">
                    <span class="text-3xl capitalize">emergency contact</span>
                    <div class="bg-white flex-1 flex flex-col gap-3 items-start justify-center">
                        <div class="flex flex-row gap-3">
                            <span class="text-gray-400">Full name:</span>
                            <span class="">
                                {{ emergencyContact ? emergencyContact.first_name : '' }}
                                {{ emergencyContact ? emergencyContact.middle_name : '' }}
                                {{ emergencyContact ? emergencyContact.last_name : '' }} </span>
                        </div>
                        <div class="flex flex-row gap-3">
                            <span class="text-gray-400">Address:</span>
                            <span class="">{{ emergencyContact ? emergencyContact.address : '' }}</span>
                        </div>
                        <div class="flex flex-row gap-3">
                            <span class="text-gray-400">Phone no:</span>
                            <span class="">{{ emergencyContact ? emergencyContact.phone_no : '' }}</span>
                        </div>
                        <div class="flex flex-row gap-3">
                            <span class="text-gray-400">Relationship:</span>
                            <span class="">{{ emergencyContact ? emergencyContact.relationship : '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- modal for form photo changing starts here... -->
        <modal-component :modalActive="modalActive" type="primary">
            <div ref="modal" class="photo-form-container bg-white w-[500px] h-[250px] rounded-md flex flex-col p-5">
                <div class="flex-1 flex flex-col items-center justify-center gap-5">
                    <div class="flex flex-col items-center justify-center gap-[.2rem]">
                        <div v-show="imageUrl" class="bg-red-500 h-[50px] w-[50px] rounded-md">
                            <img :src="imageUrl" accept="image/*" class="h-full w-full object-cover rounded-md">
                        </div>
                        <i class="fa-solid fa-camera text-5xl text-gray-400" :class="{ 'hidden': imageUrl }"></i>
                        <!-- success and fail message starts here... -->
                        <span v-show="success" class="text-xs text-green-500">{{ success }}</span>
                        <span v-show="fail" class="text-xs text-red-500">{{ fail }}</span>
                        <!-- success and fail message ends here... -->
                        <label for="image" class="text-xs bg-green-500 text-white px-1 rounded-full">
                            <i class="fa-solid fa-plus text-xs"></i>photo</label>
                        <input @change="handleImageForm" name="image" id="image" type="file"
                            class="absolute left-0 right-0 m-auto hidden">
                    </div>

                    <div class="flex flex-col items-center justify-center">
                        <span class="font-semibold">A photo of you</span>
                        <span class="text-xs text-gray-400">Please make sure your photo clearly shows your face.</span>
                    </div>
                </div>
                <div class="h-10 flex items-center justify-center gap-5 border-t-[1px]">
                    <button @click="closeModal" class="text-sm text-gray-700">cancel</button>
                    <button class="text-sm text-gray-700" @click="handleSubmit">save</button>
                </div>
            </div>
        </modal-component>
        <!-- modal for form photo changing ends here... -->
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
import ModalComponent from '../../components/modal/ModalComponent.vue'
import useImageUploader from '../composables/image/imageUpload'
import { onClickOutside } from '@vueuse/core'
export default {
    components: {
        'modal-component': ModalComponent
    },
    setup() {
        const success = ref('')
        const fail = ref('')
        const modal = ref(null)
        const user = ref([])
        const personalInfo = ref([])
        const emergencyContact = ref([])
        const modalActive = ref(false)
        const status = ref(0)
        const { imageFile, imageUrl, handleImageForm } = useImageUploader()
        onClickOutside(modal, () => (modalActive.value = false))
        const getData = async () => {
            try {
                const res = await axios.get('/user/data')
                user.value = res.data.user
                personalInfo.value = res.data.personalinfo
                emergencyContact.value = res.data.contactinfo
            } catch (err) {
                console.log(err.message)
            } finally {
                console.log('Fetch done...')
            }
        }

        const handleSubmit = async () => {
            let data = new FormData()
            data.append('image', imageFile.value)
            try {
                const res = await axios.post('/user/upload-image', data);
                if(res.data.status === 200) {
                    status.value = res.data.status
                    success.value = res.data.message
                } else {
                    status.value = res.data.status
                    fail.value = res.data.message[0]
                }
                setTimeout(() => {
                     success.value = ''
                     fail.value = ''
                }, 5000)
            } catch (err) {
                console.log(err.massage,)
            }
            getData()
        }
        const submitHandler = (event) => {
            if (event.key == 'Escape') {
                modalActive.value = false
                imageFile.value = ''
                imageUrl.value = ''
            }
        }
        const closeModal = () => {
            modalActive.value = false
            success.value = ''
            fail.value = ''
            setTimeout(() => {
                imageUrl.value = ''
                imageFile.value = ''
            },500)
        }
        const openModal = () => {
            modalActive.value = true
        }

        onMounted(() => {
            document.addEventListener('keyup', submitHandler)
            getData()
        })
        onUnmounted(() => {
            updateMessage()
            document.removeEventListener('keyup', submitHandler)
        })

        return {
            imageUrl,
            user,
            personalInfo,
            emergencyContact,
            modalActive,
            handleImageForm,
            closeModal,
            openModal,
            handleSubmit,
            modal,
            status,
            success,
            fail
        }
    }
}
</script>

<style scoped>
.personal-info-container,
.emergency-contact-container,

.profile-detail-container,
.image-container {
    box-shadow: 0 0 3px rgba(0, 0, 0, .4);
}

.photo-form-container {
    box-shadow: 0 0 10px rgba(0, 0, 0, .5);
}
</style>



<!-- <div class="w-full p-3 flex gap-1 relative overflow-hidden">
    <div class="w-[350px] h-full flex flex-col border p-5 ">
        <div class="h-[180px] w-full  flex items-center">
            @if (Auth::user()->image != '')
                <div class="flex items-center gap-2">
                    <a class="bg-slate-700 w-24 h-24 rounded-md flex items-center justify-center relative cursor-pointer shadow">
                        <img src="{{ asset('images/'. $user->image) }}" class="object-cover w-full h-full rounded-md">
                        <div id="show"  class="bg-[#00B0F0]/10 hover:bg-[#00B0F0]/20 group transition w-full h-10 absolute bottom-0 right-0 flex items-center justify-center text-white">
                            <span class="material-symbols-outlined text-gray-50 group-hover:text-gray-100">
                                photo_camera
                            </span>
                        </div>
                    </a>
                <div class="flex flex-col gap-1 self-end mb-2">
                    <span class="font-bold text-lg text-gray-500">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                    <span class="text-xs text-gray-300">School ID:  {{ $user->school_id }}</span>
                </div>
            </div>
            @else
                <div class="flex items-center gap-2">
                        <div class="bg-slate-700 w-24 h-24 rounded-md flex items-center justify-center relative">
                            <span class="text-white font-bold text-6xl capitalize">{{ $user->first_name[0] }}</span>
                            <div id="show" class="bg-[#00B0F0]/10 hover:bg-[#00B0F0]/20 group transition w-full h-10 rounded-br-md rounded-bl-md absolute bottom-0 right-0 flex items-center justify-center text-white">
                                <span class="material-symbols-outlined text-gray-50 group-hover:text-gray-100">
                                    photo_camera
                                </span>
                            </div>
                        </div>
                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-lg text-gray-500">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                        <span class="text-xs text-gray-300">School ID:  {{ $user->school_id }}</span>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex-1 flex flex-col">

            <div class="h-12 w-full flex items-center">
                <span class="material-symbols-outlined text-3xl text-gray-400">
                    account_box
                </span>
                <span class="font-semibold text-2xl text-gray-400">Profile Detail</span>
            </div>
            <div class="flex-1 pt-5 flex flex-col">
                <ul class="flex flex-col gap-5">
                    <li class="flex">
                        <div class="w-28 flex-shrink-0"><span class="text-gray-400">Email:</span></div>
                        <div class="flex-1 flex"><span class="text-gray-400">{{ $user->email }}</span></div>
                    </li>
                    <li class="flex">
                        <div class="w-28 flex-shrink-0"><span class="text-gray-400">Gender:</span></div>
                        <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $user->gender }}</span></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
     <div class="flex-1 flex flex-col gap-1">
        <div class="flex-1 border">
            <x-personal-information :personalInfo="$personalInfo" :user="$user" />
        </div>
        <div class="flex-1 border">
            <x-contact-information :contactInfo="$contactInfo" :user="$user" />
        </div>
    </div>
    <div class="bg-gray-500/60 w-full absolute h-full hidden" id="showForm">
        <x-change_photo/>
    </div>
</div> -->