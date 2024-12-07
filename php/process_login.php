<?php
// Koneksi database
require_once '../config/connection.php';

// Variabel untuk menyimpan error pesan
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mengecek apakah email ada di database
    $query = "SELECT * FROM tbl_users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Langsung membandingkan password (tidak menggunakan hashing)
        if ($password === $user['password']) {
            // Set session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            // Set cookies "Ingat Saya" jika checkbox dicentang
            if (isset($_POST['remember'])) {
                $cookie_name = 'user_email';
                $cookie_value = $email;
                setcookie($cookie_name, $cookie_value, time() + (7 * 24 * 60 * 60), "/");
            }

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header('Location: ../admin/index.php');
            } else {
                header('Location: ../pages/index.php');
            }
            exit();
        } else {
            $error = 'Password Salah!';
        }
    } else {
        $error = 'Email Atau Password Salah!';
    }
}

// Redirect ke halaman login dengan error
if ($error) {
    header("Location: ../auth/login.php?error=" . urlencode($error));
    exit();
}
?>
