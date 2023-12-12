import { ref } from 'vue'
const composableApi = (filter) => {
    const loading = ref(false)
    const logs = ref([])
    const pages = ref(1)
    const totalPages = ref(1)
    const getApiLogs = async (page) => {
        loading.value = true
        try {
            const res = await axios.get(`/admin/api-logs?page=${page}&filter=${filter.day}&date=${filter.date}`)
            logs.value = res.data.attendance.data
            pages.value = res.data.attendance.current_page
            totalPages.value = res.data.attendance.last_page
            console.log(res.data)
        } catch (error) {
            console.log(error)
        } finally {
            loading.value = false
            console.log('Done fetching!')
        }
    }
    return { getApiLogs, loading, pages, totalPages, logs }
}
export default composableApi;