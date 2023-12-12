<template>
    <div class="bg-slate-700 w-12 h-12 rounded-md flex items-center justify-center shadow">
        <img v-if="user" :src="`/images/${user.image}`" class="object-cover  w-full h-full rounded-md">
        <img v-else src="" class="object-cover  w-full h-full rounded-md">
    </div>
</template>

<script>
import { ref, onMounted,onUnmounted, onBeforeUnmount, watchEffect } from 'vue';
export default {
    setup() {
        const user = ref({})
        const getImage = async () => {
            try {
                const res = await axios.get('/admin/image');
                user.value = res.data.user
                // console.log(user.value)
            } catch (err) {
                console.log(err.message)
            }
        }
    
        const stopWatchEffect = watchEffect(() => {
            if(user.value.image) {
                getImage()
            }
        })
        onMounted(() => {
            getImage()
        })

        return {
            user,
        }
    }
}
</script>

<style scoped></style>
<!-- @if (Auth::user()->image != '')
@else
    <div class="bg-slate-700 w-12 h-12 rounded-md flex items-center justify-center">
        <span class="text-white font-sans uppercase text-3xl font-bold">{{ substr(Auth::user()->first_name, 0, 1) }}</span>
    </div>
@endif -->

<!-- <div class="bg-slate-700 w-12 h-12 rounded-md flex items-center justify-center shadow">
    <img src="{{ asset('images/'.Auth::user()->image) }}" class="object-cover  w-full h-full rounded-md">
</div> -->