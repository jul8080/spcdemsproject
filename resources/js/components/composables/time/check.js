const isValidStandardTime = (time) =>{
    // Simple validation for HH:mm AM/PM format
    const timeRegex = /^(0[1-9]|1[0-2]):[0-5][0-9] (AM|PM)$/i;
    return timeRegex.test(time);
}
export default isValidStandardTime;