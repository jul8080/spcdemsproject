import convertToCSV from "./convertToCSV";
import randomStringGenerator from "../randomStringGenerator";
const downloader = (data) => {
    const csvContent = convertToCSV(data)
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url
    link.setAttribute('download',`${randomStringGenerator(25)}.csv`);
    link.click();
    console.log(data)
}

export default downloader;