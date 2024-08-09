

    document.addEventListener('DOMContentLoaded', function() {
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
    });
    
