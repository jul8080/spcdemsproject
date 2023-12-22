<template>
    <div class="w-full h-full flex flex-col gap-10">

        <!-- form success message starts here. -->
        <div v-show="success" class="bg-green-300 w-full h-16 rounded-md flex items-center justify-center">
            <span class="text-white font-semibold">{{ success }}</span>
        </div>
        <!-- form success message ends here. -->

        <div class="h-full w-full flex flex-wrap desktop:gap-5 laptop:gap-2">
            <!-- row 1 -->
            <div class="flex-1 flex flex-col gap-1">

                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">first name</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" v-model="employee.first_name" name="first_name">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.first_name" v-for="first_name in message.first_name">{{ first_name }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">last name</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" v-model="employee.last_name" name="last_name">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.last_name" v-for="last_name in message.last_name">{{ last_name }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="uppercase text-sm">m.i</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" v-model="employee.middle_name" name="middle_name">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.middle_name" v-for="middle_name in message.middle_name">{{ middle_name }}</span>
                <!-- error message ends here... -->
            </div>
            <!-- row 2 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">position</label>
                    <select v-model="employee.position" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" name="position">
                        <option value="" selected>Select</option>
                        <option value="employee" class="bg-white laptop:text-xs desktop:text-sm">Employee</option>
                        <option value="secretary" class="bg-white laptop:text-xs desktop:text-sm">Secretary</option>
                        <option value="checker" class="bg-white laptop:text-xs desktop:text-sm">Checker</option>
                    </select>
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.position" v-for="position in message.position">{{ position }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">email</label>
                    <input type="email" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" v-model="employee.email" name="email">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.email" v-for="email in message.email">{{ email }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm laptop:text-xs desktop:text-sm">gender</label>
                    <select v-model="employee.gender" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" name="gender">
                        <option value="" selected>Select</option>
                        <option value="male" class="bg-white laptop:text-xs desktop:text-sm">Male</option>
                        <option value="female" class="bg-white laptop:text-xs desktop:text-sm">Female</option>
                    </select>
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.gender" v-for="gender in message.gender">{{ gender }}</span>
                <!-- error message ends here... -->
            </div>
            <!-- row 3 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">password</label>
                    <input type="password" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" v-model="employee.password" name="password">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.password" v-for="password in message.password">{{ password }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">confirm password</label>
                    <input type="password" class="h-full bg-gray-200 pl-5 rounded-md laptop:text-xs desktop:text-sm focus:outline-blue-500" v-model="employee.password_confirmation" name="confirm_password">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.password_confirmation" v-for="password_confirmation in message.password_confirmation">{{ password_confirmation }}</span>
                <!-- error message ends here... -->
       
            </div>

        </div>
        <div class="h-14 flex justify-end items-start gap-3">
            <button @click="closeModal" class="bg-slate-200 text-gray-400 px-5 py-2 font-semibold rounded-md capitalize text-sm">cancel</button>
            <button 
            @click="saveData"
            class="bg-[#00B0F0] text-white px-5 py-2 font-semibold capitalize relative rounded-md text-sm" 
            :class="{'is_loading':processing, 'bg-gray-200':processing}"
            :disabled="processing">register</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['date'],
    data() {
        return {
            processing: false,
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
            },
            message: {
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
            },
            success: ''
        }
    },
    mounted() {},
    methods: {
        closeModal() {
            this.$emit('close')
        },
        getAllUsers() {
            this.$emit('get-api')
        },
        async saveData() {
            this.processing = true
            try {
                const res = await axios.post("/admin/create/employee", this.employee)
                if(res.data.status === 200) {
                    this.employee.new_user = ''
                    this.employee.school_id = ''
                    this.employee. first_name = ''
                    this.employee.last_name = ''
                    this.employee.middle_name = ''
                    this.employee.department = ''
                    this.employee.position = ''
                    this.employee.email = ''
                    this.employee.gender = ''
                    this.employee.password = ''
                    this.employee.password_confirmation = ''
                    this.success = res.data.message
                    setTimeout(() => {
                        this.success = ''
                    },3000)
                    console.log(res.data.message)
                }
            } catch(error) {
                if (error.response.status === 422) {
                    this.message.school_id = error.response.data.errors.school_id
                    this.message.first_name = error.response.data.errors.first_name
                    this.message.last_name = error.response.data.errors.last_name
                    this.message.middle_name = error.response.data.errors.middle_name
                    this.message.department = error.response.data.errors.department
                    this.message.position = error.response.data.errors.position
                    this.message.email = error.response.data.errors.email
                    this.message.gender = error.response.data.errors.gender
                    this.message.password = error.response.data.errors.password
                    this.message.password_confirmation = error.response.data.errors.password_confirmation
                    setTimeout(() => {
                        this.message.school_id = ''
                        this.message.first_name = ''
                        this.message.last_name = ''
                        this.message.middle_name = ''
                        this.message.department = ''
                        this.message.position = ''
                        this.message.email = ''
                        this.message.gender = ''
                        this.message.password = ''
                        this.message.password_confirmation = ''
                    },5000)
                    console.log(error.response.data)
                }
            } finally {
                this.processing = false
                this.getAllUsers()
            }
        }
    }
}
</script>

<style scoped>
 .is_loading {
    color: transparent;
 }
 .is_loading:before {
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
    @keyframes spinner {
      to {transform: rotate(360deg);}
    }
</style>