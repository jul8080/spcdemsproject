<template>
    <div class="w-full h-[800px] flex items-start gap-5 lg:h-[650px]">

        <div class="h-full w-full flex flex-col gap-2">
            <div class="bg-[#00B0F0] h-[350px] flex rounded-md lg:h-[180px]">
                <div class="h-full flex flex-col justify-between items-start p-10">
                    <div class="bg-blue-300 rounded-lg px-5 py-2 lg:px-4 lg:py-1 lg:mb-10">
                        <span class="text-white text-sm font-semibold lg:text-xs">
                            {{ date }}
                        </span>
                    </div>
                    <div class="flex flex-col justify-evenly items-start">
                        <span class="text-2xl text-white font-semibold flex items-center justify-center gap-1 lg:text-lg">Good Day, 
                            {{ authUser.last_name }} {{ authUser.first_name }} {{ authUser.middle_name }}
                            <img src="../../assets/images/party-popper.png" alt="party popper" class="h-7 w-7 object-cover">
                        </span>
                        <span class="text-sm text-white lg:text-xs lg:mt-2">Have a nice {{ day }}.</span>
                    </div>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <!-- <div class="bg-green-500 p-5 rounded-md">
                        <span class="text-white text-5xl">{{formatted}}</span>
                    </div> -->
                    <!-- <img src="../../assets/images/party-popper.png" alt="party popper" class="h-28 w-28 object-cover -rotate-90"> -->
                </div>
            </div>


            <div class="h-full flex justify-between flex-col gap-2">
                <div class="over-view-container h-40 lg:h-28 bg-white flex px-5 py-2 gap-5 rounded-md">
                    <div class="flex-1 bg-blue-500 rounded-md flex flex-col">
                        <div class="text-right px-3 py-1">
                            <i class="fa-solid fa-users text-white"></i>
                        </div>
                        <div class="flex-1 flex px-10">
                            <div class="flex-1 flex flex-col items-start justify-center">
                                <span class="text-sm lg:text-xs text-white">Total Employees</span>
                                <span class="text-5xl lg:text-3xl text-white font-semibold">{{ users.length }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 bg-green-500 rounded-md flex flex-col">
                        <div class="text-right px-3 py-1">
                            <i class="fa-solid fa-user-plus text-white"></i>
                        </div>
                        <div class="flex-1 flex px-10">
                            <div class="flex-1 flex flex-col items-start justify-center">
                                <span class="text-sm lg:text-xs text-white">New Employees</span>
                                <span  class="text-5xl lg:text-3xl text-white font-semibold">{{ countedNewUsers !== null ? countedNewUsers : 0  }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 bg-orange-500 rounded-md flex flex-col">
                        <div class="text-right px-3 py-1">
                            <i class="fa-solid fa-venus-mars text-white"></i>
                        </div>
                        <div class="flex-1 flex py-5 lg:py-0">
                            <div class="flex-1 flex flex-col items-center justify-center border-r-[1px] border-white">
                                <span class="text-sm lg:text-xs text-white">Male</span>
                                <span class="text-4xl lg:text-2xl text-white font-semibold">{{ countedMale !== null ? countedMale : 0}}</span>
                            </div>
                            <div class="flex-1 flex flex-col items-center justify-center">
                                <span class="text-sm lg:text-xs text-white">Female</span>
                                <span class="text-4xl lg:text-2xl text-white font-semibold">{{ countedFemale !== null ? countedFemale : 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-container bg-white flex flex-col justify-between gap-2 p-5 h-full lg:h-full rounded-md">
                    <span>New Employees</span>
                    <div v-if="newUsers.length > 0" class="newusers-container-table w-full bg-gray-100 p-3 lg:p-2 rounded-md">
                        <div
                            v-for="(users, index) in newUsers" :key="index"
                            class="bg-white w-full h-20 lg:h-[64px] rounded-md flex flex-row gap-2 items-start justify-center p-5 mb-1">
                            <div class="flex flex-col flex-1 border-r-2">
                                <span class="text-xs text-gray-300 font-semibold">Full Name</span>
                                <span class="capitalize lg:text-sm">{{ users.last_name }} {{ users.first_name}} {{ users.middle_name[0] }}.</span>
                            </div>
                            <div class="flex flex-col flex-1 border-r-2">
                                <span class="text-xs text-gray-300 font-semibold">Gender</span>
                                <span class="capitalize lg:text-sm">{{ users.gender }}</span>
                            </div>
                            <div class="flex flex-col flex-1">
                                <span class="text-xs text-gray-300 font-semibold">Position</span>
                                <span class="capitalize lg:text-sm">{{ users.position }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-else class="newusers-container-table w-full bg-gray-100 p-3 rounded-md flex flex-col justify-center items-center">
                        <i class="fa-solid fa-users text-gray-500 text-lg"></i>
                        <span class="text-gray-500 text-lg">No New Users Yet.</span>
                    </div>
                    <!-- pagination starts here... -->
                    <div class="h-10 lg:h-5 w-full flex items-center justify-center">
                        <ButtonComponent @prev-page="getData" @next-page="getData" @last-page="getData" :page="pages"
                            :totalPages="totalPages">
                        </ButtonComponent>
                    </div>
                    <!-- pagination ends here... -->
                </div>
            </div>

        </div>

        <div class="search-container bg-white w-[500px] lg:w-[400px] h-full flex flex-col rounded-md">
            <div class="h-20 flex items-center justify-center px-10">
                <div class="bg-[#f1f1f1] text-white rounded-md w-full h-[50px] lg:h-[40px] flex items-center justify-center px-2 gap-2">
                    <input v-model="search" type="text" placeholder="Search employee"
                        class="h-full w-full bg-[#f1f1f1] rounded-md text-[#000000] outline-none lg:text-sm">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>

            </div>
            <div class="h-full p-2 overflow-y-scroll" id="search-scrollbar">
                <div 
                    v-for="(user, index) in dataSearch" :key="index"
                    class="search-content bg-white w-full h-20 lg:h-16 rounded-md mb-1 flex items-center justify-start p-3 gap-2">
                    <div class="bg-gray-700 h-[70px] lg:h-[50px] w-[70px] lg:w-[50px] rounded-md flex items-center justify-center">
                        <img v-if="user.image" :src="`/images/${user.image}`" class="h-full w-full object-cover rounded-md">
                        <span v-else class="text-2xl lg:text-base text-white font-semibold uppercase">{{ user.first_name[0] }}{{ user.last_name[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="capitalize text-sm lg:text-xs">{{ user.first_name }} {{ user.middle_name[0] }}. {{ user.last_name }}</span>
                        <div class="flex gap-5">
                            <a :href="`/admin/employee/${user.id}`" class="text-xs text-sky-500 font-semibold">view</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import ButtonComponent from '../helpers/ButtonComponent.vue'
import { useNow, useDateFormat } from '@vueuse/core'

const search = ref('')
const users = ref([])
const authUser = ref({})
const newUsers = ref([])
const countedMale = ref(0)
const countedFemale = ref(0)
const countedNewUsers = ref(0)
const pages = ref(1)
const totalPages = ref(1)
const day = ref(useDateFormat(useNow(), 'dddd'))
const date = ref(useDateFormat(useNow(), 'MMMM D, YYYY'))
const formatter = ref('HH:mm:ss A')
const formatted = useDateFormat(useNow(), formatter)

const getData = async (page) => {
    try {
         const res = await axios.get(`/admin/user-data/dashboard?page=${page}`)
         users.value = res.data.users;
         authUser.value = res.data.auth;
         countedMale.value = res.data.maleCount;
         countedFemale.value = res.data.femaleCount;
         countedNewUsers.value = res.data.countNewUsers;
         newUsers.value = res.data.newUsers.data;
         pages.value = res.data.newUsers.current_page;
         totalPages.value = res.data.newUsers.last_page;
         console.log(res.data.femaleCount);
    } catch(e) {
        console.log(e.message)
    }
}
const dataSearch = computed(() => {
    if(search.value) {
        return users.value.filter(
            user => user.first_name.toLowerCase().includes(search.value.toLocaleLowerCase()) || 
            user.middle_name.toLowerCase().includes(search.value.toLocaleLowerCase()) ||
            user.last_name.toLowerCase().includes(search.value.toLocaleLowerCase())
        )
    }

     return users.value
})

onMounted(() => {
    console.log(date.value)
    getData(pages.value)
})
const location = () => {
    window.location.href = '/admin/employee'
}
</script>

<style scoped>
.newusers-container-table {
    height: calc(100% - 95px);
}
.search-content,
.search-container,
.table-container,
.over-view-container {
    box-shadow: 0 0 3px rgba(0, 0, 0, .3);
}

#search-scrollbar::-webkit-scrollbar {
    width: .5vw;
    background-color: #f3f4f6;
}

#search-scrollbar::-webkit-scrollbar-thumb {
    background: #d1d5db;
}

#search-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}
</style>