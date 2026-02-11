@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Student Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, John! Here's what's happening with your reports.</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Submitted -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="bg-blue-500 rounded-lg p-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Submitted</p>
                    <p class="text-3xl font-bold text-gray-900">12</p>
                </div>
            </div>
        </div>

        <!-- Pending Review -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="bg-orange-500 rounded-lg p-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Pending Review</p>
                    <p class="text-3xl font-bold text-gray-900">3</p>
                </div>
            </div>
        </div>

        <!-- Resolved -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="bg-green-500 rounded-lg p-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Resolved</p>
                    <p class="text-3xl font-bold text-gray-900">9</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Overview & Recent Updates -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Activity Overview Chart -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Activity Overview</h2>
            <div class="relative" style="height: 300px;">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Recent Updates -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Recent Updates</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900">Admin responded to "Cafeteria Issue"</p>
                        <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900">Admin responded to "Cafeteria Issue"</p>
                        <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-900">Admin responded to "Cafeteria Issue"</p>
                        <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <a href="#" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All Notifications</a>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    
    // Data yang persis kayak di gambar - kurva smooth dengan 2 puncak
    const activityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['', '', '', '', '', '', '', '', '', '', '', '', '', '', ''],
            datasets: [{
                label: 'Activity',
                data: [0, 0.3, 0.6, 0.9, 1.0, 1.05, 1.0, 0.7, 0.3, 0.1, 0.5, 1.3, 1.8, 2.0, 1.9, 1.5, 1.0, 0.6, 0.2, 0.05, 0, 0],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.05)',
                borderWidth: 3,
                tension: 0.5,
                fill: true,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#3b82f6',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: '#1f2937',
                    padding: 12,
                    borderRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Activity: ' + context.parsed.y.toFixed(1);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 2.5,
                    ticks: {
                        stepSize: 0.5,
                        font: {
                            size: 11
                        },
                        color: '#9ca3af',
                        padding: 10
                    },
                    grid: {
                        color: '#f3f4f6',
                        drawBorder: false,
                        lineWidth: 1
                    },
                    border: {
                        display: false
                    }
                },
                x: {
                    ticks: {
                        display: false
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    border: {
                        display: false
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
</script>
@endsection