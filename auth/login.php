<?php
// Session
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['user_id']) || isset($_COOKIE['user_email'])) {
    header('Location: ../pages/index.php');
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
    <title>SyhlmyZID | Login</title>
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
            <a href="login.php"
                class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 w-24 text-center font-medium">Login</a>
            <a href="register.php"
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
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-gray-800 p-5 space-y-4">
        <a href="../index.php" class="block text-white hover:text-green-500">Home</a>
        <a href="../index.php" class="block text-white hover:text-green-500">About</a>
        <a href="../index.php" class="block text-white hover:text-green-500">Gallery</a>
        <a href="../index.php" class="block text-white hover:text-green-500">Contact</a>
        <a href="login.php" class="block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400">Login</a>
        <a href="register.php" class="block bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400">Register</a>
    </div>

    <!-- Login Form -->
    <section class="min-h-screen flex justify-center items-center flex-col">
        <div class="w-full sm:w-96 bg-gray-800 p-6 rounded-lg border-2 border-green-500 shadow-xl">
            <form action="../php/process_login.php" method="POST">
                <h1 class="text-4xl font-bold text-center text-white mb-8">Welcome To Form Login</h1>

                <div class="mb-4">
                    <label for="username" class="block text-white text-lg mb-2">Email</label>
                    <input type="text" id="email" name="email" required
                        class="w-full p-3 text-white bg-gray-700 border-2 border-green-500 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-white">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-white text-lg mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full p-3 text-white bg-gray-700 border-2 border-green-500 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-white" />
                        <button type="button" id="toggle-password"
                            class="absolute right-3 top-1/2 transform -translate-y-1/2 text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 3c4.418 0 8 3.582 8 8s-3.582 8-8 8-8-3.582-8-8 3.582-8 8-8zm0 0v16m0 0l4-4m-4 4l-4-4">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mb-4 flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="appearance-none h-5 w-5 border border-green-500 rounded-sm bg-gray-700 checked:bg-green-500 checked:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 mr-2 transition-all">
                    <label for="remember" class="text-white text-lg">Ingat Saya</label>
                </div>

                <button type="submit"
                    class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-400 font-mono text-lg">Submit</button>
            </form>

            <!-- Register Link -->
            <div class="mt-4 text-center">
                <p class="text-white">Belum punya akun? <a href="register.php"
                        class="text-green-500 hover:underline">Register</a></p>
            </div>
        </div>
    </section>

    <!-- Error Modal -->
    <div id="error-modal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex justify-center items-center hidden">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96 text-center">
            <h2 class="text-2xl font-semibold text-red-600 mb-4">Oops! Ada yang salah...</h2>
            <p id="modal-message" class="text-white mb-6 text-lg"></p>
            <button id="close-modal"
                class="bg-transparent text-white py-2 px-6 border border-red-500 rounded-sm transition-all duration-200 hover:bg-red-500 hover:text-white">
                Close
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 py-6 text-center">
        <p>&copy; 2024 SyhrlmyZID. All rights reserved.</p>
    </footer>



    <!-- Javascript Connect -->
    <script src="../assets/js/auth/login.js"></script>

</body>

</html>