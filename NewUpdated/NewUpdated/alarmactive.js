document.addEventListener("DOMContentLoaded", function() {
  const searchButton = document.getElementById("search-button");
  const clearSelectionButton = document.getElementById("clear-selection-button");
  const exportDataButton = document.getElementById("export-data-button");
  const autoRefreshToggle = document.getElementById("auto-refresh-toggle");
  const autoRefreshStatus = document.getElementById("auto-refresh-status");
  const tableBody = document.getElementById("table-body");
  const confirmationModal = document.getElementById('confirmationModal');
  const confirmClear = document.getElementById('confirmClear');
  const cancelClear = document.getElementById('cancelClear');
  const alarmNotification = document.getElementById('alarmNotification');

  // New modal related elements
  const clearAlarmModal = document.getElementById('clearAlarmModal');
  const closeButton = clearAlarmModal.querySelector('.close-button');
  const confirmClearAlarm = document.getElementById('confirmClearAlarm');
  const cancelClearAlarm = document.getElementById('cancelClearAlarm');
  let alarmToClear; // Store which alarm is to be cleared

  let selectedRows = [];
  let autoRefreshInterval;

  const alarmsData = [];
  const historicalAlarms = [];

  function generateAlarm() {
      const severities = ["Critical", "Major", "Minor", "Warning"];
      const plants = ["Plant 1", "Plant 2","Plant 3", "Plant 4"];
      const devices = ["Device A", "Device B","Device C", "Device D"];
      const randomSeverity = severities[Math.floor(Math.random() * severities.length)];
      const randomPlant = plants[Math.floor(Math.random() * plants.length)];
      const randomDevice = devices[Math.floor(Math.random() * devices.length)];
      const alarmID = Math.floor(Math.random() * 100000);
      const alarmNames = ["L1 Connection lost", "Over Voltage", "Current too high", "THD I more than 0.7", "Over Current", "PF high"];
      const randomAlarmName = alarmNames[Math.floor(Math.random() * alarmNames.length)];

      const now = new Date();
      const occurrenceTime = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')} ${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')} AM`;

      return {
          severity: randomSeverity,
          plant: randomPlant,
          id: alarmID.toString(),
          alarmName: randomAlarmName,
          device: randomDevice,
          time: occurrenceTime
      };
  }

  function addNewAlarm() {
      const newAlarm = generateAlarm();
      alarmsData.push(newAlarm);
      populateTable();
  }

  function getSeverityIcon(severity) {
      switch (severity) {
          case "Critical":
              return '<i data-feather="alert-triangle" class="icon-critical"></i>';
          case "Major":
              return '<i data-feather="alert-octagon" class="icon-major"></i>';
          case "Minor":
              return '<i data-feather="alert-circle" class="icon-minor"></i>';
          case "Warning":
              return '<i data-feather="info" class="icon-warning"></i>';
          default:
              return '';
      }
  }

  function updateSeverityCounts() {
    const criticalCount = alarmsData.filter(alarm => alarm.severity === 'Critical').length;
    document.getElementById('critical-count').textContent = criticalCount;

    const majorCount = alarmsData.filter(alarm => alarm.severity === 'Major').length;
    document.getElementById('major-count').textContent = majorCount;

    const minorCount = alarmsData.filter(alarm => alarm.severity === 'Minor').length;
    document.getElementById('minor-count').textContent = minorCount;

    const warningCount = alarmsData.filter(alarm => alarm.severity === 'Warning').length;
    document.getElementById('warning-count').textContent = warningCount;
}

function filterAlarmsBySeverity(severity) {
    const filteredAlarms = severity ? alarmsData.filter(alarm => alarm.severity === severity) : alarmsData;
    renderAlarmsToTable(filteredAlarms);
}

function renderAlarmsToTable(alarms) {
    tableBody.innerHTML = "";
    alarms.forEach((alarm, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td><input type="checkbox" data-index="${index}"></td>
            <td>${getSeverityIcon(alarm.severity)} ${alarm.severity}</td>
            <td>${alarm.plant}</td>
            <td>${alarm.id}</td>
            <td>${alarm.alarmName}</td>
            <td>${alarm.device}</td>
            <td>${alarm.time}</td>
            <td>
                <button class="icon-button" title="Edit"><i class='bx bx-edit'></i></button>
                <button class="icon-button clear-alarm" data-index="${index}" title="Clear Alarm"><i class='bx bx-eraser'></i></button>
            </td>
        `;
        tableBody.appendChild(row);
    });

    feather.replace();
    updateSeverityCounts();
}

function populateTable() {
    renderAlarmsToTable(alarmsData);
}

tableBody.addEventListener('click', function(e) {
    if (e.target.classList.contains('clear-alarm')) {
        const alarmIndex = parseInt(e.target.getAttribute('data-index'), 10);
        const clearedAlarm = alarmsData.splice(alarmIndex, 1)[0];
        historicalAlarms.push(clearedAlarm);
        populateTable();
    }
});

clearSelectionButton.addEventListener("click", () => {
    selectedRows.forEach(row => {
        row.querySelector("input[type='checkbox']").checked = false;
        row.classList.remove("selected-row");
    });
    selectedRows = [];
});

searchButton.addEventListener("click", populateTable);

function startAutoRefresh() {
    return setInterval(addNewAlarm, 5000);
}

function toggleAutoRefresh() {
  if (autoRefreshToggle.checked) {
      autoRefreshStatus.textContent = "On";
      if (autoRefreshInterval) {
          clearInterval(autoRefreshInterval);
      }
      autoRefreshInterval = startAutoRefresh();
  } else {
      autoRefreshStatus.textContent = "Off";
      clearInterval(autoRefreshInterval);
  }
}

// Attach event listener to the toggle
autoRefreshToggle.addEventListener("change", toggleAutoRefresh);

// Trigger the toggleAutoRefresh function to start auto-refresh by default on page load
toggleAutoRefresh();


// Add legend event listeners
document.querySelectorAll('.legend-item').forEach(item => {
    item.addEventListener('click', function() {
        const severity = this.getAttribute('data-filter');
        filterAlarmsBySeverity(severity);
    });
});

autoRefreshToggle.addEventListener("change", toggleAutoRefresh);
populateTable();
});


