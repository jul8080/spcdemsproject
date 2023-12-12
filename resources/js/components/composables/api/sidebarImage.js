import { ref, watchEffect } from 'vue'

const sidebarImage = () => {
    const data = ref({})
    const getImage = async () => {
        try {
            const res = await axios.get('/admin/image');
            data.value = res.data.user
            console.log(data.value)
        } catch (err) {
            console.log(err.message)
        }
    }
    const startRunning = () => {
        const stopWatchEffect = watchEffect(() => {
            if (data.value.image) {
                getImage()
            }
        })
    }
    return { getImage, data, startRunning }
}

export default sidebarImage