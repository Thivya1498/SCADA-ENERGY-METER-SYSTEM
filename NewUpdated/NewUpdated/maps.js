document.addEventListener('DOMContentLoaded', function() {
    const states = [
        // { name: "Kuala Lumpur", latlng: [3.1390, 101.6869], description: "Welcome to Kuala Lumpur!", totalCharger: 2, activeCharger: 120, energyConsumption: "3.8 MW", iconPath: "images/maps.PNG" },
        // { name: "Perlis", latlng: [6.4550, 100.4162], description: "Welcome to Perlis!", totalCharger: 2, activeCharger: 50, energyConsumption: "1.2 MW", iconPath: "images/maps.PNG" },
        // { name: "Pahang", latlng: [3.9236, 102.9222], description: "Welcome to Pahang!", totalCharger: 2, activeCharger: 80, energyConsumption: "2.5 MW", iconPath: "images/maps.PNG" },
        // { name: "Terengganu", latlng: [5.3117, 103.1324], description: "Welcome to Terengganu!", totalCharger: 2, activeCharger: 60, energyConsumption: "1.9 MW", iconPath: "images/maps.PNG" },
        // { name: "Kedah", latlng: [6.1256, 100.3685], description: "Welcome to Kedah!", totalCharger: 2, activeCharger: 70, energyConsumption: "2.2 MW", iconPath: "images/maps.PNG" },
        // { name: "Johor", latlng: [1.4927, 103.7414], description: "Welcome to Johor!", totalCharger: 2, activeCharger: 90, energyConsumption: "3.0 MW", iconPath: "images/maps.PNG" },
        { name: "Selangor", latlng: [3.0777, 101.6126], description: "Welcome to Selangor!", totalCharger: 1, activeCharger: 110, energyConsumption: "8,120 kWh", iconPath: "images/maps.png" },
        // { name: "Penang", latlng: [5.4164, 100.3327], description: "Welcome to Penang!", totalCharger: 2, activeCharger: 60, energyConsumption: "1.7 MW", iconPath: "images/maps.PNG" },
        // { name: "Kelantan", latlng: [6.1259, 102.2386], description: "Welcome to Kelantan!", totalCharger: 2, activeCharger: 40, energyConsumption: "1.1 MW", iconPath: "images/maps.PNG" },
        // { name: "Perak", latlng: [4.5975, 101.0901], description: "Welcome to Perak!", totalCharger: 2, activeCharger: 80, energyConsumption: "2.4 MW", iconPath: "images/maps.PNG" },
        // { name: "Melaka", latlng: [2.1896, 102.2501], description: "Welcome to Melaka!", totalCharger: 2, activeCharger: 50, energyConsumption: "1.5 MW", iconPath: "images/maps.PNG" },
        // { name: "Negeri Sembilan", latlng: [2.7255, 101.9424], description: "Welcome to Negeri Sembilan!", totalCharger: 2, activeCharger: 70, energyConsumption: "1.8 MW", iconPath: "images/maps.PNG" },
        // { name: "Sabah", latlng: [5.9788, 116.0753], description: "Welcome to Sabah!", totalCharger: 2, activeCharger: 90, energyConsumption: "2.9 MW", iconPath: "images/maps.PNG" },
        // { name: "Sarawak", latlng: [1.5533, 110.3598], description: "Welcome to Sarawak!", totalCharger: 2, activeCharger: 80, energyConsumption: "2.3 MW", iconPath: "images/maps.PNG" }
    ];

    let currentPage = 1;
    const rowsPerPage = 15;
    const defaultTiles = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    let mapTiles;

    const map = L.map('map').setView([3.8, 108.3], 6.0);

    function applyTileLayer(layer) {
        if (mapTiles) {
            map.removeLayer(mapTiles);
        }
        mapTiles = L.tileLayer(layer).addTo(map);
    }

    applyTileLayer(defaultTiles);

    states.forEach(state => {
        const customIcon = L.icon({
            iconUrl: state.iconPath,
            iconSize: [35, 35],
            iconAnchor: [19, 47],
            popupAnchor: [0, -47]
        });

        L.marker(state.latlng, { icon: customIcon }).addTo(map)
            .bindPopup(`
                <div class="popup-content">
                    <h3>Plant Details</h3>
                    <p><strong>Reactive Energy Sdn Bhd, ${state.name}</strong></p>
                    <div style="display: flex; align-items: center;">
                        <img src="images/meter.png" alt="Energy Meter" width="40px" style="margin-right: 10px;">
                        <div>
                            <p>Total Energy Meter: ${state.totalCharger}</p>
                            <p>Energy Consumption: ${state.energyConsumption}</p>
                        </div>
                    </div>
                </div>
            `)
            .bindTooltip(state.name);
    });

    document.getElementById('searchButton').addEventListener('click', function() {
        const searchTerm = document.getElementById('locationSearch').value;
        const matchedState = states.find(state => state.name.toLowerCase() === searchTerm.toLowerCase());

        if (matchedState) {
            map.setView(matchedState.latlng, 50); // Zoom to the state
        } else {
            alert('Location not found');
        }
    });

    // Add an event listener for the "keydown" event on the location search input field
    document.getElementById('locationSearch').addEventListener('keydown', function(event) {
        if (event.keyCode === 13) { // Check if the pressed key is Enter (key code 13)
            event.preventDefault(); // Prevent the default Enter key behavior (e.g., form submission)
            // Perform the search action here, similar to the search button click event

            const searchTerm = this.value;
            const matchedState = states.find(state => state.name.toLowerCase() === searchTerm.toLowerCase());

            if (matchedState) {
                map.setView(matchedState.latlng, 50); // Zoom to the state
            } else {
                alert('Location not found');
            }
        }
    });

    // Assuming you have an array of location names
    const locationNames = states.map(state => state.name);

    // Get the input field
    const locationSearchInput = document.getElementById('locationSearch');

    // Get a reference to the suggestions container
    const suggestionsContainer = document.getElementById('suggestionsContainer');

    // Add an event listener to the input field
    locationSearchInput.addEventListener('input', function() {
        // Get the user's input
        const userInput = locationSearchInput.value.toLowerCase();

        // Filter the location names based on the user's input
        const matchingLocations = locationNames.filter(location => location.toLowerCase().includes(userInput));

        // Clear previous suggestions
        suggestionsContainer.innerHTML = '';

        // Display matching location names as suggestions
        matchingLocations.forEach(location => {
            const suggestion = document.createElement('div');
            suggestion.textContent = location;
            suggestion.classList.add('suggestion');

            // Add a click event listener to fill the input field when a suggestion is clicked
            suggestion.addEventListener('click', function() {
                locationSearchInput.value = location;
                suggestionsContainer.innerHTML = ''; // Clear suggestions
            });

            suggestionsContainer.appendChild(suggestion);
        });
    });

    document.getElementById("darkModeToggle").addEventListener('change', function() {
        const body = document.body;
        body.classList.toggle('dark-mode');

        const currentTiles = body.classList.contains('dark-mode') 
            ? 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png' 
            : defaultTiles;

        applyTileLayer(currentTiles);

        localStorage.setItem('dark-mode', body.classList.contains('dark-mode') ? 'true' : 'false');
    });

    if (localStorage.getItem('dark-mode') === 'true') {
        document.body.classList.add('dark-mode');
        const darkTiles = 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png';
        applyTileLayer(darkTiles);
    }

    var swiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 30000,
            disableOnInteraction: true,
        },
        on: {
            slideChangeTransitionEnd: function() {
                if (this.activeIndex === 0) {
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 30000);
                }
            }
        }
    });

    // Stop autoplay on mouse hover
    swiper.el.onmouseover = function() {
        swiper.autoplay.stop();
    }

    // Start autoplay when mouse leaves
    swiper.el.onmouseout = function() {
        swiper.autoplay.start();
    }
});

// Function to display the 'Add New Plant' popup
document.getElementById('addNewPlant').addEventListener('click', function() {
    document.getElementById('newPlantModal').style.display = 'block';
});

// Function to hide the 'Add New Plant' popup
document.getElementById('cancelAdd').addEventListener('click', function() {
    document.getElementById('newPlantModal').style.display = 'none';
});

// Function to delete selected rows
document.getElementById('deleteSelected').addEventListener('click', function() {
    let table = document.querySelector('table');
    let checkboxes = table.querySelectorAll('input[type="checkbox"]:checked:not(#selectAll)');
    
    checkboxes.forEach(checkbox => {
        table.deleteRow(checkbox.parentElement.parentElement.rowIndex);
    });
});

document.querySelectorAll('table input[type="checkbox"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            this.parentElement.parentElement.style.backgroundColor = '#6495ED'; // A shade of green
        } else {
            this.parentElement.parentElement.style.backgroundColor = ''; // Reset to original color
        }
    });
});

document.getElementById('savePlant').addEventListener('click', function() {
    // Fetch the input values
    let companyNameValue = document.getElementById('companyName').value;
    let plantNameValue = document.getElementById('plantName').value;
    let contactPersonValue = document.getElementById('contactPerson').value;
    let connectionDateValue = document.getElementById('gridConnectionDate').value;

    // Append the new data to the table
    let table = document.querySelector('table tbody');
    let newRow = table.insertRow();

    // Checkbox column
    let cell1 = newRow.insertCell(0);
    let checkbox = document.createElement('input');
    checkbox.type = "checkbox";
    cell1.appendChild(checkbox);

    // Status column (setting a default status for now)
    let cell2 = newRow.insertCell(1);
    let statusIndicator = document.createElement('span');
    statusIndicator.className = "status-indicator active";
    cell2.appendChild(statusIndicator);
    cell2.innerHTML += "Active";

    // Company column
    let cell3 = newRow.insertCell(2);
    cell3.innerHTML = companyNameValue;

    // Plant Name column
    let cell4 = newRow.insertCell(3);
    cell4.innerHTML = plantNameValue;

    // Other columns (you can modify based on your data structure)
    let cell5 = newRow.insertCell(4);
    cell5.innerHTML = "0";  // Assuming energy usage today starts at 0
    let cell6 = newRow.insertCell(5);
    cell6.innerHTML = "0";  // Assuming cumulative energy starts at 0

    hideModal();
});

document.getElementById('companyName').value = '';
document.getElementById('plantName').value = '';
document.getElementById('contactPerson').value = '';
document.getElementById('gridConnectionDate').value = '';
document.getElementById('addNewPlant').addEventListener('click', showModal);
document.getElementById('cancelAdd').addEventListener('click', hideModal);
document.querySelector('.overlay').addEventListener('click', hideModal);
document.getElementById('selectAll').addEventListener('change', function() {
    let checkboxes = document.querySelectorAll('table tbody input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

function showModal() {
    document.getElementById("newPlantModal").style.display = "block";
    document.querySelector(".overlay").style.display = "block";
}

function hideModal() {
    document.getElementById("newPlantModal").style.display = "none";
    document.querySelector(".overlay").style.display = "none";
}

// Add an event listener for the "Search" button for plant name search
document.getElementById('searchPlant').addEventListener('click', function() {
    const searchTerm = document.getElementById('plantSearch').value.toLowerCase();
    // Call a function to filter the table based on the plant name
    filterTableByPlantName(searchTerm);
});

// Add an event listener to the input field for plant name search
document.getElementById('plantSearch').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    // Call a function to filter the table as the user types
    filterTableByPlantName(searchTerm);
});

// Function to filter the table by plant name
function filterTableByPlantName(searchTerm) {
    const table = document.querySelector('table');
    const rows = table.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const plantNameCell = row.querySelector('td:nth-child(3)');
        if (plantNameCell) {
            const plantName = plantNameCell.textContent.toLowerCase();
            if (plantName.includes(searchTerm)) {
                row.style.display = ''; // Show the row
            } else {
                row.style.display = 'none'; // Hide the row
            }
        }
    });
}
