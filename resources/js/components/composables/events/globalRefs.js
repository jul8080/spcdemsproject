import { ref } from 'vue'
const globalRefs = () => {
    let btnEvent = null
    const insertValue = (value) => {
        btnEvent = value
    }
    return { insertValue, btnEvent }
}
 export default  globalRefs;