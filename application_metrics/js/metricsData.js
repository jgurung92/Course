
document.addEventListener('DOMContentLoaded', function () {
    // Fetch data embedded in the HTML
    const pageViewsData = JSON.parse(document.getElementById('pageViewsData').textContent);
    const bounceRateData = JSON.parse(document.getElementById('bounceRateData').textContent);
    const conversionRateData = JSON.parse(document.getElementById('conversionRateData').textContent);

    // Generate labels based on 'Created At' timestamps
    const labels = JSON.parse(document.getElementById('createdAtData').textContent)
        .map(date => new Date(date).toLocaleDateString());

    // Function to create pie charts
    function createChart(ctx, label, data, colors) {
        new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: colors,
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    }

    // Generate colors dynamically for chart
    function generateColors(dataLength) {
        return Array.from({ length: dataLength }, () => 
            `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.7)`
        );
    }

    // Create separate charts for Page Views, Bounce Rate, and Conversion Rate
    createChart(
        document.getElementById('pageViewsChart').getContext('2d'),
        'Page Views',
        pageViewsData,
        generateColors(pageViewsData.length)
    );

    createChart(
        document.getElementById('bounceRateChart').getContext('2d'),
        'Bounce Rate (%)',
        bounceRateData,
        generateColors(bounceRateData.length)
    );

    createChart(
        document.getElementById('conversionRateChart').getContext('2d'),
        'Conversion Rate (%)',
        conversionRateData,
        generateColors(conversionRateData.length)
    );
});