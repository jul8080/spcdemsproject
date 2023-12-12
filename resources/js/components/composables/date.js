const newDate = () => {

    const insertDateHere = (date) => {
        return new Date(date).toISOString().split('T')[0];
    }

    return { insertDateHere }
}
export default newDate;