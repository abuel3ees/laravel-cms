document.addEventListener("DOMContentLoaded", () => {
    const articlesCtx = document.getElementById('articlesChart')?.getContext('2d');
    const usersCtx = document.getElementById('usersChart')?.getContext('2d');

    if (articlesCtx) {
        new Chart(articlesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Articles',
                    data: [12, 19, 3, 5, 2],
                    borderColor: '#FF7500',
                    backgroundColor: 'rgba(255, 117, 0, 0.2)',
                    tension: 0.3,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    if (usersCtx) {
        new Chart(usersCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Users',
                    data: [7, 11, 5, 8, 3],
                    backgroundColor: '#FF7500'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});
