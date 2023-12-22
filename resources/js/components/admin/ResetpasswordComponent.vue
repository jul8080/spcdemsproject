<template>
    <div class="w-full h-full flex items-center justify-center">
        <div class="form-container bg-white w-[500px] h-[300px] rounded-md p-5 relative flex flex-col">
            <span class="text-2xl">Forgot Password</span>
            <form @submit.prevent="confirmEmail" class="flex flex-col mt-5">
                <div class="flex flex-col">
                    <label>E-Mail Address</label>
                    <input 
                    class="bg-[#f1f1f1] py-3 px-2 rounded-md focus:outline-blue-400"
                    type="email" placeholder="Enter user email" v-model="email">
                </div>
                <div class="flex">
                    <span class="text-sm text-red-500" v-show="message" >{{ message }}</span>
                </div>
                <button class="py-3 px bg-blue-500 text-white text-sm rounded-md mt-2">Reset Password</button>
            </form>
            <span class="blocl text-xs font-semibold text-center mt-10 text-gray-400">Please enter a valid email before submitting.</span>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const email = ref('')
const message = ref(null)
const confirmEmail = async () => {
    try {
        const res = await axios.post('/admin/confirm-email', { 'email': email.value });
        if(res.data.success) {

            window.location.href = `/admin/user/new-password/${res.data.user.id}`
            // console.log(res.data.success)
        }
        message.value = res.data.message
        setTimeout(() =>  message.value = null, 5000)
    } catch (e) {
        if(e.response.status) {
            message.value = e.response.data.message
            setTimeout(() =>  message.value = null, 5000)
        }
    }
}
</script>

<style scoped>
.form-container {
    box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}
</style>