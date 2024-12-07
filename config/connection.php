<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'db_crud';

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Mengecek koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
}

// Jika koneksi berhasil
// echo 'Koneksi berhasil';

?>
