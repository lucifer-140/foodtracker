<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Weekly Calorie Intake</h3>

                <div>
                    <canvas id="calorieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const chartLabels = @json($chartLabels);
            const chartData = @json($chartData);

            const ctx = document.getElementById('calorieChart').getContext('2d');

            new Chart(ctx, {
                type: 'line', // The type of chart we want to create
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'Total Calories',
                        data: chartData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.3, // Makes the line slightly curved
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // We can hide the legend if there's only one dataset
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
