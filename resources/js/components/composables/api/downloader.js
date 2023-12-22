import convertToCSV from "./convertToCSV";
const downloader = (data) => {
    const csvContent = convertToCSV(data)
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.href = url
    link.setAttribute('download','export.csv');
    link.click();
    console.log(data)
}

export default downloader;