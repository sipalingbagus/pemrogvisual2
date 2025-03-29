<?php
$host = 'localhost';
$user = 'root';
$password = ''; // Sesuaikan dengan password MySQL Anda
$dbname = 'polisi_db'; // Sesuaikan dengan nama database Anda

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}
?>
