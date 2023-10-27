// Populate states and cities
const stateSelect = document.getElementById("state");
const citySelect = document.getElementById("city");

const statesAndCities = {
"Johor": ["Johor Bahru", "Muar", "Segamat"],
"Kedah": ["Alor Setar", "Kulim", "Langkawi"],
"Kelantan": ["Kota Bharu", "Tumpat", "Pasir Mas"],
"Melaka": ["Melaka"],
"Negeri Sembilan": ["Seremban", "Port Dickson"],
"Pahang": ["Kuantan", "Temerloh"],
"Perak": ["Ipoh", "Taiping", "Teluk Intan"],
"Perlis": ["Kangar"],
"Penang": ["Georgetown", "Butterworth"],
"Sabah": ["Kota Kinabalu", "Sandakan", "Tawau"],
"Sarawak": ["Kuching", "Miri", "Sibu", "Mukah"],
"Selangor": ["Shah Alam", "Subang Jaya", "Klang"],
"Terengganu": ["Kuala Terengganu", "Kemaman"],
"Putrajaya": ["Putrajaya"],
"Kuala Lumpur": ["Kuala Lumpur"],
"Labuan": ["Labuan"]
};


// Populate the states dropdown
for (const state in statesAndCities) {
const option = document.createElement("option");
option.value = state;
option.text = state;
stateSelect.appendChild(option);
}

// Populate the cities dropdown based on the state selected
stateSelect.addEventListener("change", function() {
citySelect.innerHTML = '';  // Clear the cities dropdown
const selectedState = stateSelect.value;
statesAndCities[selectedState].forEach(city => {
    const option = document.createElement("option");
    option.value = city;
    option.text = city;
    citySelect.appendChild(option);
});
});

// Map integration
const map = L.map("map").setView([4.2105, 101.9758], 6);
const selectedLocationInput = document.getElementById("selectedLocation");

L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

let marker;
map.on("click", function(e) {
    if (marker) {
        map.removeLayer(marker);
    }
    marker = L.marker(e.latlng).addTo(map);
    selectedLocationInput.value = `${e.latlng.lat}, ${e.latlng.lng}`;
});

const selectLocationBtn = document.getElementById("selectLocation");
selectLocationBtn.addEventListener("click", () => {
    if (marker) {
        map.setView(marker.getLatLng(), 15);
    }
});

// Populate timezone dropdown and set default for Malaysia
const timezoneSelect = document.getElementById("timezone");
const defaultTimezone = "Asia/Kuala_Lumpur";
moment.tz.names().forEach((timezone) => {
    const option = document.createElement("option");
    option.value = timezone;
    option.text = timezone;
    if (timezone === defaultTimezone) {
        option.selected = true;
    }
    timezoneSelect.appendChild(option);
});

// If you want to show current time in Malaysia, you can use:
const currentTimeInMalaysia = moment.tz(defaultTimezone);
console.log(currentTimeInMalaysia.format()); // Logs current date and time for Malaysia

// Show or hide Fixed Charge (Monthly) based on Fixed Rate checkbox
document.getElementById('fixedRate').addEventListener('change', function () {
    const fixedRateField = document.getElementById('fixedRateField');
    if (this.checked) {
        fixedRateField.style.display = 'block';
    } else {
        fixedRateField.style.display = 'none';
    }
});

// Show or hide Fixed Charge (Monthly) based on Fixed Rate checkbox
document.getElementById('fixedRate').addEventListener('change', function() {
    const fixedRateField = document.getElementById('fixedRateField');
    if (this.checked) {
        fixedRateField.style.display = 'block';
    } else {
        fixedRateField.style.display = 'none';
    }
});


