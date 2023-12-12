import isValidStandardTime from "./check";
import { ref } from 'vue'
const convertToMilitaryTime = () => {
    const militaryTime = ref('')
    const insertToConverter = (data) => {
        if (isValidStandardTime(data)) {
            const [time, period] = data.split(' ');
            const [hours, minutes] = time.split(':').map(Number);
            let militaryHours = hours;
            if (period.toLowerCase() === 'pm' && hours < 12) {
            militaryHours += 12;
            } else if (period.toLowerCase() === 'am' && hours === 12) {
            militaryHours = 0;
            }
    
            const military = `${String(militaryHours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
            militaryTime.value = military;
        } else {
            // Handle invalid input
            console.log('Invalid standard time format. Please enter in the format HH:mm AM/PM.');
        }
    }

    return { insertToConverter, militaryTime }
    
}
export default convertToMilitaryTime;