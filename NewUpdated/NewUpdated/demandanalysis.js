var chart; // Global variable to store the chart instance

// Function to fetch data, called on page load and when the "View Data" button is clicked
function fetchData() {
    var selectedEnergyMeterId = document.getElementById("customer_serial_number").value;
    var selectedFilter = document.querySelector('input[name="dateFilter"]:checked').value;

    // Check if the selected filter is day, month, or year
    if (selectedFilter === "day") {
        var selectedDate = document.getElementById("day").value;
    } else if (selectedFilter === "month") {
        var selectedMonth = document.getElementById("month").value;
        var selectedYear = document.getElementById("year-month").value;
    } else if (selectedFilter === "year") {
        var selectedYear = document.getElementById("year").value;
    }

    // AJAX request to fetch data
    $.ajax({
        url: "fetch_data.php",
        type: "GET",
        data: {
            customer_serial_number: selectedEnergyMeterId,
            filter: selectedFilter,
            date: selectedDate,
            month: selectedMonth,
            year: selectedYear
        },
        success: function (response) {
            document.getElementById("dataContainer").innerHTML = response;
            document.getElementById("dataInfo").textContent = "Energy Meter ID: " + selectedEnergyMeterId +
                ", Date Filter: " + selectedFilter + ", Date: " + selectedDate + ", Month: " + selectedMonth +
                ", Year: " + selectedYear;

            // Extract data from the table and generate the chart
            extractDataAndGenerateChart();
        },
        error: function (error) {
            console.log("Error: " + error);
        }
    });
}

// Function to export data to CSV
function exportToCSV() {
    // Logic to export data to CSV format goes here
    // You can use JavaScript libraries or custom code for this purpose
}

function extractDataAndGenerateChart() {
    // Logic to extract data and generate the Highcharts chart goes here
    // This should be similar to your previous implementation
}

// Event listener for date filter change
$('input[name="dateFilter"]').change(function () {
    var selectedFilter = this.value;
    // Show/hide date filter options based on the selected filter
    if (selectedFilter === "day") {
        $(".date-filter").removeClass("active-filter");
        $(".day-filter").addClass("active-filter");
    } else if (selectedFilter === "month") {
        $(".date-filter").removeClass("active-filter");
        $(".month-filter").addClass("active-filter");
    } else if (selectedFilter === "year") {
        $(".date-filter").removeClass("active-filter");
        $(".year-filter").addClass("active-filter");
    }
});

// Trigger fetchData function on page load
fetchData();