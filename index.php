<?php
// Session
session_start();

// Cek apakah user sudah login lewat session atau cookie
if (isset($_SESSION['user_id']) || isset($_COOKIE['user_email'])) {
    // Redirect user yang sudah login ke halaman yang sesuai
    header('Location: pages/index.php');
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
    <title>SyhlmyZID | Landing Page</title>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">

    <!-- Cdn | TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/index.css">

</head>

<body class="bg-gray-900 text-white font-mono">

    <!-- Navbar -->
    <nav class="flex items-center justify-between p-5 bg-gray-800 shadow-lg">
        <div class="flex items-center">
            <h2 class="font-bold text-3xl">SyhlmyZID</h2>
        </div>
        <div class="hidden md:flex space-x-6 items-center">
            <a href="../index.php" class="hover:text-green-500">Home</a>
            <a href="../index.php" class="hover:text-green-500">About</a>
            <a href="../index.php" class="hover:text-green-500">Gallery</a>
            <a href="../index.php" class="hover:text-green-500">Contact</a>
            <a href="auth/login.php"
                class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 w-24 text-center font-medium">Login</a>
            <a href="auth/register.php"
                class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 w-24 text-center font-medium">Register</a>
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
    </nav> <!-- End | Navbar -->

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-800 p-5 space-y-4">
        <a href="../index.php" class="block text-white hover:text-green-500">Home</a>
        <a href="../index.php" class="block text-white hover:text-green-500">About</a>
        <a href="../index.php" class="block text-white hover:text-green-500">Gallery</a>
        <a href="../index.php" class="block text-white hover:text-green-500">Contact</a>
        <a href="auth/login.php" class="block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400">Login</a>
        <a href="auth/register.php"
            class="block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400">Register</a>
    </div> <!-- End | Mobile Menu -->

    <!-- Home Section -->
    <section class="text-center min-h-screen flex justify-center items-center flex-col hero-s">
        <h1 class="text-5xl font-bold mb-4">Simple Crud</h1>
        <p class="text-xl mb-6">Selamat Datang Di Project Website Crud. Website ini hanya untuk tugas sekolah saja<br>
            jika ingin mencoba project saya silahkan untuk username dan password ada di bawah ini:
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            <div class="bg-gray-800 p-6 rounded-lg border-2 border-green-500 text-white">
                <pre class="font-mono text-green-400">
Akun User
Email: user@gmail.com
Password: user#1234
                </pre>
            </div>

            <div class="bg-gray-800 p-6 rounded-lg border-2 border-green-500 text-white">
                <pre class="font-mono text-green-400">
Akun Admin
Email: admin@gmail.com
Password: admin#1234
                </pre>
            </div>
        </div>

        <a href="auth/login.php"
            class="bg-transparent border border-green-500 text-white py-2 px-6 rounded-lg hover:bg-green-400 mt-6 transition-all duration-500">Mulai
            Sekarang!</a>

    </section> <!-- End | Home Section -->

    <!-- Footer -->
    <footer class="bg-gray-800 py-6 text-center">
        <p>&copy; 2024 SyhrlmyZID. All rights reserved.</p>
    </footer> <!-- End | Footer -->



    <!-- Javascript Connect -->
    <script src="assets/js/index.js"></script>

</body>

</html>