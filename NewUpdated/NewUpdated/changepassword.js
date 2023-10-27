function applyChanges() {
    const oldPassword = document.getElementById("old-password").value;
    const newPassword = document.getElementById("new-password").value;
    const confirmPassword = document.getElementById("confirm-password").value;
    const username = document.getElementById("username").innerText;

    if (newPassword !== confirmPassword) {
        alert('New password and Confirm password do not match!');
        return;
    }

    if (newPassword.length < 8 || newPassword.length > 32) {
        alert('Password must be between 8 to 32 characters.');
        return;
    }

    const hasLetter = /[a-zA-Z]/.test(newPassword);
    const hasDigit = /\d/.test(newPassword);
    const hasSpace = /\s/.test(newPassword);
    
    if (!hasLetter || !hasDigit || hasSpace) {
        alert('Password must contain at least 1 letter, 1 digit, and no spaces.');
        return;
    }

    if (newPassword.includes(username)) {
        alert('Password cannot contain the username.');
        return;
    }

    const difference = newPassword.split('').filter((char, index) => char !== oldPassword[index]).length;
    if (difference < 3) {
        alert('The new password must differ from the old password by at least 3 characters.');
        return;
    }

    // TODO: Send the data to server for further processing

    alert('Password changed successfully!');
}

function toggleVisibility(id) {
    let passwordInput = document.getElementById(id);
    let passwordType = passwordInput.getAttribute('type');

    if (passwordType === 'password') {
        passwordInput.setAttribute('type', 'text');
    } else {
        passwordInput.setAttribute('type', 'password');
    }
}

