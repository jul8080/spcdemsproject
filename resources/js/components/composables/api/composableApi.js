import { ref } from 'vue'
const composableApi = (api, startDate, endDate) => {
    const loading = ref(false)
    const logs = ref([])
    const pages = ref(1)
    const totalPages = ref(1)
    const getApiLogs = async (page) => {
        loading.value = true
        try {
            const res = await axios.get(`${api}?page=${page}&beginDate=${startDate}&endDate=${endDate}`)
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