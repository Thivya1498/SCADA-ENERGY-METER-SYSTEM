var chart; // Global variable to store the chart instance

// Function to fetch data, called on page load and when the "View Data" button is clicked
function fetchData() {
    var selectedEnergyMeterId = document.getElementById("customer_serial_number").value;
    var selectedDate = document.getElementById("date").value;
    var selectedDataType = document.getElementById("datatype").value;

    // Check if the date input is empty, and if so, set it to the current date
    if (selectedDate === "") {
        var currentDate = new Date();
        var day = String(currentDate.getDate()).padStart(2, '0');
        var month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Month is 0-based
        var year = currentDate.getFullYear();
        selectedDate = year + '-' + month + '-' + day;
        document.getElementById("date").value = selectedDate; // Update the date input field
    }

    // AJAX request to fetch data
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            document.getElementById("dataContainer").innerHTML = response;
            document.getElementById("dataInfo").textContent = "Energy Meter ID: " + selectedEnergyMeterId + ", Date: " + selectedDate + ", Data Type: " + selectedDataType;

            // Extract data from the table and generate the chart
            extractDataAndGenerateChart(selectedDataType);
        }
    };

    // Modify the URL to include the selected date
    xhr.open("GET", "fetch_data.php?customer_serial_number=" + selectedEnergyMeterId + "&date=" + selectedDate + "&datatype=" + selectedDataType, true);
    xhr.send();
}

function extractDataAndGenerateChart(selectedDataType) {
    // Extracting data from the table
    var table = document.querySelector("table");
    var tableData = [];
    var headers = [];
    var rows = table.querySelectorAll("tr");

    // Extract table headers
    var headerCells = rows[0].querySelectorAll("th");
    for (var i = 0; i < headerCells.length; i++) {
        headers.push(headerCells[i].textContent);
    }

    // Extract table rows
    for (var i = 1; i < rows.length; i++) {
        var rowData = {};
        var cells = rows[i].querySelectorAll("td");
        for (var j = 0; j < cells.length; j++) {
            var parameter = headers[j];
            var value = parseFloat(cells[j].textContent);
            rowData[parameter] = value;
        }
        tableData.push(rowData);
    }

    // Extract X values (time) from the table data
    var chartXValues = tableData.map(function (row) {
        return row["Last Update"];
    });

    // Extract Y values based on the selected data type
    var chartYValues = [];
    var legendLabels = [];

if (selectedDataType === 'Voltage Line to Neutral [V]') {
chartYValues.push(tableData.map(function (row) {
    return row["L1"];
}));
chartYValues.push(tableData.map(function (row) {
    return row["L2"];
}));
chartYValues.push(tableData.map(function (row) {
    return row["L3"];
}));
legendLabels = ["L1", "L2", "L3"];

} else if (selectedDataType === 'Voltage Line to Line [V]') {
chartYValues.push(tableData.map(function (row) {
    return row["L12"];
}));
chartYValues.push(tableData.map(function (row) {
    return row["L32"];
}));
chartYValues.push(tableData.map(function (row) {
    return row["L13"];
}));
legendLabels = ["L12", "L32", "L13"];

} else if (selectedDataType === 'Current [A]') {
chartYValues.push(tableData.map(function (row) {
    return row["I1"];
}));
chartYValues.push(tableData.map(function (row) {
    return row["I2"];
}));
chartYValues.push(tableData.map(function (row) {
    return row["I3"];
}));
legendLabels = ["I1", "I2", "I3"];

}else if (selectedDataType === 'Active Power') {
chartYValues.push(tableData.map(function (row) {
return row["A_P_L1"];  // This assumes there's a column named "ActivePower" in your table.
}));
chartYValues.push(tableData.map(function (row) {
return row["A_P_L2"];  // This assumes there's a column named "ActivePower" in your table.
}));
chartYValues.push(tableData.map(function (row) {
return row["A_P_L3"];  // This assumes there's a column named "ActivePower" in your table.
}));
legendLabels = ["A_P_L1", "A_P_L2", "A_P_L3"];

}else if (selectedDataType === 'Apparent Power') {
chartYValues.push(tableData.map(function (row) {
return row["App_P_L1"];  // This assumes there's a column named "ActivePower" in your table.
}));
chartYValues.push(tableData.map(function (row) {
return row["App_P_L2"];  // This assumes there's a column named "ActivePower" in your table.
}));
chartYValues.push(tableData.map(function (row) {
return row["App_P_L3"];  // This assumes there's a column named "ActivePower" in your table.
}));
legendLabels = ["App_P_L1","App_P_L4","App_P_L3"];

}else if (selectedDataType === 'Reactive Power [var]') {
chartYValues.push(tableData.map(function (row) {
return row["R_P_L1"];  // This assumes there's a column named "ActivePower" in your table.
}));
chartYValues.push(tableData.map(function (row) {
return row["R_P_L2"];  // This assumes there's a column named "ActivePower" in your table.
}));
chartYValues.push(tableData.map(function (row) {
return row["R_P_L3"];  // This assumes there's a column named "ActivePower" in your table.
}));
legendLabels = ["R_P_L1","R_P_L2","R_P_L3"];
}


    // Remove the existing chart if it exists
    if (chart) {
        chart.destroy();
    }

    // Create the Highcharts chart with the specified background color
    chart = Highcharts.chart('chartContainer', {
        chart: {
            type: 'line',
            backgroundColor: '#111C44' // Set the background color here
        },
        title: {
            text: 'Energy Meter Data',
            style: {
                color: '#f2f2f2' // Font color for the chart title
            }
        },
        
        xAxis: {
            type: 'category', // Use 'category' scale for X-axis
            categories: chartXValues,
            title: {
                display: true,
                text: 'Time',
                style: {
                    color: '#f2f2f2' // Font color for the X-axis title
                }
            },
            labels: {
                style: {
                    color: '#f2f2f2' // Font color for X-axis labels
                }
            }
        },
        yAxis: {
            title: {
                text: selectedDataType,
                style: {
                    color: '#f2f2f2' // Font color for the Y-axis title
                }
            },
            labels: {
                style: {
                    color: '#f2f2f2' // Font color for Y-axis labels
                }
            }
        },
        legend: {
            itemStyle: {
                color: '#f2f2f2', // Font color for legend items
                backgroundColor : '#72A0C1'
            }
        },
        tooltip: {
        backgroundColor: 'rgba(17, 28, 68, 0.9)', // Transparent background
        borderWidth: 0, // No border
        shadow: false, // No shadow
        style: {
        color: '#f2f2f2' // Font color for tooltip text
}
},
        series: []
    });

    // Add series data
    for (var i = 0; i < chartYValues.length; i++) {
        chart.addSeries({
            name: legendLabels[i],
            data: chartYValues[i]
        });
    }
}

// Trigger fetchData function on page load
fetchData();