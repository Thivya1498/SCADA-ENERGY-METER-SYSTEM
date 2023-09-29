document.addEventListener("DOMContentLoaded", function() {
  const searchButton = document.getElementById("search-button");
  const clearSelectionButton = document.getElementById("clear-selection-button");
  const exportDataButton = document.getElementById("export-data-button");
  const tableBody = document.getElementById("table-body");
  let selectedRows = [];

  // Example data (replace with your actual data)
  const alarmsData = [
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "Medium", plant: "Plant 2", id: "54321", name: "Alarm 2", device: "Device B", clearancetype: "Manual", clearancetime: "2023-08-28 02:45 PM", time: "2023-08-28 01:00 PM" },
    { severity: "Low", plant: "Plant 3", id: "12005", name: "Alarm 3", device: "Device C", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "Medium", plant: "Plant 4", id: "01221", name: "Alarm 4", device: "Device D", clearancetype: "Manual", clearancetime: "2023-08-28 02:45 PM", time: "2023-08-28 01:00 PM" },
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "Medium", plant: "Plant 2", id: "54321", name: "Alarm 2", device: "Device B", clearancetype: "Manual", clearancetime: "2023-08-28 02:45 PM", time: "2023-08-28 01:00 PM" },
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "Medium", plant: "Plant 2", id: "54321", name: "Alarm 2", device: "Device B", clearancetype: "Manual", clearancetime: "2023-08-28 02:45 PM", time: "2023-08-28 01:00 PM" },
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "Medium", plant: "Plant 2", id: "54321", name: "Alarm 2", device: "Device B", clearancetype: "Manual", clearancetime: "2023-08-28 02:45 PM", time: "2023-08-28 01:00 PM" },
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
    { severity: "High", plant: "Plant 1", id: "12345", name: "Alarm 1", device: "Device A", clearancetype: "Automatic", clearancetime: "2023-08-28 11:15 AM", time: "2023-08-28 10:30 AM" },
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
        <td>${alarm.name}</td>
        <td>${alarm.device}</td>
        <td>${alarm.clearancetype}</td>
        <td>${alarm.clearancetime}</td>
        <td>${alarm.time}</td>
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
});
