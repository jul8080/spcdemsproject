<template>
    <div class="bg-white h-full w-full desktop:p-28 laptop:p-10 laptop:flex laptop:items-center laptop:justify-center">
        <div class="laptop:h-[700px] desktop:h-full w-full flex">

            <div class="h-full desktop:w-[300px] laptop:w-[280px] flex flex-col desktop:gap-0 desktop:p-0 laptop:gap-0 laptop:p-0">
                <div class="image-container bg-white desktop:h-[500px] laptop:h-[500px] w-full flex flex-col">
                    <div class="bg-slate-700 flex-1 flex items-center justify-center relative overflow-hidden">
                        <div class="h-full w-full overflow-hidden flex items-center justify-center">
                            <img  v-if="user.image !== null" loading="lazy" :src="`/images/${user.image}`" class="h-full w-full object-cover">
                            <span v-else class="uppercase text-white font-semibold desktop:text-9xl laptop:text-7xl">{{ user.first_name[0] }}{{ user.last_name[0] }}</span>
                        </div>
                    </div>
                    <div class="h-[50px] flex items-center justify-center w-full">
                        <button @click="openModal" id="chooseBtn" :disabled="modalActive"
                            class="disabled:bg-gray-300 w-full h-full bg-blue-500 text-white font-semibold">Change
                            Profile
                        </button>
                    </div>
                </div>

                <div class="profile-detail-container bg-white h-[500px] w-full flex flex-col p-3 gap-3">
                    <h1 class="desktop:text-3xl laptop:text-2xl">Profile detail</h1>
                    <div class="flex-1 bg-white">
                        <div class="flex flex-col gap-5">
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Email:</span>
                                <span class="laptop:text-sm desktop:text-base">{{ user.email }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Phone no:</span>
                                <span class=" laptop:text-sm desktop:text-base">{{ personalInfo ? personalInfo.phone_no : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Gender:</span>
                                <span class="capitalize laptop:text-sm desktop:text-base">{{ user.gender }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col desktop:gap-0 desktop:p-0 pl-0">
                <div class="personal-info-container bg-white desktop:flex-1 laptop:h-full flex flex-col p-10 gap-3">
                    <span class="desktop:text-3xl laptop:text-2xl capitalize">Personal Information</span>
                    <div class="bg-white flex-1 flex">
                        <div class="bg-white flex-1 flex flex-col gap-3">
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Full name:</span>
                                <span class=" laptop:text-sm desktop:text-base">{{ user.first_name }} {{ user.middle_name }} {{ user.last_name }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Position:</span>
                                <span class="capitalize">{{ user.position }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Address:</span>
                                <span class="capitalize laptop:text-sm desktop:text-base">{{ personalInfo ? personalInfo.address : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Date of Birth:</span>
                                <span class=" laptop:text-sm desktop:text-base">{{ personalInfo ? personalInfo.dob : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Birth Place:</span>
                                <span class=" laptop:text-sm desktop:text-base">{{ personalInfo ? personalInfo.birth_place : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Age:</span>
                                <span class=" laptop:text-sm desktop:text-base">{{ personalInfo ? personalInfo.age : '' }}</span>
                            </div>
                            <div class="flex flex-row gap-3">
                                <span class="text-gray-400 laptop:text-sm desktop:text-base">Status:</span>
                                <span class=" laptop:text-sm desktop:text-base">{{ personalInfo ? personalInfo.status : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="emergency-contact-container bg-white desktop:h-[full laptop:h-full flex flex-col p-10 py-2">
                    <span class="desktop:text-3xl laptop:text-2xl capitalize">emergency contact</span>
                    <div class="flex-1 flex flex-col gap-3 items-start justify-start">
                        <div class="flex flex-row gap-3 mt-5">
                            <span class="text-gray-400 laptop:text-sm desktop:text-base">Full name:</span>
                            <span class=" laptop:text-sm desktop:text-base">
                                {{ emergencyContact ? emergencyContact.first_name : '' }}
                                {{ emergencyContact ? emergencyContact.middle_name : '' }}
                                {{ emergencyContact ? emergencyContact.last_name : '' }} </span>
                        </div>
                        <div class="flex flex-row gap-3">
                            <span class="text-gray-400 laptop:text-sm desktop:text-base">Address:</span>
                            <span class=" laptop:text-sm desktop:text-base">{{ emergencyContact ? emergencyContact.address : '' }}</span>
                        </div>
                        <div class="flex flex-row gap-3">
                            <span class="text-gray-400 laptop:text-sm desktop:text-base">Phone no:</span>
                            <span class=" laptop:text-sm desktop:text-base">{{ emergencyContact ? emergencyContact.phone_no : '' }}</span>
                        </div>
                        <div class="flex flex-row gap-3">
                            <span class="text-gray-400 laptop:text-sm desktop:text-base">Relationship:</span>
                            <span class=" laptop:text-sm desktop:text-base">{{ emergencyContact ? emergencyContact.relationship : '' }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- modal for form photo changing starts here... -->
        <modal-component :modalActive="modalActive" type="primary">
            <div ref="modal" class="photo-form-container bg-white w-[500px] h-[250px] rounded-md flex flex-col p-5 relative">
                <button @click="closeModal" v-show="success" class="wrapper absolute right-0 top-0">
                    <div class="icon close">
                        <span><i class="fa-solid fa-xmark"></i></span>
                        <div class="tooltip">close</div>
                    </div>
                </button>
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
                <div class="h-10 flex items-center justify-center gap-5 border-t-[1px]" :class="{ 'hidden': success }">
                    <button @click="closeModal" class="text-sm text-gray-700">cancel</button>
                    <button class="text-sm text-gray-700" @click="handleSubmit">upload</button>
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
        onClickOutside(modal, () => (modalActive.value = false, setTimeout(() => success.value = '', 300)))

        const getData = async () => {
            try {
                const res = await axios.get('/admin/data')
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
                const res = await axios.post('/admin/upload-image', data);
                if (res.data.status === 200) {
                    status.value = res.data.status
                    success.value = res.data.message
                } else {
                    status.value = res.data.status
                    fail.value = res.data.message[0]
                }
                console.log(res.data.message)
                setTimeout(() => {
                    //  success.value = ''
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

            }, 500)
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
            fail,
        }
    }
}
</script>

<style scoped>
.wrapper .icon {
    display: flex;
    /* cursor: pointer; */
    align-items:  center;
    flex-direction: column;
    justify-content: center;
    z-index: 2;
    padding: 0px 5px 0px 5px;
    color: #333;
}
.wrapper .icon:hover {
    color: #fff;
    background-color: red;
}
.wrapper .icon .tooltip {
    position: absolute;
    bottom: -20px;
    right: 0;
    font-size: xx-small;
    color: #000;
    opacity: 0;
    pointer-events: none;
    transition: all .3s ease;
}
.wrapper .icon:hover .tooltip {
    opacity: 1;
    pointer-events: auto;
}
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

