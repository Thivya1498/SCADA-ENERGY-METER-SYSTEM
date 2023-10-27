// function toggleVisibility() {
//     const passwordField = document.getElementById('password');
//     if (passwordField.type === 'password') {
//         passwordField.type = 'text';
//     } else {
//         passwordField.type = 'password';
//     }
// }

// function flipCard() {
//     const card = document.querySelector('.card');
//     if (card.classList.contains('flipped')) {
//         card.classList.remove('flipped');
//     } else {
//         card.classList.add('flipped');
//     }
// }

// function showForgotPasswordCard() {
//     const card = document.querySelector('.card');
//     card.classList.add('showForgot');
// }

// function backToLogin() {
//     const card = document.querySelector('.card');
//     card.classList.remove('showForgot');
// }


// // function toggleVisibility() {
// //     const passwordField = document.getElementById('password');
// //     const toggleIcon = document.getElementById('togglePassword');

// //     if (passwordField.type === 'password') {
// //         passwordField.type = 'text';
// //         toggleIcon.textContent = '🙈'; // Change to the 'closed eye' representation
// //     } else {
// //         passwordField.type = 'password';
// //         toggleIcon.textContent = '👁️'; // Change back to the 'open eye' representation
// //     }
// // }



// function toggleVisibility(id, iconId) {
//     const passwordField = document.getElementById(id);
//     const eyeIcon = document.getElementById(iconId);
    
//     if (passwordField.type === 'password') {
//         passwordField.type = 'text';
//         eyeIcon.classList.remove('fa-eye');
//         eyeIcon.classList.add('fa-eye-slash');
//     } else {
//         passwordField.type = 'password';
//         eyeIcon.classList.remove('fa-eye-slash');
//         eyeIcon.classList.add('fa-eye');
//     }
// }

// function flipCard() {
//     const card = document.querySelector('.card');
//     card.classList.toggle('flipped');
// }

// function showForgotPasswordCard() {
//     const card = document.querySelector('.card');
//     card.classList.add('showForgot');
// }

// function backToLogin() {
//     const card = document.querySelector('.card');
//     card.classList.remove('showForgot');
// }


function toggleVisibility(id, iconId) {
    const passwordField = document.getElementById(id);
    const eyeIcon = document.getElementById(iconId);
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}

function flipCard() {
    const card = document.querySelector('.card');
    card.classList.toggle('flipped');
}

function showForgotPasswordModal() {
    const modal = document.getElementById('forgotPasswordModal');
    modal.style.display = 'flex';
}

function backToLogin() {
    const modal = document.getElementById('forgotPasswordModal');
    modal.style.display = 'none';
}
