document.addEventListener('DOMContentLoaded', function () {
    const { labels, articleData, userData } = window.chartData;

    const articlesCtx = document.getElementById('articlesChart').getContext('2d');
    new Chart(articlesCtx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Articles',
                data: articleData,
                borderColor: '#FF7500',
                backgroundColor: 'rgba(255, 117, 0, 0.2)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const usersCtx = document.getElementById('usersChart').getContext('2d');
    new Chart(usersCtx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label: 'Users',
                data: userData,
                backgroundColor: '#FF7500'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
