import { ref, watchEffect, watch, onMounted } from 'vue'
const btnWatcher = () => {
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
    const watchEffectFunction = (myButton) => {
        myButton.addEventListener('click', (event) => {
            if (event.target) {
                let stopWatchEffect = watchEffect(() => {
                    if (data.value) {
                        getImage()
                    }
                })
                console.log('button clicked')
            }
        })

    }

    return { watchEffectFunction, getImage, data }
}
export default btnWatcher;



