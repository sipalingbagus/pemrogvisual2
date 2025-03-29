<?php
// dashboard.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #fdf5e6; /* Warna latar belakang emas pucat */
        }
        .navbar {
            background-color: #b8860b; /* Warna navbar emas */
        }
        .navbar-brand, .nav-link {
            color: #fff !important;
        }
        .card {
            background-color: #fff8dc; /* Warna card emas lembut */
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card h5, .card p {
            color: #b8860b; /* Warna teks emas */
        }
        .btn-danger {
            background-color: #b8860b; /* Tombol logout dengan warna emas */
            border: none;
        }
        .btn-danger:hover {
            background-color: #8b6508;
        }
        footer {
            background-color: #b8860b;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reports</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container mt-4">
        <h2 class="text-center text-dark">Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>

        <!-- Grafik -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title text-center">Statistik Pendaftaran</h5>
                    <canvas id="registrationChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title text-center">Distribusi Pangkat</h5>
                    <canvas id="rankChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Informasi Tambahan -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title">Total Pengguna Terdaftar</h5>
                    <p class="card-text">Jumlah total pengguna yang telah mendaftar: <strong>120</strong></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h5 class="card-title">Aktivitas Terbaru</h5>
                    <ul>
                        <li>Brigadir Sinta mendaftar pada 23 Maret 2025.</li>
                        <li>Komisaris Aldi memperbarui profilnya.</li>
                        <li>Inspektur Raka menyelesaikan pelatihan.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Informasi Scrollable -->
        <div class="mt-4">
            <div class="card p-3">
                <h5 class="card-title">Log Aktivitas</h5>
                <div style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Username</th>
                                <th>Aktivitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2025-03-23</td>
                                <td>brigadir_sinta</td>
                                <td>Login berhasil</td>
                            </tr>
                            <tr>
                                <td>2025-03-22</td>
                                <td>komisaris_aldi</td>
                                <td>Profil diperbarui</td>
                            </tr>
                            <tr>
                                <td>2025-03-21</td>
                                <td>inspektur_raka</td>
                                <td>Menyelesaikan pelatihan</td>
                            </tr>
                            <!-- Tambahkan data sesuai kebutuhan -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Dashboard Polisi. All rights reserved.</p>
    </footer>

    <script>
        // Grafik Statistik Pendaftaran
        const registrationChartCtx = document.getElementById('registrationChart').getContext('2d');
        const registrationChart = new Chart(registrationChartCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: [10, 15, 20, 25, 30, 35],
                    borderColor: '#b8860b',
                    backgroundColor: 'rgba(184, 134, 11, 0.2)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#b8860b'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#b8860b'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#b8860b'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Grafik Distribusi Pangkat
        const rankChartCtx = document.getElementById('rankChart').getContext('2d');
        const rankChart = new Chart(rankChartCtx, {
            type: 'doughnut',
            data: {
                labels: ['Brigadir', 'Komisaris', 'Inspektur'],
                datasets: [{
                    data: [40, 35, 25],
                    backgroundColor: ['#ffd700', '#daa520', '#b8860b'],
                    borderColor: ['#fff', '#fff', '#fff'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: '#b8860b'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
