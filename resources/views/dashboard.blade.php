@extends('layouts.headerapp')
@section('content')
    <!-- Export buttons section - made more responsive -->
    <div class="flex flex-wrap justify-between gap-4 m-4">
        <button
            class="before:ease relative h-12 w-40 overflow-hidden border border-black shadow-2xl before:absolute before:left-0 before:-ml-2 before:h-48 before:w-48 before:origin-top-right before:-translate-x-full before:translate-y-12 before:-rotate-90 before:bg-gray-900 before:transition-all before:duration-300 hover:text-white hover:shadow-black hover:before:-rotate-180">
            <a href="{{ route('export.pdf') }}" class="relative z-10">Export PDF</a>
        </button>

        <button
            class="before:ease relative h-12 w-40 overflow-hidden border border-black shadow-2xl before:absolute before:left-0 before:-ml-2 before:h-48 before:w-48 before:origin-top-right before:-translate-x-full before:translate-y-12 before:-rotate-90 before:bg-gray-900 before:transition-all before:duration-300 hover:text-white hover:shadow-black hover:before:-rotate-180">
            <a href="{{ route('export.csv') }}" class="relative z-10">Export CSV</a>
        </button>
    </div>
    @foreach(auth()->user()->unreadNotifications as $notification)
    <div class="p-4 mb-4 text-sm text-green-800 bg-green-50 rounded-lg">
        {{ $notification->data['message'] }}
        <a>View Ticket</a>
    </div>
@endforeach

    <!-- Charts section - improved height settings -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
        <!-- Gender Distribution -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Gender Distribution</h2>
            <div class="h-64 sm:h-72">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <!-- Organizations Represented -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Organizations Represented</h2>
            <div class="h-64 sm:h-72">
                <canvas id="organizationChart"></canvas>
            </div>
        </div>

        <!-- Interests -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Interests</h2>
            <div class="h-64 sm:h-72">
                <canvas id="interestsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Download buttons section - made more responsive -->
    <div class="flex flex-wrap justify-between gap-4 m-4">
        <button
            class="relative h-[50px] w-40 overflow-hidden border border-green-900 bg-white text-green-900
            shadow-2xl transition-all before:absolute before:left-0 before:right-0 before:top-0 before:h-0 
            before:w-full before:bg-green-900 before:duration-500 after:absolute after:bottom-0 after:left-0 
            after:right-0 after:h-0 after:w-full after:bg-green-900 after:duration-500 hover:text-white hover:shadow-green-900 
            hover:before:h-2/4 hover:after:h-2/4">
            <a href="{{ route('export.new_pdf') }}" class="relative z-10">Download PDF</a>
        </button>

        <button
            class="group relative min-h-[50px] w-40 overflow-hidden border border-purple-500 bg-white text-purple-500 shadow-2xl transition-all before:absolute before:left-0 before:top-0 before:h-0 before:w-1/4 before:bg-purple-500 before:duration-500 after:absolute after:bottom-0 after:right-0 after:h-0 after:w-1/4 after:bg-purple-500 after:duration-500 hover:text-white hover:before:h-full hover:after:h-full">
            <span
                class="top-0 flex h-full w-full items-center justify-center before:absolute before:bottom-0 before:left-1/4 before:z-0 before:h-0 before:w-1/4 before:bg-purple-500 before:duration-500 after:absolute after:right-1/4 after:top-0 after:z-0 after:h-0 after:w-1/4 after:bg-purple-500 after:duration-500 hover:text-white group-hover:before:h-full group-hover:after:h-full"></span>
            <a href="{{ route('export.new_csv') }}" class="absolute bottom-0 left-0 right-0 top-0 z-10 flex h-full w-full items-center justify-center group-hover:text-white">Download CSV</a>
        </button>
    </div>
    
    <!-- Responsive Table with improved scrolling behavior -->
    <div class="px-4 pb-6">
        <div class="relative overflow-x-auto  sm:rounded-lg">
            <div class="block w-full overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-300">
                    <thead class="text-xs uppercase bg-gray-800 sticky top-0">
                        <tr>
                            <th scope="col" class="px-3 py-2 text-gray-200">ID</th>
                            <th scope="col" class="px-3 py-2 text-gray-200">CIVILITY</th>
                            <th scope="col" class="px-3 py-2 text-gray-200">FIRSTNAME</th>
                            <th scope="col" class="px-3 py-2 text-gray-200">LASTNAME</th>
                            <th scope="col" class="px-3 py-2 text-gray-200 hidden md:table-cell">ORGANIZATION</th>
                            <th scope="col" class="px-3 py-2 text-gray-200 hidden md:table-cell">E-MAIL</th>
                            <th scope="col" class="px-3 py-2 text-gray-200">PHONE</th>
                            <th scope="col" class="px-3 py-2 text-gray-200 hidden lg:table-cell">JOB</th>
                            <th scope="col" class="px-3 py-2 text-gray-200">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-700 bg-gray-900 hover:bg-gray-800">
                                <td class="px-3 py-2 text-gray-300">{{ $user->id }}</td>
                                <td class="px-3 py-2 text-gray-300">{{ $user->civility }}</td>
                                <td class="px-3 py-2 text-gray-300">{{ $user->firstName }}</td>
                                <td class="px-3 py-2 text-gray-300">{{ $user->lastName }}</td>
                                <td class="px-3 py-2 text-gray-300 hidden md:table-cell">{{ $user->organization }}</td>
                                <td class="px-3 py-2 text-gray-300 hidden md:table-cell">{{ $user->email }}</td>
                                <td class="px-3 py-2 text-gray-300">{{ $user->phone }}</td>
                                <td class="px-3 py-2 text-gray-300 hidden lg:table-cell">{{ $user->job }}</td>
                                <td class="px-3 py-2">
                                    <div class="flex flex-wrap gap-1">
                                        <a  href="{{ route('dashboard.guest.edit', $user->id) }}"  class="px-2 py-1 text-xs text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                                        <form action="{{route( 'dashboard.guest.destroy', $user->id)}}"   method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 text-xs text-white bg-red-500 rounded hover:bg-red-600" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
               
 {{ $users->links() }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Function to generate random colors
        function getRandomColors(count) {
            let colors = [];
            for (let i = 0; i < count; i++) {
                colors.push(`hsl(${Math.floor(Math.random() * 360)}, 70%, 50%)`);
            }
            return colors;
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Gender Distribution (Fixed Colors)
            new Chart(document.getElementById('genderChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Monsieur', 'Madame'],
                    datasets: [{
                        data: [{{ $genderDistribution['Monsieur'] ?? 0 }},
                            {{ $genderDistribution['Madame'] ?? 0 }}
                        ],
                        backgroundColor: ['#3498db', '#e74c3c'] // Fixed colors
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                font: {
                                    size: window.innerWidth < 768 ? 10 : 12
                                }
                            }
                        }
                    }
                }
            });

            // Organizations Represented (Dynamic Colors)
            const organizationLabels = {!! json_encode($organizations->keys()) !!};
            new Chart(document.getElementById('organizationChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: organizationLabels,
                    datasets: [{
                        label: 'Companies',
                        data: {!! json_encode($organizations->values()) !!},
                        backgroundColor: getRandomColors(organizationLabels.length)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: window.innerWidth < 768 ? 8 : 10
                                },
                                maxRotation: 90,
                                minRotation: 45
                            }
                        }
                    }
                }
            });

            // Interests (Dynamic Colors)
            const interestLabels = {!! json_encode($interests->keys()) !!};
            new Chart(document.getElementById('interestsChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: interestLabels,
                    datasets: [{
                        label: 'Interests',
                        data: {!! json_encode($interests->values()) !!},
                        backgroundColor: getRandomColors(interestLabels.length)
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                font: {
                                    size: window.innerWidth < 768 ? 8 : 10
                                },
                                maxRotation: 90,
                                minRotation: 45
                            }
                        }
                    }
                }
            });

            // Handle window resize to adjust font sizes
            window.addEventListener('resize', function() {
                Chart.instances.forEach(chart => {
                    if (chart.options.plugins.legend && chart.options.plugins.legend.labels) {
                        chart.options.plugins.legend.labels.font.size = window.innerWidth < 768 ? 10 : 12;
                    }
                    if (chart.options.scales && chart.options.scales.x && chart.options.scales.x.ticks) {
                        chart.options.scales.x.ticks.font.size = window.innerWidth < 768 ? 8 : 10;
                    }
                    chart.update();
                });
            });
        });
    </script>
@endsection