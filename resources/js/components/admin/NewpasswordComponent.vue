<template>
    <div class="w-full h-full flex items-center justify-center">
        <div class="form-container bg-white w-[500px] rounded-md p-5 relative flex flex-col items-start justify-center">
            <span class="text-2xl">Reset Password</span>
            <form @submit.prevent="submitHandler" class="flex flex-col w-full gap-2 mt-5">
                <div class="flex flex-col">
                    <label>New Password</label>
                    <input class="bg-[#f1f1f1] py-3 px-2 rounded-md focus:outline-blue-400" type="password"
                        placeholder="Enter new password" v-model="form.password">
                </div>

                <div class="flex flex-col">
                    <span class="text-sm text-red-500" v-show="error.password" v-for="(password, index) in error.password"
                        :key="index">{{ password }}</span>
                </div>

                <div class="flex flex-col">
                    <label>Confirm Password</label>
                    <input class="bg-[#f1f1f1] py-3 px-2 rounded-md focus:outline-blue-400" type="password"
                        placeholder="Enter confirm password" v-model="form.password_confirmation">
                </div>

                <div class="flex">
                    <span class="text-sm text-red-500" v-show="error.password_confirmation"
                        v-for="(password_confirmation, index) in error.password_confirmation" :key="index">{{ password_confirmation
                        }}</span>
                </div>

                <button class="py-3 px bg-blue-500 text-white text-sm rounded-md">Submit</button>
            </form>

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps(['userId'])
const form = ref({ id: props.userId, password: '', password_confirmation: '' })
const error = ref({ password: null, password_confirmation: null })
const submitHandler = async () => {
    try {
        const res = await axios.post('/admin/update/user-password', form.value)
        if(res.data.message) {
            window.location.href = '/admin/dashboard'
        }
        console.log(res.data.message)
    } catch (e) {
        if (e.response.status === 422) {
            error.value.password = e.response.data.errors.password
            error.value.password_confirmation = e.response.data.errors.password_confirmation
            setTimeout(() => {
                error.value.password = ''
                error.value.password_confirmation = ''
            }, 5000)
        }
    }
}
</script>

<style scoped>
.form-container {
    box-shadow: 0 0 5px rgba(0, 0, 0, .3);
}
</style>
