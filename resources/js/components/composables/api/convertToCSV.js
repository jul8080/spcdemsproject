const convertToCSV = (data) => {
    const headers = Object.keys(data[0])
    const rows = data.map(obj => headers.map(header => obj[header]))
    const headerRow = headers.join(',')
    const csvRows = [headerRow, ...rows.map(row => row.join(','))]
    return csvRows.join('\n')
}

export default convertToCSV;