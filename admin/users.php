<?php
// Session
session_start();

// Koneksi database
require_once '../config/connection.php';

// Cek apakah user sudah login
if (isset($_SESSION['user_id'])) {
    $email = $_SESSION['email'];

    // Ambil data pengguna berdasarkan email
    $query = "SELECT name FROM tbl_users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $name = $user['name'];  // Nama pengguna
    } else {
        // Jika tidak ditemukan, arahkan ke halaman login
        header('Location: ../auth/login.php');
        exit();
    }
} else {
    // Jika belum login, arahkan ke halaman login
    header('Location: ../auth/login.php');
    exit();
}

// Tentukan jumlah data per halaman
$limit = 5;

// Ambil halaman yang diminta atau set default ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query untuk mengambil data dengan limit dan offset
$query = "SELECT id, name, email FROM tbl_users LIMIT ?, ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Query untuk menghitung jumlah total data
$query_total = "SELECT COUNT(id) AS total FROM tbl_users";
$total_result = $conn->query($query_total);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Meta Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>SyhrlmyZID | Admin Users</title>

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
                                class="d-none d-md-inline">
                                <?php echo htmlspecialchars($name); ?>
                            </span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header"> <img src="assets/img/user.png" class="rounded-circle shadow"
                                    alt="User Image">
                                <p>
                                    <?php echo htmlspecialchars($name); ?>
                                </p>
                                <div class="menu-profile" style="display: flex; flex-direction: column;">
                                    <button class="btn btn-primary" style="margin-bottom: 3px;"
                                        onclick="redirectToEditProfile()">Edit Profile</button>
                                    <form action="../php/process_logout.php" method="POST">
                                        <button type="submit" class="btn btn-danger" style="width: 100%;">Log
                                            Out</button>
                                    </form>

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
                        <li class="nav-item"> <a href="#" class="nav-link"> <i class="bi bi-person-circle"></i>
                                <p>Users</p>
                            </a>
                        </li> <!-- End - Menu Sidebar 2 -->

                        <!-- Menu Sidebar 3 -->
                        <li class="nav-header">Account</li>
                        <li class="nav-item"> <a href="../php/process_logout.php" class="nav-link"> <i
                                    class="bi bi-box-arrow-left"></i>
                                <p>Logout</p>
                            </a>
                        </li> <!-- Menu Sidebar 3 -->

                    </ul>
                </nav>
            </div> <!-- End - Menu Sidebar -->

        </aside> <!-- End - Sidebar -->



        <!-- Main Content -->
        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Akun Pengguna</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['email'] . '</td>';
                                            echo '<td>
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#comingSoonModal">Info</button>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#comingSoonModal">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#comingSoonModal">Delete</button>
                                            </td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4" class="text-center">Tidak ada data pengguna.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                
                            </table>
                            <div class="d-flex justify-content-between align-items-center mt-4">
    <!-- Showing Entries Text -->
    <div>
        <span class="text-muted">
            Showing <?php echo (($page - 1) * $limit) + 1; ?> to <?php echo min($page * $limit, $total_rows); ?> of <?php echo $total_rows; ?> entries
        </span>
    </div>

    <!-- Pagination Controls -->
    <div>
        <ul class="pagination d-flex justify-content-end">
            <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link text-white bg-primary hover:bg-primary-dark border-0 rounded-lg px-3 py-1"
                    href="?page=1">First</a>
            </li>
            <li class="page-item">
                <a class="page-link text-white bg-primary hover:bg-primary-dark border-0 rounded-lg px-3 py-1"
                    href="?page=<?php echo $page - 1; ?>">Previous</a>
            </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item">
                <a class="page-link <?php echo ($i == $page) ? 'bg-primary text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'; ?> px-3 py-1 rounded-lg"
                    href="?page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
            <li class="page-item">
                <a class="page-link text-white bg-primary hover:bg-primary-dark border-0 rounded-lg px-3 py-1"
                    href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
            <li class="page-item">
                <a class="page-link text-white bg-primary hover:bg-primary-dark border-0 rounded-lg px-3 py-1"
                    href="?page=<?php echo $total_pages; ?>">Last</a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </main> <!-- End - Main Content -->



        <!-- Footer -->
        <footer class="app-footer" style="text-align: center;">
            <strong> Copyright &copy; 2024&nbsp; <a href="https://syhrlmyzid.github.io/portfolio/"
                    class="text-decoration-none">SyhlmyZID</a>.</strong>All rights reserved.
        </footer> <!-- End - Footer -->



    </div>
    <!-- End - Container -->


    <!-- Modal Coming Soon -->
    <div class="modal fade" id="comingSoonModal" tabindex="-1" aria-labelledby="comingSoonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="comingSoonModalLabel">Coming Soon!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Admin sedang malas menambahkan fitur:v
            Niat pengen nambahin fitur serach data, download pdf, excel cuman lama proses nya wkwk. Cara logout bisa click foto profile.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

    </div>

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