document.addEventListener("DOMContentLoaded", function() {
  const searchButton = document.getElementById("search-button");
  const clearSelectionButton = document.getElementById("clear-selection-button");
  const exportDataButton = document.getElementById("export-data-button");
  const autoRefreshToggle = document.getElementById("auto-refresh-toggle");
  const autoRefreshStatus = document.getElementById("auto-refresh-status");
  const tableBody = document.getElementById("table-body");
  let selectedRows = [];
  let autoRefreshInterval;

  // Example data (replace with your actual data)
  const alarmsData = [
    {
      severity: "High",
      plant: "Plant 1",
      id: "12345",
      alarmName: "L1 Connection lost", // Added "Alarm Name"
      device: "Device A",
      time: "2023-08-28 10:30 AM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "High",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    {
      severity: "Medium",
      plant: "Plant 2",
      id: "54321",
      alarmName: "Over Voltage", // Added "Alarm Name"
      device: "Device B",
      time: "2023-08-28 02:45 PM"
    },
    // Add more data objects as needed
  ];

  // Function to populate the table with data
  function populateTable() {
    tableBody.innerHTML = "";
    alarmsData.forEach((alarm) => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td><input type="checkbox"></td>
        <td>${alarm.severity}</td>
        <td>${alarm.plant}</td>
        <td>${alarm.id}</td>
        <td>${alarm.alarmName}</td> <!-- Updated field name -->
        <td>${alarm.device}</td>
        <td>${alarm.time}</td>
        <td>
          <button class="edit-button">Edit</button>
          <button class="delete-button">Delete</button>
        </td>
      `;
      tableBody.appendChild(row);
    });

    // Attach event listeners to checkboxes for row selection
    const checkboxes = tableBody.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener("change", handleRowSelection);
    });
  }

  // Function to handle selecting rows
  function handleRowSelection(event) {
    const checkbox = event.target;
    const row = checkbox.parentNode.parentNode;

    if (checkbox.checked) {
      selectedRows.push(row);
      row.classList.add("selected-row");
    } else {
      selectedRows = selectedRows.filter(selectedRow => selectedRow !== row);
      row.classList.remove("selected-row");
    }
  }

  // Clear Selection button click event
  clearSelectionButton.addEventListener("click", () => {
    selectedRows.forEach(row => {
      const checkbox = row.querySelector("input[type='checkbox']");
      checkbox.checked = false;
      row.classList.remove("selected-row");
    });
    selectedRows = [];
  });

  // Export Data button click event
  exportDataButton.addEventListener("click", () => {
    // Example: Export selectedRows data as needed
    console.log(selectedRows);
  });

  // Attach an event listener to the search button
  searchButton.addEventListener("click", () => {
    // Here you can perform the search based on user input
    // and update the alarmsData array with the search results
    // After updating the data, call populateTable to refresh the table
    populateTable();
  });

  // Initial population of the table
  populateTable();

  // Function to refresh the table
  function refreshTable() {
    // Clear existing selected rows
    selectedRows.forEach(row => {
      const checkbox = row.querySelector("input[type='checkbox']");
      checkbox.checked = false;
      row.classList.remove("selected-row");
    });
    selectedRows = [];

    // Populate the table with data
    populateTable();
  }

  // Function to start or stop auto-refresh
  function toggleAutoRefresh() {
    if (autoRefreshToggle.checked) {
      autoRefreshStatus.textContent = "On";
      autoRefreshInterval = setInterval(refreshTable, 5000); // Refresh every 5 seconds
    } else {
      autoRefreshStatus.textContent = "Off";
      clearInterval(autoRefreshInterval);
    }
  }

  // Attach event listener to auto-refresh toggle
  autoRefreshToggle.addEventListener("change", toggleAutoRefresh);
});
