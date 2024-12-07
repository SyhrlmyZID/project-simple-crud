<?php
// Session
session_start();

// Hapus session
session_unset();
session_destroy();

// Hapus cookie
if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', '', time() - 3600, '/');
}

// Redirect ke halaman login setelah logout
header('Location: ../auth/login.php');
exit();
?>
