<?php
// Start session
session_start();

// Include database connection
require_once 'koneksi.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Get and sanitize input
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    $name = trim($_POST['name']);
    $birthplace = trim($_POST['birthplace']);
    $birthdate = $_POST['birthdate'];
    $rank = $_POST['rank'];

    // Check if required fields are empty
    if (empty($username) || empty($_POST['password']) || empty($name) || empty($birthplace) || empty($birthdate) || empty($rank)) {
        echo "<script>alert('Semua kolom wajib diisi!');</script>";
    } else {
        // Prepare SQL statement
        $sql = "INSERT INTO users (username, password, name, birthplace, birthdate, rank) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ssssss', $username, $password, $name, $birthplace, $birthdate, $rank);
            $stmt->execute();

            // Check if insertion was successful
            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
            } else {
                echo "<script>alert('Registrasi gagal! Username mungkin sudah digunakan.');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Terjadi kesalahan pada server.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Polisi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #fdf5e6; /* Latar belakang emas pucat */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-card {
            background-color: #fff8dc; /* Warna card emas lembut */
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 500px;
        }
        .register-card h2 {
            color: #b8860b; /* Warna teks emas */
        }
        .btn-primary {
            background-color: #b8860b; /* Warna tombol emas */
            border: none;
        }
        .btn-primary:hover {
            background-color: #8b6508;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h2 class="text-center">Form Pendaftaran Polisi</h2>
        <form method="POST" action="register.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="birthplace" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="birthplace" name="birthplace" required>
            </div>
            <div class="mb-3">
                <label for="birthdate" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
            <div class="mb-3">
                <label for="rank" class="form-label">Pangkat</label>
                <select class="form-select" id="rank" name="rank" required>
                    <option value="">Pilih Pangkat</option>
                    <option value="Brigadir">Brigadir</option>
                    <option value="Komisaris">Komisaris</option>
                    <option value="Inspektur">Inspektur</option>
                </select>
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Daftar</button>
        </form>
    </div>
</body>
</html>
