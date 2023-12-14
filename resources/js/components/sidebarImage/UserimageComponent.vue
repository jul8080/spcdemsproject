<template>
    <div class="bg-slate-700 w-12 h-12 rounded-md flex items-center justify-center shadow overflow-hidden">
        <img v-if="user.image !== null" :src="`/images/${user.image}`" class="object-cover  w-full h-full">
        <span v-else class="uppercase text-white font-semibold">{{ user.first_name[0] }}{{ user.last_name[0] }}</span>
    </div>
</template>

<script>
import { ref, onMounted,onUnmounted, watch } from 'vue';
export default {
    setup() {

        const user = ref({})
     
        const getImage = async () => {
            try {
                const res = await axios.get('/user/image');
                user.value = res.data.user
            } catch (err) {
                console.log(err.message)
            }
        }

        const stopWatching = watch(user, () => {
            getImage()
        }, { immediate: true });

       onUnmounted(() => {
            stopWatching();
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