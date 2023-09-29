document.addEventListener('DOMContentLoaded', () => {

    // Definitions & Initializations
    const shrink_btn = document.querySelector(".shrink-btn");
    const search = document.querySelector(".search");
    const sidebar_links = document.querySelectorAll(".sidebar-links a");
    const active_tab = document.querySelector(".active-tab");
    const shortcuts = document.querySelector(".sidebar-links h4");
    const tooltip_elements = document.querySelectorAll(".tooltip-element");
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    let activeIndex;

    // Event Handlers
    shrink_btn && shrink_btn.addEventListener("click", handleShrinkClick);
    search && search.addEventListener("click", handleSearchClick);
    sidebar_links.forEach(link => link.addEventListener("click", handleSidebarLinkClick));
    tooltip_elements.forEach(elem => elem.addEventListener("mouseover", showTooltip));
    dropdownToggles.forEach(toggle => toggle.addEventListener('click', handleDropdownToggleClick));
    document.addEventListener('click', handleDocumentClick);
    
    // ... All your function definitions ...

});

function handleShrinkClick() {
    document.body.classList.toggle("shrink");
    setTimeout(moveActiveTab, 400);
    this.classList.add("hovered");
    setTimeout(() => {
        this.classList.remove("hovered");
    }, 500);
}

function handleSearchClick() {
    document.body.classList.remove("shrink");
    this.lastElementChild.focus();
}

function handleSidebarLinkClick(event) {
    event.preventDefault();

    sidebar_links.forEach(sideLink => sideLink.classList.remove("active"));
    this.classList.add("active");
    activeIndex = this.dataset.active;

    moveActiveTab();
    loadContent(this.getAttribute('href'));
}

function handleDropdownToggleClick(event) {
    event.preventDefault();
    dropdownToggles.forEach(innerToggle => {
        if (innerToggle !== this) {
            innerToggle.nextElementSibling.style.display = 'none';
        }
    });

    const menu = this.nextElementSibling;
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

function handleDocumentClick(event) {
    if (!event.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    }
}

// ... Rest of your function definitions ...

