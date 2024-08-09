
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











    //Member Scripts.
function initializeMemberScripts(){

        // Auto-filter members as user types in the search bar
        const searchBar = document.getElementById('searchBar');
        searchBar.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(function(row) {
                const memberName = row.querySelector('td:first-child').textContent.toLowerCase();
                if (memberName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    
        // Open Add Member Modal
        document.getElementById('addMemberBtn').addEventListener('click', function() {
            document.getElementById('addMemberModal').classList.remove('hidden');
        });
    
        // Close Add Member Modal
        document.getElementById('closeAddMemberModal').addEventListener('click', function() {
            document.getElementById('addMemberModal').classList.add('hidden');
        });
    
        // Open Edit Member Modal
        document.querySelectorAll('.editBtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const contact = this.getAttribute('data-contact');
                const address = this.getAttribute('data-address');
                const position = this.getAttribute('data-position');
    
                document.getElementById('editMemberId').value = id;
                document.getElementById('editMemberName').value = name;
                document.getElementById('editMemberEmail').value = email;
                document.getElementById('editMemberContact').value = contact;
                document.getElementById('editMemberAddress').value = address;
                document.getElementById('editMemberPosition').value = position;
    
                document.getElementById('editMemberModal').classList.remove('hidden');
            });
        });
    
        // Close Edit Member Modal
        document.getElementById('closeEditMemberModal').addEventListener('click', function() {
            document.getElementById('editMemberModal').classList.add('hidden');
        });
    
        // Add Member Form Submission
        document.getElementById('addMemberForm').addEventListener('submit', function(event) {
            event.preventDefault();
    
            const name = document.getElementById('memberName').value;
            const email = document.getElementById('memberEmail').value;
            const contact = document.getElementById('memberContact').value;
            const address = document.getElementById('memberAddress').value;
            const position = document.getElementById('memberPosition').value;
    
            // AJAX request to add member
            const xhr = new XMLHttpRequest();
            xhr.open('POST', './members/add_member.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    Swal.fire('Success', 'Member added successfully!', 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', 'There was an error adding the member.', 'error');
                }
            };
            xhr.send(`name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&contact=${encodeURIComponent(contact)}&address=${encodeURIComponent(address)}&position=${encodeURIComponent(position)}`);
        });
    
        // Edit Member Form Submission
        document.getElementById('editMemberForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const id = document.getElementById('editMemberId').value;
            const name = document.getElementById('editMemberName').value;
            const email = document.getElementById('editMemberEmail').value;
            const contact = document.getElementById('editMemberContact').value;
            const address = document.getElementById('editMemberAddress').value;
            const position = document.getElementById('editMemberPosition').value;

            // AJAX request to edit member
            const xhr = new XMLHttpRequest();
            xhr.open('POST', './members/edit_member.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.state === 'success') {
                        Swal.fire('Success', 'Member updated successfully!', 'success').then(() => {
                            location.reload();
                        });
                    } else if (response.state === 'duplicate') {
                        Swal.fire('Error', 'Email already exists!', 'error');
                    } else {
                        Swal.fire('Error', 'There was an error updating the member.', 'error');
                    }
                } else {
                    Swal.fire('Error', 'There was an error updating the member.', 'error');
                }
            };
            xhr.send(`id=${encodeURIComponent(id)}&name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&contact=${encodeURIComponent(contact)}&address=${encodeURIComponent(address)}&position=${encodeURIComponent(position)}`);
        });
        
    
        // Delete Member
        document.querySelectorAll('.deleteBtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
    
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This member will be deleted permanently.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', './members/delete_member.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                Swal.fire('Deleted!', 'Member has been deleted.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', 'There was an error deleting the member.', 'error');
                            }
                        };
                        xhr.send(`id=${encodeURIComponent(id)}`);
                    }
                });
            });
        });
   
}






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
                   
                }else if(lastPage === "./members/members.php"){
                    initializeMemberScripts();
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
               
            }else if(lastPage === "./members/members.php"){
                initializeMemberScripts();
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