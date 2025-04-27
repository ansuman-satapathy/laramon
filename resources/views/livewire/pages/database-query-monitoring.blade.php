<style>
    #table-perPage {
        padding: 11px;
    }

    input[placeholder="Search"] {
        padding-left: 5px;
    }
</style>

<div class="p-6 space-y-6">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Database Query Monitoring</h1>

    <div class="p-6 space-y-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Slow DB Queries</h2>
        <livewire:laramon.recent-db-queries-table />
    </div>

    <div class="mt-6">
        <script>
            window.slowQueryData = @json($slowQueryData);
        </script>

        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Slow Queries (Historical)</h2>
        <div class="bg-white dark:bg-zinc-900 shadow-md rounded-lg p-6 mt-4">
            <canvas id="slowQueriesChart" class="h-64"></canvas>
        </div>
    </div>
</div>

@script
<script>

    const ctx = document.getElementById('slowQueriesChart').getContext('2d');

    const data = window.slowQueryData;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Slow Queries',
                data: data.values,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Hour'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Queries'
                    }
                }
            }
        }
    });
</script>
@endscript