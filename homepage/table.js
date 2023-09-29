
// Sample data for the table (you can replace this with your own data)
const data = [
    { status: 'Active', plantName: 'Company A', location: 'Petaling Jaya', todayEnergy: '500kWh', totalEnergy: '2000kWh' },
    { status: 'Inactive', plantName: 'Company B', location: 'Selangor', todayEnergy: '300kWh', totalEnergy: '1500kWh' },
    { status: 'Error', plantName: 'Company C', location: 'Kuala Lumpur', todayEnergy: '750kWh', totalEnergy: '3000kWh' },
    { status: 'Active', plantName: 'Company A', location: 'Petaling Jaya', todayEnergy: '500kWh', totalEnergy: '2000kWh' },
    { status: 'Inactive', plantName: 'Company B', location: 'Selangor', todayEnergy: '300kWh', totalEnergy: '1500kWh' },
    { status: 'Error', plantName: 'Company C', location: 'Kuala Lumpur', todayEnergy: '750kWh', totalEnergy: '3000kWh' },
    { status: 'Active', plantName: 'Company A', location: 'Petaling Jaya', todayEnergy: '500kWh', totalEnergy: '2000kWh' },
    { status: 'Inactive', plantName: 'Company B', location: 'Selangor', todayEnergy: '300kWh', totalEnergy: '1500kWh' },
    { status: 'Error', plantName: 'Company C', location: 'Kuala Lumpur', todayEnergy: '750kWh', totalEnergy: '3000kWh' },
    { status: 'Active', plantName: 'Company A', location: 'Petaling Jaya', todayEnergy: '500kWh', totalEnergy: '2000kWh' },
    { status: 'Inactive', plantName: 'Company B', location: 'Selangor', todayEnergy: '300kWh', totalEnergy: '1500kWh' },
    { status: 'Error', plantName: 'Company C', location: 'Kuala Lumpur', todayEnergy: '750kWh', totalEnergy: '3000kWh' },
    { status: 'Active', plantName: 'Company A', location: 'Petaling Jaya', todayEnergy: '500kWh', totalEnergy: '2000kWh' }
];

// JavaScript to handle the popup
const addPlantButton = document.getElementById("addPlantButton");
const addPlantPopup = document.getElementById("addPlantPopup");
const closePopup = document.getElementById("closePopup");


// Function to generate table rows
function generateTable() {
    const tableBody = document.getElementById('table-body');
    tableBody.innerHTML = '';

    data.forEach((item, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="checkbox" class="select-checkbox"></td>
            <td class="status"><div class="status-circle ${getStatusColorClass(item.status)}"></div>${item.status}</td>
            <td class="plant-name">${item.plantName}</td>
            <td class="location">${item.location}</td>
            <td class="today-energy">${item.todayEnergy}</td>
            <td class="total-energy">${item.totalEnergy}</td>
        `;
        tableBody.appendChild(row);
    });
}

// Function to get the appropriate status color class
function getStatusColorClass(status) {
    switch (status) {
        case 'Active':
            return 'status-active';
        case 'Inactive':
            return 'status-inactive';
        case 'Error':
            return 'status-error';
        default:
            return '';
    }
}

// Run the code after the document is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    generateTable();
});

addPlantButton.addEventListener("click", () => {
    addPlantPopup.style.display = "flex";
});

closePopup.addEventListener("click", () => {
    addPlantPopup.style.display = "none";
});
