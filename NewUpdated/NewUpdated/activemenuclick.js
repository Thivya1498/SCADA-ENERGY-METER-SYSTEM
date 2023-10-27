document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".side-menu ul li");

    menuItems.forEach((item) => {
        const submenu = item.querySelector(".submenu-content");
        if (submenu) {
            item.addEventListener("click", function () {
                // Toggle the 'submenu-open' class for the clicked menu item
                submenu.classList.toggle("submenu-open");
            });

            // Close the submenu when the mouse leaves the menu item
            item.addEventListener("mouseleave", function () {
                submenu.classList.remove("submenu-open");
            });
        }

        item.addEventListener("click", function () {
            // Remove the 'active' class from all menu items
            menuItems.forEach((menuItem) => {
                menuItem.classList.remove("active");
            });

            // Add the 'active' class to the clicked menu item
            this.classList.add("active");
        });
    });
});
