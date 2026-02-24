<?php
session_start();
if (empty($_SESSION['id_admin'])) {
    header("Location:../login-admin.php");
    exit();
}
include '../koneksi.php';

// Get current page logic
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 'dashboard';

// Statistics Logic
$total_buku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
$total_anggota = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM anggota"));
$buku_dipinjam = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE status_transaksi='Peminjaman'"));
$buku_tersedia = $total_buku - $buku_dipinjam;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace | E-Library Admin</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #2563eb;
            --dark-navy: #0f172a;
            --slate-gray: #64748b;
            --bg-body: #f8fafc;
            --sidebar-width: 280px;
            --accent-gold: #fbbf24;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* --- Sidebar Modern --- */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            background: var(--dark-navy);
            padding: 2rem 1.25rem;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: all 0.3s;
        }

        .brand-box {
            padding: 0.5rem 1rem;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.3);
        }

        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            color: var(--slate-gray);
            margin: 1.5rem 0 0.75rem 0.75rem;
            font-weight: 800;
        }

        .nav-link {
            color: #94a3b8;
            padding: 0.8rem 1rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            margin-bottom: 4px;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
            transform: translateX(4px);
        }

        .nav-link.active {
            background: var(--accent-gold);
            color: var(--dark-navy);
            font-weight: 700;
            box-shadow: 0 10px 15px -3px rgba(251, 191, 36, 0.2);
        }

        /* --- Main Layout --- */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 3rem;
            min-height: 100vh;
        }

        /* Top Navbar */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }

        /* Stat Cards */
        .stat-card {
            background: white;
            border: 1px solid rgba(241, 245, 249, 1);
            border-radius: 24px;
            padding: 1.5rem;
            transition: all 0.3s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }

        /* Avatar Table */
        .avatar-box {
            width: 36px;
            height: 36px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary);
            font-size: 0.8rem;
        }

        .logout-btn {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            margin-top: auto;
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
        }

        .logout-btn:hover {
            background: #ef4444;
            color: white;
        }

        .btn-new {
            background: var(--primary);
            color: white;
            border-radius: 14px;
            padding: 10px 24px;
            font-weight: 700;
            border: none;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            transition: all 0.2s;
        }

        .btn-new:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            color: white;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand-box">
            <div class="brand-logo">
                <i class="bi bi-book-half text-white"></i>
            </div>
            <h5 class="mb-0 fw-800 text-white" style="letter-spacing: -1px;">E-Library</h5>
        </div>
        
        <div class="nav-section-title">Workspace</div>
        <a href="dashboard.php" class="nav-link <?= ($halaman == 'dashboard') ? 'active' : '' ?>">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
        <a href="?halaman=data_buku" class="nav-link <?= ($halaman == 'data_buku') ? 'active' : '' ?>">
            <i class="bi bi-collection-fill"></i> Kelola Buku
        </a>
        <a href="?halaman=data_peminjaman" class="nav-link <?= ($halaman == 'data_peminjaman') ? 'active' : '' ?>">
            <i class="bi bi-arrow-left-right"></i> Peminjaman
        </a>

        <div class="nav-section-title">Users</div>
        <a href="?halaman=data_anggota" class="nav-link <?= ($halaman == 'data_anggota') ? 'active' : '' ?>">
            <i class="bi bi-people-fill"></i> Data Anggota
        </a>

        <a href="logout.php" class="nav-link logout-btn">
            <i class="bi bi-power"></i> Keluar
        </a>
    </aside>

    <main class="main-content">
        <header class="top-nav">
            <div>
                <h1 class="fw-800 mb-1" style="font-weight: 800; letter-spacing: -1.5px;">
                    <?= ($halaman == 'dashboard') ? 'Overview' : str_replace('_', ' ', $halaman); ?>
                </h1>
                <p class="text-muted small">Hi, <strong><?= $_SESSION['nama_admin']; ?></strong>. Welcome back to your workspace.</p>
            </div>
            <div class="d-flex gap-3">
                <button class="btn btn-light rounded-3 border px-3" onclick="location.reload()">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                <a href="?halaman=input_peminjaman" class="btn-new">
                    <i class="bi bi-plus-lg me-2"></i> New Transaction
                </a>
            </div>
        </header>

        <?php if ($halaman != 'dashboard' && file_exists($halaman . ".php")): ?>
            <div class="card border-0 shadow-sm p-4" style="border-radius: 24px;">
                <?php include $halaman . ".php"; ?>
            </div>
        <?php else: ?>
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-book"></i>
                        </div>
                        <h2 class="fw-800 mb-0"><?= $total_buku ?></h2>
                        <span class="text-muted small fw-bold uppercase">Total Koleksi</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <h2 class="fw-800 mb-0"><?= $buku_tersedia ?></h2>
                        <span class="text-muted small fw-bold">Tersedia</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-journal-arrow-up"></i>
                        </div>
                        <h2 class="fw-800 mb-0"><?= $buku_dipinjam ?></h2>
                        <span class="text-muted small fw-bold">Dipinjam</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-person-heart"></i>
                        </div>
                        <h2 class="fw-800 mb-0"><?= $total_anggota ?></h2>
                        <span class="text-muted small fw-bold">Aktif Member</span>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm p-4" style="border-radius: 24px;">
                        <h6 class="fw-800 mb-4">Peminjaman Terbaru</h6>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr class="text-muted small">
                                        <th>Peminjam</th>
                                        <th>Judul Buku</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $recent = mysqli_query($koneksi, "SELECT * FROM transaksi 
                                             JOIN anggota ON transaksi.id_anggota = anggota.id_anggota 
                                             JOIN buku ON transaksi.id_buku = buku.id_buku 
                                             ORDER BY id_transaksi DESC LIMIT 5");
                                    while($row = mysqli_fetch_array($recent)){ 
                                        $initial = strtoupper(substr($row['nama_anggota'], 0, 1));
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="avatar-box"><?= $initial ?></div>
                                                <div>
                                                    <div class="fw-bold small"><?= $row['nama_anggota'] ?></div>
                                                    <div class="text-muted" style="font-size: 10px;">ID: <?= $row['nis'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="small fw-500"><?= $row['judul_buku'] ?></td>
                                        <td>
                                            <?php if($row['status_transaksi'] == 'Peminjaman'): ?>
                                                <span class="badge bg-primary bg-opacity-10 text-primary px-3 rounded-pill">Keluar</span>
                                            <?php else: ?>
                                                <span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill">Kembali</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm p-4 bg-dark text-white" style="border-radius: 24px; background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);">
                        <h6 class="fw-bold mb-4">Quick Action</h6>
                        <div class="d-grid gap-2">
                            <a href="?halaman=input_buku" class="btn btn-outline-light border-0 text-start py-3 rounded-3">
                                <i class="bi bi-plus-circle me-2"></i> Tambah Koleksi Buku
                            </a>
                            <a href="?halaman=data_anggota" class="btn btn-outline-light border-0 text-start py-3 rounded-3">
                                <i class="bi bi-person-plus me-2"></i> Registrasi Anggota
                            </a>
                        </div>
                        <hr class="opacity-10">
                        <div class="p-3 bg-white bg-opacity-5 rounded-4 mt-2">
                            <small class="text-secondary d-block mb-1">System Health</small>
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                                <span class="small fw-bold">Semua sistem berjalan normal</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>