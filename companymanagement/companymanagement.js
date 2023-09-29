// Function to open a tab
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    // Hide all tab contents
    var tabcontents = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontents.length; i++) {
        tabcontents[i].style.display = "none";
    }

    // Remove "active-tab" class from all tab buttons
    var tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active-tab");
    }

    // Show the selected tab content
    document.getElementById(tabName).style.display = "block";

    // Add "active-tab" class to the clicked tab button
    evt.currentTarget.classList.add("active-tab");

    // Store the active tab in localStorage
    localStorage.setItem("activeTab", tabName);
}

// Function to set the active tab on page load
function setActiveTab() {
    var activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
        document.getElementById(activeTab).click();
    }
}

// Automatically set the active tab on page load
window.addEventListener('load', setActiveTab);

// Automatically open the 'User Management' tab and add the "active-tab" class on page load
window.addEventListener('load', function() {
    openTab(undefined, 'UserManagement'); // 'undefined' is passed for tabName to set it as the default
});

// Initialize tooltips
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


function searchUsers() {
    // Get the input values
    var usernameInput = document.getElementById('usernameSearch').value.toLowerCase();
    var emailInput = document.getElementById('emailSearch').value.toLowerCase();

    // Get the table body
    var tbody = document.querySelector('#userTable tbody');
    
    // Get all rows in the table
    var rows = tbody.getElementsByTagName('tr');

    // Loop through each row and hide/show based on search criteria
    for (var i = 0; i < rows.length; i++) {
        var row = rows[i];
        var username = row.cells[1].textContent.toLowerCase();
        var email = row.cells[5].textContent.toLowerCase();

        // Check if the username or email contains the search input
        if (username.includes(usernameInput) || email.includes(emailInput)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}
