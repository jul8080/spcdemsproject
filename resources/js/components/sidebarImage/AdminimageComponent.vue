<template>
    <div class="bg-slate-700 w-12 lg:w-10 h-12 lg:h-10 rounded-md flex items-center justify-center overflow-hidden shadow">
        <img v-if="user.image !== null" :src="`/images/${user.image}`" class="object-cover  w-full h-full">
        <span v-else class="uppercase text-white font-semibold">{{ user.first_name[0] }}{{ user.last_name[0] }}</span>
    </div>
</template>

<script>
import { ref, onMounted, onUnmounted ,watchEffect } from 'vue';
export default {
    setup() {
        const user = ref({})
        const getImage = async () => {
            try {
                const res = await axios.get('/admin/image');
                user.value = res.data.user
            } catch (err) {
                console.log(err.message)
            }
        }
    
        const stopWatchEffect = watchEffect(() => {
            if(user.value.image) {
                getImage()
            }
        })
        onUnmounted(() => {
            stopWatchEffect();
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