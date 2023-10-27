const reportTypeSelect = document.getElementById("reportType");
    const monthInput = document.getElementById("monthInput");
    const yearInput = document.getElementById("yearInput");
    const startDateInput = document.getElementById("startDate");
    const endDateInput = document.getElementById("endDate");
    const viewBtn = document.getElementById("viewBtn");
    const resultsTableBody = document.querySelector("table tbody");
    
    

    viewBtn.addEventListener("click", populateData);

    function populateData() {
        let content = "";
        let totalEnergy = 0; // Initialize total energy counter
        let totalBill = 0; // Initialize total bill counter
        const currentDate = new Date();
        const customStartDate = startDateInput.value;
        const customEndDate = endDateInput.value;

        if (customStartDate && customEndDate) {
            const daysInCustomRange = (new Date(customEndDate) - new Date(customStartDate)) / (1000 * 60 * 60 * 24);
            content = Array.from({ length: daysInCustomRange }, (_, i) => {
                const date = new Date(new Date(customStartDate).getTime() + i * 24 * 60 * 60 * 1000);
                totalEnergy += 50;
                totalBill += 100;
                return `<tr>
                    <td>${date.toISOString().split('T')[0]}</td>
                    <td>50 kWh</td>
                    <td>RM 100</td>
                </tr>`;
            }).join("");
            document.getElementById("selectedDateRange").innerText = `${customStartDate} to ${customEndDate}`;
        } 
        else if (reportTypeSelect.value === "monthly") {
            const selectedMonth = monthInput.value.split("-")[1];
            const selectedYear = monthInput.value.split("-")[0];
            const daysInMonth = (currentDate.getFullYear() === parseInt(selectedYear) && currentDate.getMonth() + 1 === parseInt(selectedMonth))
                ? currentDate.getDate() 
                : new Date(selectedYear, selectedMonth, 0).getDate();

            content = Array.from({ length: daysInMonth }, (_, i) => {
                totalEnergy += 50;
                totalBill += 100;
                return `<tr>
                    <td>${selectedYear}-${selectedMonth}-${String(i + 1).padStart(2, '0')}</td>
                    <td>50 kWh</td>
                    <td>RM 100</td>
                </tr>`;
            }).join("");
            document.getElementById("selectedDateRange").innerText = monthInput.value;
        } 
        else {
            const selectedYear = yearInput.value;
            const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            
            content = months.map(month => {
                totalEnergy += 1500;
                totalBill += 3000;
                return `<tr>
                    <td>${month} ${selectedYear}</td>
                    <td>1500 kWh</td>
                    <td>RM 3000</td>
                </tr>`;
            }).join("");
            document.getElementById("selectedDateRange").innerText = yearInput.value;
        }

        // Append the total row at the end
        content += `<tr style="font-weight:bold;">
                        <td>Total</td>
                        <td>${totalEnergy} kWh</td>
                        <td>RM ${totalBill}</td>
                    </tr>`;
        
        document.getElementById("selectedMeterId").innerText = document.getElementById("meterId").value;
        resultsTableBody.innerHTML = content;
    }

    // Populate year selector with years from the current year going back 10 years
    const currentYear = new Date().getFullYear();
    const yearOptions = Array.from({ length: 11 }, (_, i) => currentYear - i).map(year => `<option value="${year}">${year}</option>`).join("");
    yearInput.innerHTML = yearOptions;

    // Automatically show data for the current month on page load
    monthInput.value = new Date().toISOString().slice(0, 7);
    populateData();