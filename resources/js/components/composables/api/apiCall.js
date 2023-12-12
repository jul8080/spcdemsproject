import downloader from "./downloader"
const apiCall = (result) => {
    axios.get('/admin/user/logs-csve-xport', { params: { date: result } })
        .then(res => {
            const data = res.data.logs.map(x => {
                const logs = {
                    last_name: x.last_name,
                    first_name: x.first_name,
                    middle_name: x.middle_name,
                    time_in: x.time_in,
                    time_out: x.time_out,
                    day: x.day,
                    date: new Date(x.created_at).toISOString().split('T')[0]
                }
                return logs
            })
            downloader(data)
        })
        .catch(err => {
            console.log(err.message)
        })
}
export default apiCall;