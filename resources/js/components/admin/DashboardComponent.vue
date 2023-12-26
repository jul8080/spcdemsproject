<template>
    <div class="w-full desktop:h-[800px] laptop:h-[800px] flex items-start desktop:gap-5 laptop:gap-1">

        <div class="h-full w-full flex flex-col desktop:gap-2 laptop:gap-1">

            <div class="bg-[#00B0F0] desktop:h-[300px] laptop:h-[200px] flex rounded-md overflow-hidden">
                <div class="flex flex-col items-start justify-between desktop:p-10 laptop:p-7 w-full">
                    <div class="bg-blue-300 rounded-lg px-5 py-2">
                        <span class="text-white text-sm font-semibold">
                            {{ date }}
                        </span>
                    </div>
                    <div class="flex flex-col justify-evenly items-start">
                        <span class="desktop:text-2xl laptop:text-2xl text-white font-semibold flex items-center justify-center gap-1">Good Day,
                            {{ authUser.first_name }} {{ authUser.last_name }}
                            <img src="../../assets/images/party-popper.png" alt="party popper" class="h-7 w-7 object-cover">
                        </span>
                        <span class="desktop:text-sm laptop:text-sm text-white">Have a nice {{ day }}.</span>
                    </div>
                </div>
            </div>
            <!-- overview container starts here... -->
            <div class="over-view-container desktop:h-[200px] laptop:h-[150px] w-full rounded-md grid grid-cols-3 gap-x-3 p-2">
                <div class="bg-blue-300 rounded-md flex flex-col justify-between desktop:p-5 laptop:p-5">
                    <i class="fa-solid fa-users text-white self-end"></i>
                    <div>
                        <span class="block text-white desktop:text-sm laptop:text-xs">Total Employees</span>
                        <span class="block text-white desktop:text-4xl laptop:text-3xl">{{ totalUsers }}</span>
                    </div>
                </div>
                <div class="bg-green-300 rounded-md flex flex-col justify-between desktop:p-5 laptop:p-5">
                    <i class="fa-solid fa-user-plus text-white self-end"></i>
                    <div>
                        <span class="block text-white desktop:text-sm laptop:text-xs">New Employees</span>
                        <span class="block text-white desktop:text-4xl laptop:text-3xl">{{ countedNewUsers ? countedNewUsers : '0' }}</span>
                    </div>
                </div>
                <div class="bg-orange-300 rounded-md flex flex-col justify-between desktop:p-5 laptop:p-5">
                    <i class="fa-solid fa-venus-mars text-white self-end"></i>
                    <div class="flex flex-nowrap">
                        <div class="border-r-[1px] flex-1 flex items-center justify-center flex-col">
                            <span class="block text-white desktop:text-sm laptop:text-xs">Male</span>
                            <span class="block text-white desktop:text-4xl laptop:text-2xl">{{ countedMale ? countedMale : '0' }}</span>
                        </div>
                        <div class="flex-1 flex items-center justify-center flex-col">
                            <span class="block text-white desktop:text-sm laptop:text-xs ">Female</span>
                            <span class="block text-white desktop:text-4xl laptop:text-2xl">{{ countedFemale ? countedFemale : '0' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table container starts here... -->
            <div class="table-container bg-white flex-1 w-full rounded-md desktop:p-5 laptop:p-3 pb-0 flex flex-col items-start justify-evenly">
                <!-- title -->
                <span class="capitalize text-sm mb-5">new employees</span>
                <!-- tabale -->
                <div v-if="newUsers.length > 0" class="h-[300px] w-full bg-gray-200 grid grid-rows-3 justify-items-center items-center p-2 rounded-md">
                    <div v-for="(user, index) in newUsers" :key="index"
                        class="odd:bg-white bg-gray-100 rounded-md w-full h-[92px] flex overflow-hidden p-5">
                        <div class="flex-1 flex flex-col items-center justify-center border-r-[1px] flex-wrap">
                            <span class="block text-gray-400 text-xs">Full name</span>
                            <span class="capitalize laptop:text-xs desktop:text-sm">{{ user.first_name }} {{ user.middle_name[0] }}. {{ user.last_name }}</span>
                        </div>
                        <div class="flex-1 flex flex-col items-center justify-center border-r-[1px] flex-wrap">
                            <span class="block text-gray-400 text-xs">Position</span>
                            <span class="capitalize laptop:text-xs desktop:text-sm">{{ user.position }}</span>
                        </div>
                        <div class="flex-1 flex flex-col items-center justify-center flex-wrap">
                            <span class="block text-gray-400 text-xs">Email</span>
                            <span class="laptop:text-xs desktop:text-sm">{{ user.email }}</span>
                        </div>
                    </div>
                </div>
                <div v-else class="h-[300px] w-full bg-gray-200 flex justify-center items-center flex-col p-2 rounded-md">
                    <i class="fa-solid fa-users text-gray-400 text-2xl"></i>
                    <span class=" text-gray-400">No new users yet.</span>
                </div>
                <!-- pagination -->
                <div v-show="newUsers.length > 0" class="desktop:h-[35px] laptop:h-[35px] w-full flex items-center justify-center">
                    <ButtonComponent @prev-page="getData" @next-page="getData" @last-page="getData" :page="pages"
                        :totalPages="totalPages">
                    </ButtonComponent>
                </div>
            </div>

        </div>

        <!-- search employee starts here... -->
        <div class="search-container bg-white w-[400px] h-full flex flex-col rounded-md overflow-hidden">
            <div class="h-20 flex items-center justify-center desktop:px-10 laptop:px-2 border-b-[1px]">
                <div class="bg-[#f1f1f1] text-white rounded-md w-full h-[50px] flex items-center justify-center px-5 gap-2">
                    <input v-model="search" type="text" placeholder="Search employee"
                        class="h-full w-full bg-[#f1f1f1] rounded-md text-[#000000] outline-none laptop:text-sm">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
            </div>
            <div v-if="dataSearch.length > 0" class="h-full p-2 overflow-y-scroll" id="search-scrollbar">
                <div v-for="(user, index) in dataSearch" :key="index"
                    class="search-content bg-white w-full h-[70px] rounded-md mb-1 flex items-center justify-start p-3 gap-2">
                    <div class="bg-gray-700 desktop:h-[50px] laptop:h-[30px] desktop:w-[50px] laptop:w-[30px] rounded-md flex items-center justify-center">
                        <img v-if="user.image" :src="`/images/${user.image}`" class="h-full w-full object-cover rounded-md">
                        <span v-else class="desktop:text-2xl laptop:text-base text-white font-semibold uppercase">{{ user.first_name[0] }}{{
                            user.last_name[0] }}</span>
                    </div>
                    <div class="flex-1">
                        <span class="capitalize desktop:text-sm laptop:text-xs">{{ user.first_name }} {{ user.middle_name[0] }}. {{ user.last_name
                        }}</span>
                        <div class="flex gap-5">
                            <a :href="`/admin/employee/${user.id}`" class="text-xs text-sky-500 desktop:font-semibold">view</a>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else class="h-full p-2 flex items-center justify-center flex-col">
                <i class="fa-solid fa-magnifying-glass text-3xl text-gray-500"></i>
                <span class="text-sm text-gray-500">No data available.</span>
            </div>
        </div>
        <!-- search employee ends here... -->
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
const checkDay = ref(useDateFormat(useNow(), 'h:m a'))

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
    } catch (e) {
        console.log(e.message)
    }
}
const dataSearch = computed(() => {
    if (search.value) {
        return users.value.filter(
            user => user.first_name.toLowerCase().includes(search.value.toLocaleLowerCase()) ||
                user.middle_name.toLowerCase().includes(search.value.toLocaleLowerCase()) ||
                user.last_name.toLowerCase().includes(search.value.toLocaleLowerCase())
        )
    }

    return users.value
})
const totalUsers = computed(() => {
    return users.value.length > 0 ? users.value.length : 0;
})
const greetUser = computed(() => {
    const  [time, period] = checkDay.value.split(' ')

    if(period == 'am') {
        return 'Good Day'
    } else {
        return 'Good Eve'
    }
})
onMounted(() => {
    getData(pages.value)

    const [ time, period ] = checkDay.value.split(' ')
    const [hour, second] = time.split(':')

})
const location = () => {
    window.location.href = '/admin/employee'
}
</script>

<style scoped>


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