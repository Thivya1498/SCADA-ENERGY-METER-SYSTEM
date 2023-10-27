// Add this function to set the current date as the default value
function setDefaultDate() {
    var currentDate = new Date();
    var day = String(currentDate.getDate()).padStart(2, '0');
    var month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Month is 0-based
    var year = currentDate.getFullYear();
    var formattedDate = year + '-' + month + '-' + day;
    document.getElementById("date").value = formattedDate; // Set the date input field
}

// Call the function when the page loads
window.onload = function () {
    setDefaultDate();
    fetchData(); // Call fetchData to initially load data for the default date
};

// Function to fetch data, called on button click
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

            // Filter out the specific data from the response
            response = filterSpecificData(response, selectedEnergyMeterId, selectedDate, selectedDataType);

            document.getElementById("dataContainer").innerHTML = response;
        }
    };

    // Modify the URL to include the selected date
    xhr.open("GET", "fetch_data_datatable.php?customer_serial_number=" + selectedEnergyMeterId + "&date=" + selectedDate + "&datatype=" + selectedDataType, true);
    xhr.send();
}

// Function to filter out specific data from the response
function filterSpecificData(response, energyMeterId, date, dataType) {
    // Split the response into lines
    var lines = response.split('\n');
    
    // Create a new array to store filtered lines
    var filteredLines = [];

    // Flag to determine whether to include a line or not
    var includeLine = true;

    // Iterate through lines and check if they match the specific data
    for (var i = 0; i < lines.length; i++) {
        var line = lines[i].trim();
        var specificData = "Data for Energy Meter ID: " + energyMeterId + " and Date: " + date + " and Data Type: " + dataType;
        
        if (line === specificData) {
            // If the line matches the specific data, set the flag to false to exclude it
            includeLine = false;
        } else if (line === "") {
            // If it's an empty line, reset the flag to true
            includeLine = true;
        } else if (includeLine) {
            // If the flag is true, include the line in the filtered data
            filteredLines.push(line);
        }
    }

    // Join the filtered lines into a string and return
    return filteredLines.join('\n');
}

// Trigger fetchData function on button click
document.querySelector("button").addEventListener("click", fetchData);

// Function to export data to PDF or Excel
function exportData(format) {
    var dataToExport = document.getElementById("dataContainer").innerText;

    if (dataToExport) {
        if (format === 'pdf') {
            var doc = new jsPDF();
            doc.text(dataToExport, 10, 10);
            doc.save("exported_data.pdf");
        } else if (format === 'excel') {
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.aoa_to_sheet([[dataToExport]]);
            XLSX.utils.book_append_sheet(wb, ws, "Exported Data");
            XLSX.writeFile(wb, "exported_data.xlsx");
        }
    } else {
        alert("No data to export. Please fetch data first.");
    }
}