
function initializeDashboardScripts(){
    
    // begining dashboard scripts
    
        // Fetch chart data
        fetch('./dashboard/fetch-chart-data.php')
            .then(response => response.json())
            .then(data => {
                const offertoryLabels = data.offertory.length ? data.offertory.map(item => `Week ${item.week}`) : ['No Offertory Record Available'];
                const offertoryValues = data.offertory.length ? data.offertory.map(item => item.total) : [0];
    
                const attendanceLabels = data.attendance.length ? data.attendance.map(item => `Week ${item.week}`) : ['No Attendance Record Available'];
                const attendanceValues = data.attendance.length ? data.attendance.map(item => item.total) : [0];
    
                // Create Offertory Chart
                const offertoryCtx = document.getElementById('offertoryChart').getContext('2d');
                new Chart(offertoryCtx, {
                    type: 'line',
                    data: {
                        labels: offertoryLabels,
                        datasets: [{
                            label: 'Offertory',
                            data: offertoryValues,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });
    
                // Create Attendance Chart
                const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
                new Chart(attendanceCtx, {
                    type: 'line',
                    data: {
                        labels: attendanceLabels,
                        datasets: [{
                            label: 'Attendance',
                            data: attendanceValues,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true
                    }
                });
            })
            .catch(error => console.error('Error fetching chart data:', error));
            // end of dashboard scripts
    };




const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const sidebarTitle = document.getElementById("sidebarTitle");
const sidebarText = document.querySelectorAll(".sidebar-text");
const hamburger = document.getElementById("hamburger");
const churchIcon = document.getElementById("churchIcon");

//Set up responsive slider hiding
hamburger.addEventListener("click", () => {
    if (sidebar.classList.contains("w-64")) {
        sidebar.classList.replace("w-64", "w-16");
        content.classList.replace("ml-64", "ml-16");
        sidebarTitle.style.display = "none";
        churchIcon.style.display = "none";
        content.style.marginLeft = "4rem"; // Adjust for the smaller sidebar width
        sidebarText.forEach((text) => (text.style.display = "none"));
    } else {
        sidebar.classList.replace("w-16", "w-64");
        content.classList.replace("ml-16", "ml-64");
        sidebarTitle.style.display = "inline";
        churchIcon.style.display = "inline";
        content.style.marginLeft = "16rem"; // Adjust for the larger sidebar width
        sidebarText.forEach((text) => (text.style.display = "inline"));

    }
});


//Automatic Page Loading
document.querySelectorAll(".sidebar-link").forEach((link) => {
    link.addEventListener("click", function (event) {
        event.preventDefault();
        const page = this.getAttribute("data-page");

        // Store the last opened page in localStorage
        localStorage.setItem("lastPage", page);
        const lastPage = localStorage.getItem("lastPage");

        // Remove active class from all links
        document.querySelectorAll(".sidebar-link").forEach((link) => {
            link.classList.remove("bg-gray-700", "text-white");
        });

        // Add active class to the clicked link
        this.classList.add("bg-gray-700", "text-white");

        // Load the selected page
        fetch(page)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`Could not load ${page}`);
                }
                return response.text();
            })
            .then((html) => {
                document.getElementById("content").innerHTML = html;

                //initializeDashboardScripts
                if (lastPage === "./dashboard/dashboard.php") {
                    initializeDashboardScripts();
                   
                }
            })
            .catch((error) => console.error("Error:", error));
    });
});

// Load the last page and set the active link
window.addEventListener("DOMContentLoaded", (event) => {
    const lastPage = localStorage.getItem("lastPage") || "./dashboard/dashboard.php"; // Default to dashboard if no lastPage


    fetch(lastPage)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Could not load ${lastPage}`);
            }
            return response.text();
        })
        .then((html) => {
            document.getElementById("content").innerHTML = html;

            //initializeDashboardScripts
            if (lastPage === "./dashboard/dashboard.php") {
                initializeDashboardScripts();
               
            }

            // Highlight the active sidebar link
            const activeLink = document.querySelector(
                `[data-page="${lastPage}"]`
            );
            if (activeLink) {
                activeLink.classList.add("bg-gray-700", "text-white");
            }


        })
        .catch((error) => console.error("Error:", error));





});

/*
// Function to initialize the dashboard scripts
function initializeDashboardScripts() {
    const offertoryCtx = document.getElementById('offertoryChart').getContext('2d');
    const offertoryChart = new Chart(offertoryCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Offertory',
                data: [100, 150, 200, 450],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
        }
    });


    const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(attendanceCtx, {
        type: 'line',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [{
                label: 'Attendance',
                data: [80, 85, 90, 95],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
        }
    });
}*/