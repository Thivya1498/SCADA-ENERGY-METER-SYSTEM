// Sample data for demonstration (replace with your data source)
const userData = [
    { username: 'Thivya', roleName: 'SCADA Engineer', companyName: 'Reactive Energy Sdn Bhd', mobileNumber: '0112321091', email: 'thivya@reactivenergy.com', status: 'Active' },
    // { username: 'User2', roleName: 'User', companyName: 'Company B', mobileNumber: '0120000111', email: 'user2@example.com', status: 'Inactive' },
    // { username: 'Guest1', roleName: 'Guest', companyName: 'Company C', mobileNumber: '0123090001', email: 'user3@example.com', status: 'Active' },
    // Add more user data here
];

// Function to populate the user table
function populateUserTable(data) {
    const userTableBody = document.getElementById("userTableBody");
    userTableBody.innerHTML = '';

    data.forEach(user => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="checkbox"></td>
            <td>${user.username}</td>
            <td>${user.roleName}</td>
            <td>${user.companyName}</td>
            <td>${user.mobileNumber}</td>
            <td>${user.email}</td>
            <td>${user.status}</td>
            <td>
                <i class="fas fa-sync reset-icon" title="Reset" data-username="${user.username}"></i>
                <i class="fas fa-edit edit-icon" title="Modify User" data-username="${user.username}"></i>
                <i class="fas fa-trash delete-icon" title="Delete User" data-username="${user.username}"></i>
                <i class="fas fa-ban disable-icon" title="Disable User" data-username="${user.username}"></i>
            </td>
        `;
        userTableBody.appendChild(row);
    });
}

function searchUsers() {
    const searchUsername = document.getElementById("searchUsername").value;
    const searchEmail = document.getElementById("searchEmail").value;

    // Simulate a search based on the provided criteria
    const filteredData = userData.filter(user => {
        return (user.username.toLowerCase().includes(searchUsername.toLowerCase()) &&
            user.email.toLowerCase().includes(searchEmail.toLowerCase()));
    });

    populateUserTable(filteredData);
}

function resetFields() {
    document.getElementById("searchUsername").value = "";
    document.getElementById("searchEmail").value = "";

    // Reset the table to show all data
    populateUserTable(userData);
}

// Event listener for the icons
document.addEventListener("click", function (event) {
    if (event.target.classList.contains("reset-icon") ||
        event.target.classList.contains("edit-icon") ||
        event.target.classList.contains("delete-icon") ||
        event.target.classList.contains("disable-icon")) {
        const username = event.target.getAttribute("data-username");
        // Call a function to set up the pop-up dialog with user-specific data
        setupPopupDialog(username, event.target.classList);
    }
});

// Function to set up the pop-up dialog with user-specific data
function setupPopupDialog(username, iconClasses) {
    // You can use the username to retrieve user-specific data and populate the pop-up dialog
    // Show the relevant dialog (password reset, user modification, etc.) and populate it with user data
    if (iconClasses.contains("reset-icon")) {
        // Handle the reset password dialog
        // Implement your logic to show the reset password dialog
        setupResetPasswordDialog(username);
    } else if (iconClasses.contains("edit-icon")) {
        // Handle the edit user dialog
        // Implement your logic to show the edit user dialog
        setupEditUserDialog(username);
    } else if (iconClasses.contains("delete-icon")) {
        // Handle the delete user dialog
        // Implement your logic to show the delete user dialog
        setupDeleteUserDialog(username);
    } else if (iconClasses.contains("disable-icon")) {
        // Handle the disable user dialog
        // Implement your logic to show the disable user dialog
        setupDisableUserDialog(username);
    }
}

// Function to show the dialog by ID
function showModal(dialogId) {
    const dialog = document.getElementById(dialogId);
    dialog.style.display = "block";
}

// Function to hide the dialog by ID
function hideModal(dialogId) {
    const dialog = document.getElementById(dialogId);
    dialog.style.display = "none";
}

// Event listeners for the cancel buttons
document.getElementById("cancelButton").addEventListener("click", function () {
    hideModal("passwordResetDialog");
});

document.getElementById("cancelModifyButton").addEventListener("click", function () {
    hideModal("modifyUserDialog");
});

document.getElementById("cancelDeleteButton").addEventListener("click", function () {
    hideModal("deleteUserDialog");
});

document.getElementById("cancelDisableButton").addEventListener("click", function () {
    hideModal("disableUserDialog");
});

// Handle password reset logic (OK button)
document.getElementById("okButton").addEventListener("click", function () {
    // Implement the logic for password reset here
    // You can retrieve the new password and confirm password values from the input fields
    const newPassword = document.getElementById("newPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    // Perform the password reset logic and hide the dialog
    // You can add your logic here to change the password and hide the dialog
    // For example, you can send a request to the server to update the password.
    // After the password reset is completed, hide the dialog
    hideModal("passwordResetDialog");
});

// Handle user modification logic
document.getElementById("okModifyButton").addEventListener("click", function () {
    // Implement the logic to save changes and hide the dialog
    // You can retrieve values from the input fields for modifications
    // After the modifications are saved, hide the Modify User dialog
    hideModal("modifyUserDialog");
});

// Handle user deletion logic
document.getElementById("okDeleteButton").addEventListener("click", function () {
    // Implement the logic to delete the user and hide the dialog
    // You can send a request to the server to delete the user
    // After the user is deleted, hide the user deletion dialog
    hideModal("deleteUserDialog");
});

// Handle user disable logic
document.getElementById("disableButton").addEventListener("click", function () {
    // Implement the logic to disable the user and hide the dialog
    // You can send a request to the server to disable the user
    // After the user is disabled, hide the Disable User dialog
    hideModal("disableUserDialog");
});

// Function to set up the pop-up dialog with user-specific data for password reset
function setupResetPasswordDialog(username) {
    // You can use the username to retrieve user-specific data
    // Show the relevant dialog (password reset) and populate it with user data
    document.getElementById("selectedUser").textContent = username; // Set the username
    showModal("passwordResetDialog"); // Show the dialog
}

// Function to display user-specific data in the edit user dialog
function setupEditUserDialog(username) {
    const editDialog = document.getElementById("modifyUserDialog");
    const editUserName = document.getElementById("modifyUserName");
    editUserName.textContent = username;
    showModal("modifyUserDialog");
}

// Function to display user-specific data in the delete user dialog
function setupDeleteUserDialog(username) {
    const deleteDialog = document.getElementById("deleteUserDialog");
    const deleteUserName = document.getElementById("deleteUserName");
    deleteUserName.textContent = username;
    showModal("deleteUserDialog");
}

// Function to display user-specific data in the disable user dialog
function setupDisableUserDialog(username) {
    const disableDialog = document.getElementById("disableUserDialog");
    const disableUserName = document.getElementById("disableUserName");
    disableUserName.textContent = username;
    showModal("disableUserDialog");
}

// Initial population of the table
populateUserTable(userData);



// Function to show the modal background
function showOverlay() {
    const overlay = document.getElementById("overlay");
    overlay.style.display = "block";
}

// Function to hide the modal background
function hideOverlay() {
    const overlay = document.getElementById("overlay");
    overlay.style.display = "none";
}

// Function to show the pop-up dialog
function showModal(dialogId) {
    showOverlay(); // Show the modal background
    const dialog = document.getElementById(dialogId);
    dialog.style.display = "block";
}

// Function to hide the pop-up dialog
function hideModal(dialogId) {
    hideOverlay(); // Hide the modal background
    const dialog = document.getElementById(dialogId);
    dialog.style.display = "none";
}