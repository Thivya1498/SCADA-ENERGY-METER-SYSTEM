var lineChart; // Global variable to store the chart instance

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
    xhr.open("GET", "fetch_data_powerquality.php?customer_serial_number=" + selectedEnergyMeterId + "&date=" + selectedDate + "&datatype=" + selectedDataType, true);
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

    if (selectedDataType === 'Power Factor') {
        chartYValues.push(tableData.map(function (row) {
            return row["PF"];
        }));
       // chartYValues.push(tableData.map(function (row) {
       //     return row["L2"];
       // }));
       // chartYValues.push(tableData.map(function (row) {
       //     return row["L3"];
       // }));
        legendLabels = ["PF"];
    } else if (selectedDataType === 'Total Hormanic Distortion [THD U]') {
        chartYValues.push(tableData.map(function (row) {
            return row["THD_L1"];
        }));
        chartYValues.push(tableData.map(function (row) {
            return row["THD_L2"];
        }));
        chartYValues.push(tableData.map(function (row) {
            return row["THD_L3"];
        }));
        legendLabels = ["THD_L1", "THD_L2", "THD_L3"];

    } else if (selectedDataType === 'Total Hormanic Current [THD I]') {
    chartYValues.push(tableData.map(function (row) {
        return row["THD_L1"];
    }));
    chartYValues.push(tableData.map(function (row) {
        return row["THD_L2"];
    }));
    chartYValues.push(tableData.map(function (row) {
        return row["THD_L3"];
    }));
    chartYValues.push(tableData.map(function (row) {
        return row["THD_N"]; // Include THD_N data
    }));
    legendLabels = ["THD_L1", "THD_L2", "THD_L3", "THD_N"];
    }

    // Remove the existing chart if it exists
    // if (lineChart) {
    //     lineChart.destroy();
    // }

    var seriesData = [];  // This array will store the dataset for Highcharts.

    for (let i = 0; i < legendLabels.length; i++) {
        seriesData.push({
            name: legendLabels[i],
            data: chartYValues[i]
        });
    }

    // Now we use Highcharts to render the graph:
    Highcharts.chart('chartContainer', {
    chart: {
        type: 'line',
        backgroundColor: '#111C44'
    },
    title: {
        text: selectedDataType,
        style: {
            color: '#FFFFFF'  // Set title color to white
        }
    },
    xAxis: {
        categories: chartXValues,
        title: {
            text: 'Time',
            style: {
                color: '#FFFFFF'  // Set x-axis title color to white
            }
        },
        labels: {
            style: {
                color: '#FFFFFF'  // Set x-axis labels color to white
            }
        }
    },
    yAxis: {
        title: {
            text: selectedDataType,
            style: {
                color: '#FFFFFF'  // Set y-axis title color to white
            }
        },
        labels: {
            style: {
                color: '#FFFFFF'  // Set y-axis labels color to white
            }
        }
    },
    series: seriesData,  
    legend: {
        itemStyle: {
            color: '#f2f2f2'
        }
    },
    tooltip: {
        backgroundColor: '#111C44',
        style: {
            color: '#f2f2f2'
        }
    }
});
}

fetchData();