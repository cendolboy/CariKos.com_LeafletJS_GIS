<?php
$host = ''; // Ganti dengan host database Anda
$user = ''; // Ganti dengan username database Anda
$password = ''; // Ganti dengan password database Anda
$dbname = 'carikos_com'; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
