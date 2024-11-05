<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Status Distribution</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Task Status Distribution</h1>
    <canvas id="taskChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('taskChart').getContext('2d');
        const taskChart = new Chart(ctx, {
            type: 'bar', // or 'pie', 'doughnut', etc.
            data: {
                labels: ['Pending', 'In Progress', 'Completed'],
                datasets: [{
                    label: '# of Tasks',
                    data: [
                        {{ $taskCounts['pending'] ?? 0 }},
                        {{ $taskCounts['in_progress'] ?? 0 }},
                        {{ $taskCounts['completed'] ?? 0 }},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
