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

// Cek apakah role pengguna adalah "user"
if ($_SESSION['role'] === 'user') {
    // Jika role adalah "user", simpan URL saat ini untuk redirect setelah login
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];

    // Redirect ke halaman login
    header('Location: ../auth/login.php');
    exit();
}

// Jika sudah login dan role bukan "user", lanjutkan
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>SyhrlmyZID | Admin Dashboard</title>

    <!-- Icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Noto+Sans:wght@400;700&display=swap"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <!-- Liblary Framework -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Css Pages -->
    <link rel="stylesheet" href="assets/css/main.css">

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <!-- Container -->
    <div class="app-wrapper">



        <!-- Navbar -->
        <nav class="app-header navbar navbar-expand bg-body">

            <div class="container-fluid">

                <!-- Navbar Link -->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                                class="bi bi-list"></i> </a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">About</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Services</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Blog</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li>
                </ul>
                <!-- End - Navbar Link -->

                <!-- Navbar Profile & Notification -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"> <img src="assets/img/user.png"
                                class="user-image rounded-circle shadow" alt="User Image"> <span
                                class="d-none d-md-inline">SyhrlmyZID</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header"> <img src="assets/img/user.png" class="rounded-circle shadow"
                                    alt="User Image">
                                <p>
                                    SyhrlmyZID
                                </p>
                                <div class="menu-profile" style="display: flex; flex-direction: column;">
                                    <button class="btn btn-primary" style="margin-bottom: 3px;"
                                        onclick="redirectToEditProfile()">Edit Profile</button>
                                    <button class="btn btn-danger" onclick="redirectToLogOut()">Log Out</button>
                                </div>
                            </li>
                    </li>
                </ul>
                </li>
                <li class="nav-item dropdown"> <a class="nav-link" data-bs-toggle="dropdown" href="#"> <i
                            class="bi bi-bell-fill"></i> <span class="navbar-badge badge text-bg-warning">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <span
                            class="dropdown-item dropdown-header">Notification</span>
                        <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"> <i
                                class="bi bi-envelope me-2"></i> 4 New Message
                            <span class="float-end text-secondary fs-7">3 mins</span> </a>
                    </div>
                </li>

                </ul> <!-- End Navbar Profile / Notification -->

            </div>
        </nav> <!-- End - Navbar -->



        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->

            <!-- Title Sidebar -->
            <div class="sidebar-brand">
                <a href="#" class="brand-link">
                    <img src="assets/img/AdminLTELogo.png" alt="" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">Dashboard</span>
                </a>
            </div> <!-- End - Title Sidebar -->

            <!-- Menu Sidebar -->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">

                        <!-- Menu Sidebar 1 -->
                        <li class="nav-header">Dashboard</li>
                        <li class="nav-item"> <a href="index.php" class="nav-link"> <i class="bi bi-house"></i>
                                <p>Home</p>
                            </a>
                        </li> <!-- End | Menu Sidebar 1 -->

                        <!-- Menu Sidebar 2 -->
                        <li class="nav-header">Table</li>
                        <li class="nav-item"> <a href="users.php" class="nav-link"> <i class="bi bi-person-circle"></i>
                                <p>Users</p>
                            </a>
                        </li> <!-- End - Menu Sidebar 2 -->

                        <!-- Menu Sidebar 3 -->
                        <li class="nav-header">Account</li>
                        <li class="nav-item"> <a href="../php/process_logout.php" class="nav-link"> <i class="bi bi-box-arrow-left"></i>
                                <p>Logout</p>
                            </a>
                        </li> <!-- Menu Sidebar 3 -->

                    </ul>
                </nav>
            </div> <!-- End - Menu Sidebar -->

        </aside> <!-- End - Sidebar -->



        <!-- Main Content -->
        <main class="app-main">

            <!-- Title Content -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Welcome To Dashboard</h3>
                        </div>
                    </div>
                </div>
            </div> <!-- End - Title Content -->

            <!-- Content -->
            <div class="app-content">
                <div class="container-fluid">

                    <!-- Widget Container Card -->
                    <div class="row">

                        <!-- ===================================================================================== -->
                        <!--  GUNAKAN WEBSITE INI UNTUK MEMBUAT LOGO NYA PADA CARD: https://www.freepik.com/icon/ UBAH TRANSPARASI NYA JADI: #00000090 -->
                        <!-- ===================================================================================== -->

                        <!-- Widget Menu 1 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background: #3399FF; color: #fff;">
                                <div class="inner"
                                    style="display: flex; justify-content: space-between; align-items: center; padding: 15px;">
                                    <div style="text-align: left;">
                                        <h3 style="font-size: 2rem; margin: 0;">0</h3>
                                        <p style="margin: 5px 0; font-size: 1.1rem;">Widget 1</p>
                                    </div>
                                    <div style="width: 64px; height: 64px;">
                                        <img src="assets/img/booking.png" alt="Booking Icon"
                                            style="width: 100%; opacity: 0.8;">
                                    </div>
                                </div>
                                <a href="#" class="small-box-footer link-light"
                                    style="text-decoration: none; display: block; text-align: center; padding: 10px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div> <!-- End - Widget Menu 1-->

                        <!-- Widget Menu 2 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background: #5856D6; color: #fff;">
                                <div class="inner"
                                    style="display: flex; justify-content: space-between; align-items: center; padding: 15px;">
                                    <div style="text-align: left;">
                                        <h3 style="font-size: 2rem; margin: 0;">0</h3>
                                        <p style="margin: 5px 0; font-size: 1.1rem;">Widget 2</p>
                                    </div>
                                    <div style="width: 64px; height: 64px;">
                                        <img src="assets/img/booking.png" alt="Booking Icon"
                                            style="width: 100%; opacity: 0.8;">
                                    </div>
                                </div>
                                <a href="#" class="small-box-footer link-light"
                                    style="text-decoration: none; display: block; text-align: center; padding: 10px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div> <!-- End - Widget Menu 2 -->

                        <!-- Widget Menu 3 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background: #F9B115; color: #fff;">
                                <div class="inner"
                                    style="display: flex; justify-content: space-between; align-items: center; padding: 15px;">
                                    <div style="text-align: left;">
                                        <h3 style="font-size: 2rem; margin: 0;">0</h3>
                                        <p style="margin: 5px 0; font-size: 1.1rem;">Widget 3</p>
                                    </div>
                                    <div style="width: 64px; height: 64px;">
                                        <img src="assets/img/booking.png" alt="Booking Icon"
                                            style="width: 100%; opacity: 0.8;">
                                    </div>
                                </div>
                                <a href="#" class="small-box-footer link-light"
                                    style="text-decoration: none; display: block; text-align: center; padding: 10px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div> <!-- End - Widget Menu 3 -->

                        <!-- Widget Menu 4 -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box" style="background: #E55353; color: #fff;">
                                <div class="inner"
                                    style="display: flex; justify-content: space-between; align-items: center; padding: 15px;">
                                    <div style="text-align: left;">
                                        <h3 style="font-size: 2rem; margin: 0;">0</h3>
                                        <p style="margin: 5px 0; font-size: 1.1rem;">Widget 4</p>
                                    </div>
                                    <div style="width: 64px; height: 64px;">
                                        <img src="assets/img/booking.png" alt="Booking Icon"
                                            style="width: 100%; opacity: 0.8;">
                                    </div>
                                </div>
                                <a href="#" class="small-box-footer link-light"
                                    style="text-decoration: none; display: block; text-align: center; padding: 10px; border-top: 1px solid rgba(255, 255, 255, 0.1);">
                                    More info <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                        <!-- End - Widget Menu 4 -->

                    </div> <!-- End - Widget Container Card -->

                    <!-- Statistic Users -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h3 class="card-title">Statistic Users</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Canvas Chart -->
                                    <canvas id="userRegistrationChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End | Statistik Users -->

                </div>
            </div> <!-- End - Content -->
        </main> <!-- End - Main Content -->



        <!-- Footer -->
        <footer class="app-footer" style="text-align: center;">
            <strong> Copyright &copy; 2024&nbsp; <a href="https://syhrlmyzid.github.io/portfolio/"
                    class="text-decoration-none">SyhlmyZID</a>.</strong>All rights reserved.
        </footer> <!-- End - Footer -->



    </div>
    <!-- End - Container -->



    <!-- Liblary Framework -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha256-whL0tQWoY1Ku1iskqPFvmZ+CHsvmRWx/PIoEvIeWh4I=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Javascript Pages -->
    <script src="assets/js/main.js"></script>

    <!-- Javascript Main -->
    <script src="assets/js/index.js"></script>

</body>

</html>