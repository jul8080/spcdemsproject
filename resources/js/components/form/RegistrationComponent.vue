<template>
    <form @submit.prevent="saveData" class="w-full h-full flex flex-col">
        <div class="flex-1 flex gap-5">
            <!-- row 1 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[75px] flex flex-col">
                    <label class="uppercase">id</label>
                    <input type="text" class="h-full bg-slate-400 pl-5" v-model="employee.school_id" name="school_id">
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">first name</label>
                    <input type="text" class="h-full bg-slate-400 pl-5" v-model="employee.first_name" name="first_name">
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">last name</label>
                    <input type="text" class="h-full bg-slate-400 pl-5" v-model="employee.last_name" name="last_name">
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="uppercase">m.i</label>
                    <input type="text" class="h-full bg-slate-400 pl-5" v-model="employee.middle_name" name="middle_name">
                </div>
            </div>
            <!-- row 2 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">department</label>
                    <select v-model="employee.department" class="h-full bg-slate-400 pl-5" name="department">
                        <option value="BSIT" class="bg-white">IT</option>
                        <option value="BSBA" class="bg-white">BSBA</option>
                    </select>
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">position</label>
                    <select v-model="employee.position" class="h-full bg-slate-400 pl-5" name="position">
                        <option value="position 1" class="bg-white">position 1</option>
                        <option value="position 2" class="bg-white">position 2</option>
                    </select>
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">email</label>
                    <input type="email" class="h-full bg-slate-400 pl-5" v-model="employee.email" name="email">
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">gender</label>
                    <input type="text" class="h-full bg-slate-400 pl-5" v-model="employee.gender" name="gender">
                </div>
            </div>
            <!-- row 3 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">password</label>
                    <input type="password" class="h-full bg-slate-400 pl-5" v-model="employee.password" name="password">
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">confirm password</label>
                    <input type="password" class="h-full bg-slate-400 pl-5" v-model="employee.password_confirmation" name="confirm_password">
                </div>
                <div class="h-[75px] flex flex-col">
                    <label class="capitalize">new user</label>
                    <input type="text" class="h-full bg-slate-400 pl-5" v-model="employee.new_user" name="new_user">
                </div>
            </div>

        </div>
        <div class="h-14 flex justify-end items-start gap-3">
            <button @click="closeModal" class="bg-slate-300 text-slate-500 px-5 py-1 font-semibold capitalize ">cancel</button>
            <button @click="" class="bg-[#00B0F0] text-white px-5 py-1 font-semibold capitalize ">register</button>
        </div>
    </form>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue'
export default {
    props: ['date'],
    data() {
        return {
            employee: {
                new_user: this.date,
                school_id: '',
                first_name: '',
                last_name: '',
                middle_name: '',
                department: '',
                position: '',
                email: '',
                gender: '',
                password: '',
                password_confirmation: '',
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close')
        },
        saveData() {
            axios.post("/admin/create/employee", this.employee)
                .then(res => {
                    console.log(res.data)
                })
                .catch(err => {
                    console.log(err.message)
                })
        }
    }
    // setup(porps, { emit }) {
    //     const closeModal = () => {
    //         emit('close')
    //     }
   
    //     return { closeModal }
    // }
}
</script>

<style scoped></style>