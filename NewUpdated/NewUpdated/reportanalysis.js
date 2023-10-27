
// Existing scripts from "Comparison Data Meter"
let chart; // Variable to hold the Highcharts chart

        // Function to handle the "View Data" button click for Comparison Analysis
        document.getElementById('viewData').addEventListener('click', () => {
            // Get the entered Energy Meter IDs and split them by comma
            const meterIdsInput = document.getElementById('meterIds').value;
            const meterIds = meterIdsInput.split(',').map(id => id.trim());

            // Get the selected start and end dates
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            // Get the selected group-by option
            const groupBy = document.getElementById('groupBy').value;

            // Replace the following call with your data retrieval logic for Comparison Analysis
            const comparisonChartData = fetchDataForComparisonAnalysis(meterIds, startDate, endDate, groupBy);

            // Update the chart with the retrieved data
            updateComparisonChart(comparisonChartData);
        });


        function updateComparisonChart(data) {
            if (chart) {
                chart.destroy();
            }
        
            chart = Highcharts.chart('comparisonChart', {
                chart: {
                    type: 'line',
                    backgroundColor: '#02275e',
                    borderWidth: 0,
                    plotBorderColor: 'transparent'
                },
                title: {
                    text: 'Energy Consumption Comparison',
                    style: {
                        color: '#fff'
                    },
                },
                xAxis: {
                    categories: data.categories,
                    labels: {
                        style: {
                            color: '#fff'
                        }
                    }
                },
                yAxis: {
                    title: {
                        text: 'Energy Consumption [kWh]',
                        style: {
                            color: '#fff'
                        }
                    },
                    labels: {
                        style: {
                            color: '#fff'
                        }
                    }
                },
                legend: {
                    itemStyle: {
                        color: '#fff'
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + Highcharts.numberFormat(this.y, 2) + ' kWh';
                    }
                },
                series: data.series,
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        borderColor: 'transparent'
                    }
                }
            });
        
            window.addEventListener('resize', () => {
                chart.setSize(window.innerWidth * 0.9, window.innerWidth * 0.9 * 0.6);
            });
        }

        // Function to retrieve data for Comparison Analysis
        function fetchDataForComparisonAnalysis(meterIds, startDate, endDate, groupBy) {
            // Create an array to store dummy data for each meter
            const seriesData = [];

            // Generate random data for each meter
            meterIds.forEach((meterId) => {
                const meterData = generateRandomData(startDate, endDate, groupBy);
                seriesData.push({
                    name: meterId,
                    data: meterData,
                });
            });

            // Generate categories (X-axis labels)
            const categories = generateCategories(startDate, endDate, groupBy);

            return {
                categories: categories,
                series: seriesData,
            };
        }

        // Function to generate random data for a meter
        function generateRandomData(startDate, endDate, groupBy) {
            // Replace this with your logic to generate realistic data
            const data = [];
            const dateRange = getDateRange(startDate, endDate, groupBy);

            // Generate random data points
            for (const date of dateRange) {
                data.push(Math.random() * 100); // Replace with your data generation logic
            }

            return data;
        }

        // Function to generate categories (X-axis labels)
        function generateCategories(startDate, endDate, groupBy) {
            // Replace this with your logic to generate realistic categories
            const categories = [];
            const dateRange = getDateRange(startDate, endDate, groupBy);

            for (const date of dateRange) {
                categories.push(date);
            }

            return categories;
        }

        // Function to generate a date range based on groupBy (e.g., hourly, daily, monthly)
        function getDateRange(startDate, endDate, groupBy) {
            // Replace this with your logic to generate a date range
            const dateRange = [];
            let currentDate = new Date(startDate);

            while (currentDate <= new Date(endDate)) {
                dateRange.push(currentDate.toISOString().slice(0, 10)); // Format as YYYY-MM-DD
                currentDate = incrementDate(currentDate, groupBy);
            }

            return dateRange;
        }

        // Function to increment a date by groupBy (e.g., hourly, daily, monthly)
        function incrementDate(date, groupBy) {
            // Replace this with your logic to increment a date based on groupBy
            const newDate = new Date(date);
            if (groupBy === 'hour') {
                newDate.setHours(newDate.getHours() + 1);
            } else if (groupBy === 'day') {
                newDate.setDate(newDate.getDate() + 1);
            } else if (groupBy === 'month') {
                newDate.setMonth(newDate.getMonth() + 1);
            } else if (groupBy === 'year') {
                newDate.setFullYear(newDate.getFullYear() + 1);
            }
            return newDate;
        }

// Existing scripts from "Comprehensive Analysis"
function generateDummyData(daysInMonth) {
    const dummyData = {};

    // Generate random consumption data for the charts
    const randomConsumption = () => Math.floor(Math.random() * 5000);

    dummyData.currentMonthConsumption = `${randomConsumption()} kWh`;
    dummyData.lastMonthConsumption = `${randomConsumption()} kWh`;
    dummyData.sameMonthLastYearConsumption = `${randomConsumption()} kWh`;
    dummyData.lastYearConsumption = `${randomConsumption()} kWh`;
    dummyData.averageMonthlyConsumption = `${randomConsumption()} kWh`;
    dummyData.averageDailyConsumption = `${randomConsumption()} kWh`;

    // Generate random data for the 3 Month Energy Usage chart
    dummyData.overallConsumptionChart = Array.from({ length: 3 }, () => randomConsumption());

    // Generate random data for the Daily Consumption by Day chart
    dummyData.dailyConsumptionByDayChart = Array.from({ length: daysInMonth }, () => randomConsumption());

    // Generate random data for the Daily Consumption by Day of the Week chart
    dummyData.dailyConsumptionByDayOfWeekChart = Array.from({ length: 7 }, () => randomConsumption());

    // Generate random data for the Weekends vs Weekdays Pie Chart
    dummyData.weekdaysWeekendsPieChart = [
        { name: "Weekdays", y: Math.floor(Math.random() * 100) },
        { name: "Weekends", y: Math.floor(Math.random() * 100) },
    ];

    // Generate random data for the Consumption by Day of the Week Pie Chart
    dummyData.dayOfWeekPieChart = [
        { name: "Monday", y: Math.floor(Math.random() * 100) },
        { name: "Tuesday", y: Math.floor(Math.random() * 100) },
        { name: "Wednesday", y: Math.floor(Math.random() * 100) },
        { name: "Thursday", y: Math.floor(Math.random() * 100) },
        { name: "Friday", y: Math.floor(Math.random() * 100) },
        { name: "Saturday", y: Math.floor(Math.random() * 100) },
        { name: "Sunday", y: Math.floor(Math.random() * 100) },
    ];

    // Generate random data for the Active Power History chart
    dummyData.activePowerHistoryChart = Array.from({ length: daysInMonth }, () => randomConsumption());
    return dummyData;
}

function updateComprehensiveData() {
    const selectTime = document.getElementById("selectTime").value;
    const [year, month] = selectTime.split("-");
    const daysInMonth = new Date(year, month, 0).getDate();
    const dummyData = generateDummyData(daysInMonth);

    // Update table data
    document.getElementById("currentMonthConsumption").textContent = dummyData.currentMonthConsumption;
    document.getElementById("lastMonthConsumption").textContent = dummyData.lastMonthConsumption;
    document.getElementById("sameMonthLastYearConsumption").textContent = dummyData.sameMonthLastYearConsumption;
    document.getElementById("lastYearConsumption").textContent = dummyData.lastYearConsumption;
    document.getElementById("averageMonthlyConsumption").textContent = dummyData.averageMonthlyConsumption;
    document.getElementById("averageDailyConsumption").textContent = dummyData.averageDailyConsumption;

    // Update the 3 Month Energy Usage chart to a column chart with white font color and blue background
    Highcharts.chart("overallConsumptionChart", {
        chart: {
            type: "column",
            backgroundColor: "#02275e", // Blue background color
        },
        title: {
            text: "3 Month Energy Usage",
            style: {
                color: "#fff" // Font color (white) for chart title
            }
        },
        xAxis: {
            categories: ["Current Month", "Last Month", "Same Month Last Year"],
            labels: {
                style: {
                    color: "#fff" // Font color (white) for xAxis labels
                }
            },
            title: {
                style: {
                    color: "#fff" // Font color (white) for xAxis title
                }
            }
        },
        yAxis: {
            title: {
                text: "Energy Usage [kWh]",
                style: {
                    color: "#fff" // Font color (white) for yAxis title
                }
            },
            labels: {
                style: {
                    color: "#fff" // Font color (white) for yAxis labels
                }
            }
        },
        legend: {
            itemStyle: {
                color: "#fff" // Font color (white) for legend items
            }
        },
        series: [
            {
                name: "Energy Usage",
                data: dummyData.overallConsumptionChart,
                borderWidth: 0
            },
        ],
    });

    // Update the Daily Consumption by Day chart to a column chart with white font color and blue background
    Highcharts.chart("dailyConsumptionByDayChart", {
        chart: {
            type: "column",
            backgroundColor: "#02275e", // Blue background color
            borderWidth: 0,
            plotBorderWidth: 0
        },
        title: {
            text: "Day of the Month",
            style: {
                color: "#fff", // Font color (white) for chart title
                fontSize: '16px'
            }
        },
        xAxis: {
            categories: Array.from({ length: daysInMonth }, (_, i) => `${i + 1}`),
            labels: {
                style: {
                    color: "#fff" // Font color (white) for xAxis labels
                }
            },
            title: {
                style: {
                    color: "#fff" // Font color (white) for xAxis title
                }
            }
        },
        yAxis: {
            title: {
                text: "Energy Usage [kWh]",
                style: {
                    color: "#fff" // Font color (white) for yAxis title
                }
            },
            labels: {
                style: {
                    color: "#fff" // Font color (white) for yAxis labels
                }
            }
        },
        legend: {
            itemStyle: {
                color: "#fff" // Font color (white) for legend items
            }
        },
        series: [
            {
                name: "Energy Usage",
                data: dummyData.dailyConsumptionByDayChart,
                borderWidth: 0
            },
        ],
    });

    // Update the Daily Consumption by Day of the Week chart to a column chart with white font color and blue background
    Highcharts.chart("dailyConsumptionByDayOfWeekChart", {
        chart: {
            type: "column",
            backgroundColor: "#02275e", // Blue background color
        },
        title: {
            text: "Day of the Week",
            style: {
                color: "#fff", // Font color (white) for chart title
                fontSize: '16px'
            }
        },
        xAxis: {
            categories: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
            labels: {
                style: {
                    color: "#fff", // Font color (white) for xAxis labels
                    
                }
            },
            title: {
                style: {
                    color: "#fff" // Font color (white) for xAxis title
                }
            }
        },
        yAxis: {
            title: {
                text: "Energy Usage [kWh]",
                style: {
                    color: "#fff" // Font color (white) for yAxis title
                }
            },
            labels: {
                style: {
                    color: "#fff" // Font color (white) for yAxis labels
                }
            }
        },
        legend: {
            itemStyle: {
                color: "#fff" // Font color (white) for legend items
            }
        },
        series: [
            {
                name: "Energy Usage",
                data: dummyData.dailyConsumptionByDayOfWeekChart,
                borderWidth: 0
            },
        ],
    });

        // Update the Weekends vs Weekdays Pie Chart with white font color, blue background, and font size for labels
        Highcharts.chart("weekdaysWeekendsPieChart", {
        chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: "pie",
        backgroundColor: "#02275e", // Blue background color
        borderWidth: 0,
        borderColor: 'none',

        
        },
        title: {
        text: "Weekends vs Weekdays Comparison",
        style: {
            color: "#fff", // Font color (white) for chart title
            fontSize: '16px' // Font size for chart title
        }
        },
        legend: {
        itemStyle: {
            color: "#fff" // Font color (white) for legend items
            
        }
        },
        series: [
        {
            name: "Percentage",
            colorByPoint: true,
            data: dummyData.weekdaysWeekendsPieChart,
            borderWidth: 0,
            dataLabels: {
                style: {
                    color: "#fff", // Font color (white) for data labels
                    fontSize: '14px' // Font size for data labels
                    
                }
            }
        },
        ],
        });

        // Update the Weekends vs Weekdays Pie Chart with white font color, blue background, and font size for labels
        Highcharts.chart("weekdaysWeekendsPieChart", {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: "pie",
                backgroundColor: "#02275e", // Blue background color
                borderWidth: 0,
                borderColor: 'none'
            },
            title: {
                text: null  // Removes the chart title
            },
            legend: {
                itemStyle: {
                    color: "#fff" // Font color (white) for legend items
                }
            },
            series: [
                {
                    name: "Percentage",
                    colorByPoint: true,
                    data: dummyData.weekdaysWeekendsPieChart,
                    borderWidth: 0,
                    dataLabels: {
                        style: {
                            color: "#fff", // Font color (white) for data labels
                            fontSize: '14px' // Font size for data labels
                            
                        }
                    }
                }
            ],
        });

        // Update the Consumption by Day of the Week Pie Chart with white font color, blue background, and font size for labels
        Highcharts.chart("dayOfWeekPieChart", {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: "pie",
                backgroundColor: "#02275e", // Blue background color
                borderWidth: 0,           // Removes the border
                borderColor: 'none'       // Ensures there's no border color
            },
            title: {
                text: null  // Removes the chart title
            },
            legend: {
                itemStyle: {
                    color: "#fff" // Font color (white) for legend items
                }
            },
            series: [
                {
                    name: "Percentage",
                    colorByPoint: true,
                    data: dummyData.dayOfWeekPieChart,
                    borderWidth: 0,
                    dataLabels: {
                        style: {
                            color: "#fff", // Font color (white) for data labels
                            fontSize: '14px' // Font size for data labels
                        }
                    }
                }
            ],
        });



    // Update the Active Power History chart to a line chart with white font color and blue background
    Highcharts.chart("activePowerHistoryChart", {
        chart: {
            type: "line",
            backgroundColor: "#02275e", // Blue background color
            
        },
        title: {
            text: null  // Removes the chart title
        },
        xAxis: {
            categories: Array.from({ length: daysInMonth }, (_, i) => `${i + 1}`),
            title: {
                text: "Day of Month",
                style: {
                    color: "#fff" // Font color (white) for xAxis title
                }
            },
            labels: {
                style: {
                    color: "#fff" // Font color (white) for xAxis labels
                }
            }
        },
        yAxis: {
            title: {
                text: "Active Power (W)",
                style: {
                    color: "#fff" // Font color (white) for yAxis title
                }
            },
            labels: {
                style: {
                    color: "#fff" // Font color (white) for yAxis labels
                }
            }
        },
        legend: {
            itemStyle: {
                color: "#fff" // Font color (white) for legend items
            }
        },
        series: [
            {
                name: "Meter 1",
                data: dummyData.activePowerHistoryChart,
            },
            {
                name: "Meter 2",
                data: dummyData.activePowerHistoryChart,
            },
            {
                name: "Meter 3",
                data: dummyData.activePowerHistoryChart,
            },
        ],
    });
}

//TAB FUNCTION
// Automatically show current month's data when the page reloads
window.addEventListener("load", () => {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
    document.getElementById("selectTime").value = `${year}-${month}`;
    updateComprehensiveData();
});

// Call the update function on button click
document.getElementById("viewComprehensiveData").addEventListener("click", updateComprehensiveData);

function showTab(tabNumber) {
    // Remove 'active' class from all tabs
    const tabs = document.querySelectorAll(".tab");
    tabs.forEach(tab => {
        tab.classList.remove("active");
    });

    // Hide all content areas
    document.getElementById("tab1-content").style.display = "none";
    document.getElementById("tab2-content").style.display = "none";
    
    // Based on selected tab, set content to display and tab to active
    if (tabNumber === 1) {
        document.getElementById("tab1-content").style.display = "block";
        tabs[0].classList.add("active");
    } else if (tabNumber === 2) {
        document.getElementById("tab2-content").style.display = "block";
        tabs[1].classList.add("active");
    }
}

function initComparisonChart() {
    updateComparisonChart({
        categories: [],
        series: []
    });
}

// Wait for the page to load
document.addEventListener("DOMContentLoaded", function() {
    // Trigger the "View Data" button click event
    var viewDataButton = document.getElementById("viewData");
    if (viewDataButton) {
        viewDataButton.click();
    }

    // Display the content of the active tab
    showTab(1);
});
