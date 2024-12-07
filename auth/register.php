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
    <title>SyhlmyZID | Register</title>

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
            <a href="login.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 w-24 text-center font-medium">Login</a>
            <a href="register.php" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-400 w-24 text-center font-medium">Register</a>
        </div>
    </nav>

    <!-- Register Section -->
    <section class="min-h-screen flex justify-center items-center flex-col">
        <div class="w-full sm:w-96 bg-gray-800 p-6 rounded-lg border-2 border-green-500 shadow-xl">
            <form action="../php/process_register.php" method="POST">
                <h1 class="text-4xl font-bold text-center text-white mb-8">Welcome To Form Register</h1>

                <div class="mb-4">
                    <label for="name" class="block text-white text-lg mb-2">Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full p-3 text-white bg-gray-700 border-2 border-green-500 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-white">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-white text-lg mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full p-3 text-white bg-gray-700 border-2 border-green-500 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-white">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-white text-lg mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                            class="w-full p-3 text-white bg-gray-700 border-2 border-green-500 rounded focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 text-white">
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-400 font-mono text-lg">Submit</button>
            </form>

            <!-- Login Link -->
            <div class="mt-4 text-center">
                <p class="text-white">Sudah punya akun? <a href="login.php" class="text-green-500 hover:underline">Login</a></p>
            </div>
        </div>
    </section>
    
    <?php if (isset($_GET['error']) && $_GET['error'] == 'email_exists'): ?>
    <div id="error-modal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex justify-center items-center">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-96 text-center">
            <h2 class="text-2xl font-semibold text-red-600 mb-4">Oops! Ada yang salah...</h2>
            <p class="text-white mb-6 text-lg">Email sudah terdaftar! Silahkan ganti.</p>
            <button id="close-modal" class="bg-transparent text-white py-2 px-6 border border-red-500 rounded-sm transition-all duration-200 hover:bg-red-500 hover:text-white">
                Close
            </button>
        </div>
    </div>
<?php endif; ?>


    <footer class="bg-gray-800 py-6 text-center">
        <p>&copy; 2024 SyhrlmyZID. All rights reserved.</p>
    </footer>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const errorModal = document.getElementById('error-modal');
    const closeModalBtn = document.getElementById('close-modal');
    
    // Show the modal if there is an error (ensure it's visible)
    if (errorModal && window.location.search.includes('error=email_exists')) {
        errorModal.classList.remove('hidden');
    }

    // Close the modal when the close button is clicked
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            errorModal.classList.add('hidden');
        });
    }
});

    </script>

</body>

</html>
