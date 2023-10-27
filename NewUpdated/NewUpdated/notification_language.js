document.addEventListener("DOMContentLoaded", function() {
    const alarmIcon = document.getElementById('alarm-icon');
    const popup = document.getElementById('alarm-popup');
    const alarmsList = document.querySelector('.alarms-list');
    const seeAllLink = createSeeAllLink();

    function loadAlarmsFromLocalStorage() {
        const savedAlarms = JSON.parse(localStorage.getItem('alarms')) || [];
        savedAlarms.forEach(message => {
            const alarmDiv = createAlarmDiv(message);
            alarmsList.appendChild(alarmDiv);
        });
        alarmsList.appendChild(seeAllLink);
    }

    function saveAlarmToLocalStorage(message) {
        const currentAlarms = JSON.parse(localStorage.getItem('alarms')) || [];
        if (currentAlarms.length >= 3) {
            currentAlarms.shift(); // Remove the oldest alarm
        }
        currentAlarms.push(message);
        localStorage.setItem('alarms', JSON.stringify(currentAlarms));
    }

    function updateLocalStorageCount() {
        const countElem = document.getElementById('notification-count');
        localStorage.setItem('notificationCount', countElem.textContent);
    }

    function createAlarmDiv(message) {
        const div = document.createElement('div');
        div.className = 'alarm-message';

        const text = document.createElement('span');
        text.textContent = message;
        div.appendChild(text);

        const closeButton = document.createElement('span');
        closeButton.innerHTML = "&times;";
        closeButton.style.float = 'right';
        closeButton.style.cursor = 'pointer';
        closeButton.onclick = function() {
            div.remove();
            const countElem = document.getElementById('notification-count');
            countElem.textContent = parseInt(countElem.textContent) - 1;
            updateLocalStorageCount();
        };
        div.appendChild(closeButton);

        const timestamp = new Date();
        const timeElem = document.createElement('div');
        timeElem.className = 'alarm-time';
        timeElem.textContent = 'Just now';
        timeElem.dataset.timestamp = timestamp.toISOString();
        div.appendChild(timeElem);

        return div;
    }

    function timeAgo(date) {
        const now = new Date();
        const seconds = Math.round((now - date) / 1000);
        const minutes = Math.round(seconds / 60);

        if (minutes === 0) return 'Just now';
        else if (minutes === 1) return '1 minute ago';
        else return `${minutes} minutes ago`;
    }

    setInterval(function() {
        const timeElements = document.querySelectorAll('.alarm-time');
        timeElements.forEach(function(elem) {
            const timestamp = new Date(elem.dataset.timestamp);
            elem.textContent = timeAgo(timestamp);
        });
    }, 60000);

    const alarms = ["PF is more than 0.85.", "Meter 1 is Over Current."];
    setInterval(function() {
        const randomAlarm = alarms[Math.floor(Math.random() * alarms.length)];
        const alarmDiv = createAlarmDiv(randomAlarm);
        alarmsList.insertBefore(alarmDiv, seeAllLink);
        saveAlarmToLocalStorage(randomAlarm);
        const countElem = document.getElementById('notification-count');
        countElem.textContent = parseInt(countElem.textContent) + 1;
        updateLocalStorageCount();
    }, 10000);

    alarmIcon.addEventListener('click', function(e) {
        e.stopPropagation();
        if (popup.style.display === "none" || popup.style.display === "") {
            popup.style.display = "block";
        } else {
            popup.style.display = "none";
        }
    });

    document.addEventListener('click', function() {
        popup.style.display = "none";
    });

    popup.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    loadAlarmsFromLocalStorage();
    const countElem = document.getElementById('notification-count');
    const savedCount = localStorage.getItem('notificationCount');
    if (savedCount) {
        countElem.textContent = savedCount;
    }
});

function createSeeAllLink() {
    const link = document.createElement('a');
    link.href = 'alarmactive.php';
    link.textContent = 'See All Alarms >';
    link.className = 'alarm-message see-all-link';
    link.style.textAlign = 'center';
    link.style.color = '#ffffff';
    link.style.background = '#2342b2';
    link.style.padding = '5px 10px';
    link.style.marginTop = '8px';
    link.style.borderRadius = '4px';
    link.style.transition = 'background 0.3s ease';

    link.onmouseover = function() {
        this.style.background = '#0D3360'; 
    }

    link.onmouseout = function() {
        this.style.background = '#2342b2';
    }

    return link;
}
