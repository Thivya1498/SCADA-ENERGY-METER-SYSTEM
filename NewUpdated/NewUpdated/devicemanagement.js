const rowsPerPage = 15; // Number of rows per page
            let currentPage = 1;   // Current page

            // JavaScript code goes here
            const data = [
                {
                    id: 1,
                    selected: false,
                    deviceStatus: "Active",
                    deviceName: "Energy Meter 1",
                    plantName: "Reactive Energy Sdn Bhd",
                    serialNumber: "SN001",
                    deviceBrand: "ABB",
                    warrantyExpiration: "2023-12-31"
                },
                // {
                //     id: 2,
                //     selected: false,
                //     deviceStatus: "Inactive",
                //     deviceName: "Device 2",
                //     plantName: "Plant B",
                //     serialNumber: "SN002",
                //     deviceBrand: "Brand Y",
                //     warrantyExpiration: "2024-06-15"
                // },
                // {
                //     id: 3,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 3",
                //     plantName: "Plant A",
                //     serialNumber: "SN003",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                // {
                //     id: 4,
                //     selected: false,
                //     deviceStatus: "Active",
                //     deviceName: "Device 4",
                //     plantName: "Plant A",
                //     serialNumber: "SN004",
                //     deviceBrand: "Brand X",
                //     warrantyExpiration: "2023-12-31"
                // },
                // {
                //     id: 5,
                //     selected: false,
                //     deviceStatus: "Inactive",
                //     deviceName: "Device 5",
                //     plantName: "Plant B",
                //     serialNumber: "SN005",
                //     deviceBrand: "Brand Y",
                //     warrantyExpiration: "2024-06-15"
                // },
                // {
                //     id: 6,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 6",
                //     plantName: "Plant A",
                //     serialNumber: "SN006",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                // {
                //     id: 1,
                //     selected: false,
                //     deviceStatus: "Active",
                //     deviceName: "Device 1",
                //     plantName: "Plant A",
                //     serialNumber: "SN001",
                //     deviceBrand: "Brand X",
                //     warrantyExpiration: "2023-12-31"
                // },
                // {
                //     id: 2,
                //     selected: false,
                //     deviceStatus: "Inactive",
                //     deviceName: "Device 2",
                //     plantName: "Plant B",
                //     serialNumber: "SN002",
                //     deviceBrand: "Brand Y",
                //     warrantyExpiration: "2024-06-15"
                // },
                // {
                //     id: 3,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 3",
                //     plantName: "Plant A",
                //     serialNumber: "SN003",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                // {
                //     id: 4,
                //     selected: false,
                //     deviceStatus: "Active",
                //     deviceName: "Device 4",
                //     plantName: "Plant A",
                //     serialNumber: "SN004",
                //     deviceBrand: "Brand X",
                //     warrantyExpiration: "2023-12-31"
                // },
                // {
                //     id: 5,
                //     selected: false,
                //     deviceStatus: "Inactive",
                //     deviceName: "Device 5",
                //     plantName: "Plant B",
                //     serialNumber: "SN005",
                //     deviceBrand: "Brand Y",
                //     warrantyExpiration: "2024-06-15"
                // },
                // {
                //     id: 6,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 6",
                //     plantName: "Plant A",
                //     serialNumber: "SN006",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                // {
                //     id: 1,
                //     selected: false,
                //     deviceStatus: "Active",
                //     deviceName: "Device 1",
                //     plantName: "Plant A",
                //     serialNumber: "SN001",
                //     deviceBrand: "Brand X",
                //     warrantyExpiration: "2023-12-31"
                // },
                // {
                //     id: 2,
                //     selected: false,
                //     deviceStatus: "Inactive",
                //     deviceName: "Device 2",
                //     plantName: "Plant B",
                //     serialNumber: "SN002",
                //     deviceBrand: "Brand Y",
                //     warrantyExpiration: "2024-06-15"
                // },
                // {
                //     id: 3,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 3",
                //     plantName: "Plant A",
                //     serialNumber: "SN003",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                // {
                //     id: 3,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 3",
                //     plantName: "Plant A",
                //     serialNumber: "SN003",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                // {
                //     id: 3,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 30",
                //     plantName: "Plant A",
                //     serialNumber: "SN003",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                // {
                //     id: 3,
                //     selected: false,
                //     deviceStatus: "Error",
                //     deviceName: "Device 10",
                //     plantName: "Plant A",
                //     serialNumber: "SN003",
                //     deviceBrand: "Brand Z",
                //     warrantyExpiration: "2023-10-20"
                // },
                
               
               
            ];
    
            function populateTable(filteredData = data) {
                const tableBody = document.getElementById("tableBody");
                tableBody.innerHTML = "";
                filteredData.forEach((row) => {
                  const newRow = document.createElement("tr");
                  newRow.innerHTML = `
                      <td><input type="checkbox" class="rowCheckbox" data-id="${row.id}"></td>
                      <td>
                          <span class="status-indicator ${getStatusClass(row.deviceStatus)}"></span>
                          ${row.deviceStatus}
                      </td>
                      <td>${row.deviceName}</td>
                      <td>${row.plantName}</td>
                      <td>${row.serialNumber}</td>
                      <td>${row.deviceBrand}</td>
                      <td>${row.warrantyExpiration}</td>
                      <td>
                      <i class="bx bxs-edit edit-icon" style="color: green;  cursor: pointer;" onclick="editRow(${row.id})"></i>
                      <i class="bx bxs-trash delete-icon" style="color: red; cursor: pointer;"" onclick="deleteRow(${row.id})"></i>
                      </td>
                  `;
                  tableBody.appendChild(newRow);
                });
              }
              
              function getStatusClass(status) {
                switch (status) {
                  case "Active":
                    return "status-active";
                  case "Inactive":
                    return "status-inactive";
                  case "Error":
                    return "status-error";
                  default:
                    return "";
                }
              }
              
              function filterData() {
                const deviceNameFilter = document.getElementById("deviceNameFilter").value.toLowerCase();
                const communicationStatusFilter = document.getElementById("communicationStatusFilter").value;
                const serialNumberFilter = document.getElementById("serialNumberFilter").value.toLowerCase();
              
                const filteredData = data.filter((row) => {
                  const deviceNameMatches = row.deviceName.toLowerCase().includes(deviceNameFilter);
                  const communicationStatusMatches =
                    communicationStatusFilter === "All" ||
                    row.deviceStatus.toLowerCase() === communicationStatusFilter.toLowerCase();
                  const serialNumberMatches = row.serialNumber.toLowerCase().includes(serialNumberFilter);
              
                  return deviceNameMatches && communicationStatusMatches && serialNumberMatches;
                });
              
                data.forEach((row) => {
                  row.selected = false;
                });
              
                populateTable(filteredData);
              }
              
              function editRow(id) {
                // Implement edit row functionality here (e.g., show a popup with row details)
                // You can access the row data using the 'id'
                // Update the 'data' array as needed
                alert(`Edit Row with ID ${id}`);
              }
              
              function deleteRow(id) {
                // Implement delete row functionality here
                // You can access the row data using the 'id'
                // Update the 'data' array as needed
                data.splice(data.findIndex((row) => row.id === id), 1);
                populateTable();
              }
              
              document.getElementById("selectAll").addEventListener("change", function () {
                const checkboxes = document.querySelectorAll(".rowCheckbox");
                checkboxes.forEach((checkbox) => {
                  checkbox.checked = this.checked;
                });
              });
              
              document.getElementById("searchButton").addEventListener("click", filterData);
              
              // Initialize the table with data
              populateTable();
              
              function paginateData(page) {
                const start = (page - 1) * rowsPerPage;
                const end = page * rowsPerPage;
                return data.slice(start, end);
              }
              
              function refreshTable() {
                const paginatedData = paginateData(currentPage);
                populateTable(paginatedData);
              
                // Handle pagination controls
                document.getElementById("prevPage").disabled = currentPage === 1;
                document.getElementById("nextPage").disabled =
                  currentPage === Math.ceil(data.length / rowsPerPage);
                document.getElementById("currentPage").innerText = `Page ${currentPage}`;
              }
              
              // Initialize the table with paginated data
              refreshTable();
              
              document.getElementById("prevPage").addEventListener("click", function (event) {
                if (currentPage > 1) {
                  currentPage--;
                  refreshTable();
                }
              });
              
              document.getElementById("nextPage").addEventListener("click", function (event) {
                if (currentPage < data.length / rowsPerPage) {
                  currentPage++;
                  refreshTable();
                }
              });
              
              const tableRows = document.querySelectorAll(".table-dark tbody tr");
              
              tableRows.forEach((row) => {
                row.addEventListener("mouseover", function () {
                  this.style.backgroundColor = "#fff";
                });
              
                row.addEventListener("mouseout", function () {
                  this.style.backgroundColor = "";
                });
              });
              
              // Get references to modal and edit icons
              const modal = document.getElementById("editModal");
              const editIcons = document.querySelectorAll(".edit-icon"); // Select all edit icons
              
              // Get modal input elements
              const deviceNameInput = document.getElementById("deviceName");
              const snInput = document.getElementById("sn");
              const deviceIPAddressInput = document.getElementById("deviceIPAddress");
              
              // Get modal buttons
              const okButton = document.getElementById("okButton");
              const cancelButton = document.getElementById("cancelButton");
              const closeModalButton = document.getElementById("closeModal");
              
              // Function to open the modal
              function openModal() {
                modal.classList.add("active");
              }
              
              // Function to close the modal
              function closeModal() {
                modal.classList.remove("active");
              }
              
              // Event listeners for clicking the edit icons in each row
              editIcons.forEach((editIcon) => {
                editIcon.addEventListener("click", openModal);
              });
              
              // Event listeners for modal buttons
              okButton.addEventListener("click", () => {
                // Add logic to update device information here if needed
                closeModal();
              });
              
              cancelButton.addEventListener("click", () => {
                closeModal();
              });
              
              closeModalButton.addEventListener("click", () => {
                closeModal();
              });
              
              // Close the modal if the user clicks outside of it
              window.addEventListener("click", (event) => {
                if (event.target === modal) {
                  closeModal();
                }
              });
              function editRow(id) {
                const selectedRow = data.find((row) => row.id === id);
                if (selectedRow) {
                    const deviceNameInput = document.getElementById("deviceName");
                    const snInput = document.getElementById("sn");
                    const deviceIPAddressInput = document.getElementById("deviceIPAddress");
            
                    deviceNameInput.value = selectedRow.deviceName;
                    snInput.value = selectedRow.serialNumber;
                    // Add your logic to get the Device IP Address here
                    deviceIPAddressInput.value = "N/A"; // Update with the actual Device IP Address
                }
            
                // Open the edit popup
                openModal();
            }
            // Get references to the modal and buttons
            const deleteModal = document.getElementById("deleteModal");
            const confirmDeleteButton = document.getElementById("confirmDeleteButton");
            const cancelDeleteButton = document.getElementById("cancelDeleteButton");

            // Function to open the delete confirmation modal
            function openDeleteModal(id) {
                deleteModal.style.display = "block";

                // Event listener for confirm delete
                confirmDeleteButton.addEventListener("click", () => {
                    // Implement your delete logic here with the 'id'
                    // For this example, we'll just close the modal
                    alert(`Deleted item with ID: ${id}`);
                    closeDeleteModal();
                });

                // Event listener for cancel delete
                cancelDeleteButton.addEventListener("click", () => {
                    closeDeleteModal();
                });
            }

            // Function to close the delete confirmation modal
            function closeDeleteModal() {
                deleteModal.style.display = "none";
            }
