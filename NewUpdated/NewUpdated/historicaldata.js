function activateTab(tabName) {
    let iframe = document.getElementById("content-frame");
    switch (tabName) {
        case 'data-graph':
            iframe.src = 'datagraph.html';
            break;
        case 'power-quality':
            iframe.src = 'powerquality.html';
            break;
        case 'demand-analysis':
            iframe.src = 'demandanalysis.html';
            break;
        case 'energy-usage-and-billing':
            iframe.src = 'UsageBill.html';
            break;
        default:
            iframe.src = ''; // You can set a default behavior here if needed
            break;
    }

    let tabs = document.querySelectorAll('.nav-tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
        if (tab.textContent.trim().toLowerCase().replace(/ /g, '-') === tabName) {
            tab.classList.add('active');
        }
    });
}

// Function to activate the "Data Graph" tab
function activateDataGraphTab() {
    var dataGraphTab = document.getElementById('dataGraphTab');
    if (dataGraphTab) {
        dataGraphTab.click(); // Simulate a click on the tab button
    }
}

// Attach the function to the window.onload event to run it when the page loads
document.addEventListener('DOMContentLoaded', activateDataGraphTab);
