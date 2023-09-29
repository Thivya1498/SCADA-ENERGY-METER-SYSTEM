const shrink_btn = document.querySelector(".shrink-btn");
const search = document.querySelector(".search");
const sidebar_links = document.querySelectorAll(".sidebar-links a");
const active_tab = document.querySelector(".active-tab");
const shortcuts = document.querySelector(".sidebar-links h4");
const tooltip_elements = document.querySelectorAll(".tooltip-element");

let activeIndex;

shrink_btn.addEventListener("click", () => {
    document.body.classList.toggle("shrink");
    setTimeout(moveActiveTab, 400);

    shrink_btn.classList.add("hovered");
    setTimeout(() => {
        shrink_btn.classList.remove("hovered");
    }, 500);
});

search.addEventListener("click", () => {
    document.body.classList.remove("shrink");
    search.lastElementChild.focus();
});

function moveActiveTab() {
    let topPosition = activeIndex * 58 + 2.5;
    if (activeIndex > 3) {
        topPosition += shortcuts.clientHeight;
    }
    active_tab.style.top = `${topPosition}px`;
}

function changeLink(event) {
    event.preventDefault();

    sidebar_links.forEach((sideLink) => sideLink.classList.remove("active"));
    this.classList.add("active");

    activeIndex = this.dataset.active;

    moveActiveTab();
    
    loadContent(this.href);  // Load content when a link is clicked.
}

sidebar_links.forEach((link) => link.addEventListener("click", changeLink));

function showTooltip() {
    let tooltip = this.parentNode.lastElementChild;
    let spans = tooltip.children;
    let tooltipIndex = this.dataset.tooltip;

    Array.from(spans).forEach((sp) => sp.classList.remove("show"));
    spans[tooltipIndex].classList.add("show");
    tooltip.style.top = `${(100 / (spans.length * 2)) * (tooltipIndex * 2 + 1)}%`;
}

tooltip_elements.forEach((elem) => {
    elem.addEventListener("mouseover", showTooltip);
});

const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

dropdownToggles.forEach(toggle => {
    toggle.addEventListener('click', function(event) {
        event.preventDefault();

        dropdownToggles.forEach(innerToggle => {
            if (innerToggle !== toggle) {
                innerToggle.nextElementSibling.style.display = 'none';
            }
        });

        const menu = this.nextElementSibling;
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });
});

document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
    const sidebar_links = document.querySelectorAll(".sidebar-links a:not(.dropdown-toggle)");

    sidebar_links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            // Load the content from the link's href attribute
            loadContent(this.getAttribute('href'));

            // Reset active links and make the clicked link active
            sidebar_links.forEach((sideLink) => sideLink.classList.remove("active"));
            this.classList.add("active");
        });
    });

    function loadContent(pageURL) {
        const contentDiv = document.getElementById('main-content');

        fetch(pageURL)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                contentDiv.innerHTML = data;
            })
            .catch(error => {
                console.error("There was a problem with the fetch operation:", error);
            });
    }
});

allMenuLinks.forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();

        // Remove the active class from other links
        allMenuLinks.forEach(innerLink => {
            innerLink.classList.remove('active-item');
            innerLink.classList.remove('active-dropdown-item');
        });

        // Add the active class to the clicked link
        if (link.closest('.dropdown-menu')) {
            link.classList.add('active-dropdown-item');
        } else {
            link.classList.add('active-item');
        }

        // Load the content for the clicked link
        loadContent(link.getAttribute('href'));
    });
});
