<?php
// Koneksi database
require_once '../config/connection.php';

// Variabel untuk menyimpan error pesan
$error = '';

// Set role user default saat proses register
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'user';

    // Mengecek apakah email sudah ada di database
    $query = "SELECT * FROM tbl_users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Validasi email error jika tidak ada
        header('Location: ../auth/register.php?error=email_exists');
        exit();
    } else {
        // Jika email belum ada, maka akan membuat data baru
        $insertQuery = "INSERT INTO tbl_users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("ssss", $name, $email, $password, $role);

        if ($insertStmt->execute()) {
            // Redirect ke login page jika berhasil
            header('Location: ../auth/login.php');
            exit();
        } else {
            $error = 'Terjadi kesalahan, coba lagi!';
        }
    }
}
?>
