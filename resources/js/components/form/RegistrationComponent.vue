<template>
    <div class="w-full h-full flex flex-col">
        <div class="flex-1 flex gap-5">
            <!-- row 1 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[70px] flex flex-col">
                    <label class="uppercase text-sm">id</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.school_id" name="school_id">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.school_id" v-for="school_id in message.school_id">{{ school_id }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">first name</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.first_name" name="first_name">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.first_name" v-for="first_name in message.first_name">{{ first_name }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">last name</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.last_name" name="last_name">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.last_name" v-for="last_name in message.last_name">{{ last_name }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="uppercase text-sm">m.i</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.middle_name" name="middle_name">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.middle_name" v-for="middle_name in message.middle_name">{{ middle_name }}</span>
                <!-- error message ends here... -->
            </div>
            <!-- row 2 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">department</label>
                    <select v-model="employee.department" class="h-full bg-gray-200 pl-5 rounded-md" name="department">
                        <option value="" selected>--</option>
                        <option value="BSIT" class="bg-white">IT</option>
                        <option value="BSBA" class="bg-white">BSBA</option>
                    </select>
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.department" v-for="department in message.department">{{ department }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">position</label>
                    <select v-model="employee.position" class="h-full bg-gray-200 pl-5 rounded-md" name="position">
                        <option value="" selected>Select</option>
                        <option value="employee" class="bg-white">Employee</option>
                        <option value="secretary" class="bg-white">Secretary</option>
                        <option value="checker" class="bg-white">Checker</option>
                    </select>
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.position" v-for="position in message.position">{{ position }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">email</label>
                    <input type="email" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.email" name="email">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.email" v-for="email in message.email">{{ email }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">gender</label>
                    <input type="text" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.gender" name="gender">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.gender" v-for="gender in message.gender">{{ gender }}</span>
                <!-- error message ends here... -->
            </div>
            <!-- row 3 -->
            <div class="flex-1 flex flex-col gap-1">
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">password</label>
                    <input type="password" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.password" name="password">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.password" v-for="password in message.password">{{ password }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <label class="capitalize text-sm">confirm password</label>
                    <input type="password" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.password_confirmation" name="confirm_password">
                </div>
                <!-- error message starts here... -->
                <span class="text-xs text-red-500" v-show="message.password_confirmation" v-for="password_confirmation in message.password_confirmation">{{ password_confirmation }}</span>
                <!-- error message ends here... -->
                <div class="h-[70px] flex flex-col">
                    <input type="hidden" class="h-full bg-gray-200 pl-5 rounded-md" v-model="employee.new_user" name="new_user">
                </div>
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
            x: []
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
                // this.error.school_id = res.data.fail[0]
                // for(let x = 0; x < res.data.fail.length; x++) {
                //     console.log(res.data.fail)
                // }
                console.log(res.data)
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