function showSection(sectionId) {
    // Hide all content sections
    var sections = document.getElementsByClassName("content-section");
    for (var i = 0; i < sections.length; i++) {
        sections[i].classList.remove("active-section");
    }

    // Show the selected content section
    document.getElementById(sectionId).classList.add("active-section");

    // Update the active tab styling
    var tabs = document.querySelectorAll('.nav-tabs li');
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }
    document.querySelector('[onclick="showSection(\'' + sectionId + '\')"]').classList.add("active");
}