<?php
// Session
session_start();

// Koneksi database
require_once '../config/connection.php';

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    $email = $_SESSION['email'];
} elseif (isset($_COOKIE['user_email'])) {
    $email = $_COOKIE['user_email'];

    // Validasi email
    $query = "SELECT * FROM tbl_users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Set session dari cookie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
    } else {
        // Cookie tidak valid, redirect ke login
        setcookie('user_email', '', time() - 3600, "/");
        header('Location: ../auth/login.php');
        exit();
    }
} else {
    // Tidak ada session atau cookie, redirect ke login
    header('Location: ../auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>SyhlmyZID | Home</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">

    <!-- Cdn | TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/index.css">

</head>

<body class="bg-gray-900 text-white font-mono">

    <!-- Navbar -->
    <nav class="flex items-center justify-between p-5 bg-gray-800 shadow-lg">
        <div class="flex items-center">
            <h2 class="font-bold text-3xl">SyhlmyZID</h2>
        </div>
        <div class="hidden md:flex space-x-6 items-center">
            <a href="#home" class="hover:text-green-500">Home</a>
            <a href="#about" class="hover:text-green-500">About</a>
            <a href="#gallery" class="hover:text-green-500">Gallery</a>
            <a href="#contact" class="hover:text-green-500">Contact</a>
            <a href="../php/process_logout.php" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-green-400 w-24 text-center font-medium">Logout</a>
        </div>
        <div class="md:hidden">
            <button id="menu-button" class="text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-800 p-5 space-y-4">
        <a href="#home" class="block text-white hover:text-green-500">Home</a>
        <a href="#about" class="block text-white hover:text-green-500">About</a>
        <a href="#gallery" class="block text-white hover:text-green-500">Gallery</a>
        <a href="#contact" class="block text-white hover:text-green-500">Contact</a>
        <a href="#logout" class="block bg-red-500 text-white py-2 px-4 rounded hover:bg-red-400">Logout</a>
    </div>

    <!-- Home Section -->
    <section class="text-center min-h-screen flex justify-center items-center flex-col hero-s">
        <h1 class="text-5xl font-bold mb-4">Simple Crud</h1>
        <p class="text-xl mb-6">Selamat Datang Di Project Website Crud. Website ini hanya untuk tugas sekolah saja<br>
            jika ingin mencoba project saya silahkan untuk username dan password ada di bawah ini:
        </p>
        
        <!-- Card Social Media -->
        <div class="grid grid-cols-1 sm:grid-cols-1 gap-8">
            <div class="bg-gray-800 p-6 rounded-lg border-2 border-green-500 text-white">
                <pre class="font-mono text-green-400">
Social Media Saya
Instagram: @syhrlmyz.id
Github: SyhrlmyZID
Youtube: SyhrlmyZID
Tiktok: @syhrlmyz.id
                </pre>
            </div>
        </div>
        
        <!-- Button Logout -->
        <a href="../php/process_logout.php" class="bg-transparent border border-red-500 text-white py-2 px-6 rounded-lg hover:bg-red-400 mt-6 transition-all duration-500">Logout!</a>

    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6 text-center">
        <p>&copy; 2024 SyhrlmyZID. All rights reserved.</p>
    </footer>



    <!-- Javascript Connect -->
    <script src="../assets/js/pages/index.js"></script>
</body>

</html>
