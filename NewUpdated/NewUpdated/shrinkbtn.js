// JavaScript for extending and retracting the side menu
const toggleMenuButton = document.getElementById('toggleMenuButton');
const sideMenu = document.querySelector('.side-menu');
const content = document.querySelector('.content');

toggleMenuButton.addEventListener('click', () => {
    sideMenu.classList.toggle('retracted');
    content.classList.toggle('menu-extended');
    toggleMenuButton.classList.toggle('menu-extended');
});