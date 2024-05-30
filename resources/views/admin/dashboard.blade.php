<!-- Include Chart.js via CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@include('admin.layouts.navbar')

<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- User Count Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-4">Total Pengguna Terdaftar</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-subtitle mb-2 text-muted"><i class="fas fa-users me-2"></i> Jumlah Pengguna</h5>
                                            <p class="card-text fs-4">{{ $userCount }}</p>
                                        </div>
                                        <!-- Chart -->
                                        <canvas id="userChart" width="150" height="150"></canvas>
                                    </div>
                                    <hr>
                                    <p class="text-muted small">Data diperbarui secara real-time.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Transaction Status Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-4">Status Transaksi</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <ul class="list-unstyled mb-0">
                                                <li><span class="badge bg-success me-1">Sukses: {{ $settlementCount }}</span></li>
                                                <li><span class="badge bg-danger me-1">Dibatalkan: {{ $cancelCount }}</span></li>
                                                <li><span class="badge bg-warning me-1">Menunggu: {{ $pendingCount }}</span></li>
                                            </ul>
                                        </div>
                                        <!-- Chart -->
                                        <canvas id="transactionChart" width="150" height="150"></canvas>
                                    </div>
                                    <hr>
                                    <p class="text-muted small">Data status transaksi.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Vehicle Count Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-4">Total Kendaraan Terdaftar</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-subtitle mb-2 text-muted"><i class="fas fa-car me-2"></i> Jumlah Kendaraan</h5>
                                            <p class="card-text fs-4">{{ $vehicleCount }}</p>
                                        </div>
                                        <!-- Chart -->
                                        <canvas id="vehicleChart" width="150" height="150"></canvas>
                                    </div>
                                    <hr>
                                    <p class="text-muted small">Data mencakup semua jenis kendaraan.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Pengambilan-Pengembalian Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-4">Pengambilan & Pengembalian</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-subtitle mb-2 text-muted"><i class="fas fa-clipboard-list me-2"></i> Total Pengambilan</h5>
                                            <p class="card-text fs-4">{{ $pengambilanCount }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <h6 class="card-subtitle mb-2 text-muted">Riwayat Terbaru</h6>
                                        <ul class="list-unstyled">
                                            @foreach($recentPengambilanPengembalian as $record)
                                                <li class="mb-2">
                                                    <span class="badge bg-primary me-1">Pengambilan: {{ $record->tanggal_pengambilan }}</span>
                                                    <span class="badge bg-secondary">Pengembalian: {{ $record->tanggal_pengembalian }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <hr>
                                    <p class="text-muted small">Data pengambilan dan pengembalian terbaru.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Feedback Count Card -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 mb-4">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold mb-4">Feedback Rating</h5>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($feedbackCounts as $rating => $count)
                                                    <li><span class="badge bg-primary me-1">Rating {{ $rating }}: {{ $count }}</span></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <!-- Chart -->
                                        <canvas id="feedbackChart" width="150" height="150"></canvas>
                                    </div>
                                    <hr>
                                    <p class="text-muted small">Data rating feedback dari pengguna.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // User Chart
    var userCtx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(userCtx, {
        type: 'bar',
        data: {
            labels: ['Registered Users'],
            datasets: [{
                label: 'Total',
                data: [{{ $userCount }}],
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
    duration: 2000,
    easing: 'easeInOutCubic'
}
        }
    });

    // Transaction Status Chart
    var transactionCtx = document.getElementById('transactionChart').getContext('2d');
    var transactionChart = new Chart(transactionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Sukses', 'Dibatalkan', 'Menunggu'],
            datasets: [{
                label: 'Status Transaksi',
                data: [{{ $settlementCount }}, {{ $cancelCount }}, {{ $pendingCount }}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            animation: {
                duration: 2000,
                easing: 'easeInOutCubic'
            },
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Vehicle Chart
    var vehicleCtx = document.getElementById('vehicleChart').getContext('2d');
    var vehicleChart = new Chart(vehicleCtx, {
        type: 'bar',
        data: {
            labels: ['Registered Vehicles'],
            datasets: [{
                label: 'Total',
                data: [{{ $vehicleCount }}],
                backgroundColor: 'rgba(255, 159, 64, 0.8)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutCubic'
            }
        }
    });

    // Feedback Chart
    var feedbackCtx = document.getElementById('feedbackChart').getContext('2d');
    var feedbackLabels = [];
    var feedbackData = [];

    @foreach($feedbackCounts as $rating => $count)
        feedbackLabels.push('Rating {{ $rating }}');
        feedbackData.push({{ $count }});
    @endforeach

    var feedbackChart = new Chart(feedbackCtx, {
        type: 'bar',
        data: {
            labels: feedbackLabels,
            datasets: [{
                label: 'Jumlah Feedback',
                data: feedbackData,
                backgroundColor: [
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(153, 102, 255, 0.4)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutCubic'
            }
        }
    });
</script>
