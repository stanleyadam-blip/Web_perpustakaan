<?php
include'../koneksi.php';
session_start();
if (empty($_SESSION['id_anggota'])) {
    header("Location:../login-anggota.php");
    exit();
}
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 'dashboard';

// Fetch Member Stats
$id_member = $_SESSION['id_anggota'];
$q_pinjam = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_anggota='$id_member' AND status_transaksi='Peminjaman'");
$count_pinjam = mysqli_num_rows($q_pinjam);
$count_history = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_anggota='$id_member' AND status_transaksi='Pengembalian'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Library | Discover Knowledge</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-navy: #0f172a;
            --accent-gold: #fbbf24;
            --soft-blue: #e0e7ff;
            --bg-body: #f8fafc;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
        }

        /* --- Custom Navbar --- */
        .nav-custom {
            background: rgba(255, 255, 255, 0.8) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1rem 0;
        }

        /* --- Updated Hero Header with Background Image --- */
        .hero-section {
            background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.85)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-position: center;
            border-radius: 0 0 50px 50px;
            padding: 80px 0 160px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        /* --- Floating Stats & Return Zone --- */
        .dashboard-overlap {
            margin-top: -100px;
            position: relative;
            z-index: 10;
        }

        .action-card {
            background: white;
            border-radius: 24px;
            border: none;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            padding: 24px;
            height: 100%;
        }

        /* --- Centered Stats Alignment --- */
        .stats-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            text-align: center;
        }

        /* --- Book Card Modernization --- */
        .book-card {
            background: white;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .book-cover {
            height: 280px;
            object-fit: cover;
            width: 100%;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .badge-status {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 5;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- Interaction Elements --- */
        .search-pill {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 50px;
            padding: 8px 8px 8px 24px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            backdrop-filter: blur(5px);
        }

        .search-pill:focus-within {
            background: white;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
        }

        .search-pill input {
            background: transparent;
            border: none;
            color: white;
            outline: none;
            width: 100%;
        }

        .search-pill:focus-within input { color: var(--primary-navy); }

        .btn-action {
            border-radius: 14px;
            font-weight: 700;
            padding: 12px 20px;
            transition: all 0.3s;
            margin-top: auto;
        }

        .return-item {
            border-left: 4px solid var(--accent-gold);
            background: #fffdf5;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 12px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg nav-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-800 fs-4" href="dashboard.php" style="letter-spacing: -1.5px;">
                <i class="bi bi-book-half text-primary me-2"></i>E-LIBRARY
            </a>
            <div class="ms-auto d-flex align-items-center gap-3">
                <a href="?halaman=history" class="text-dark text-decoration-none small fw-bold d-none d-md-block">Riwayat</a>
                <a href="logout.php" class="btn btn-dark btn-sm rounded-pill px-4">Log Out</a>
            </div>
        </div>
    </nav>

    <?php if ($halaman == 'dashboard') { ?>
    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-800 mb-2">Halo, <?= explode(' ', $_SESSION['nama_anggota'])[0]; ?>! 👋</h1>
            <p class="opacity-75 mb-5 fs-5">Mau baca petualangan apa kita hari ini?</p>
            
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <form action="?halaman=cari" method="post">
                        <div class="search-pill">
                            <input type="text" name="kunci" placeholder="Cari judul buku, penulis, atau genre...">
                            <button type="submit" class="btn btn-warning rounded-circle" style="width: 42px; height: 42px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container dashboard-overlap">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="action-card">
                    <h6 class="text-muted fw-800 small text-uppercase mb-4 text-center">Aktivitas Saya</h6>
                    <div class="stats-container mb-4">
                        <div>
                            <div class="h1 fw-800 mb-0"><?= $count_pinjam ?></div>
                            <span class="small text-muted fw-600">Dipinjam</span>
                        </div>
                        <div class="vr opacity-10" style="height: 40px;"></div>
                        <div>
                            <div class="h1 fw-800 mb-0"><?= $count_history ?></div>
                            <span class="small text-muted fw-600">Selesai</span>
                        </div>
                    </div>
                    <div class="p-3 bg-light rounded-4">
                        <p class="small text-muted mb-0 text-center"><i class="bi bi-info-circle me-2"></i>Ayo selesaikan bacaanmu!</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="action-card">
                    <h6 class="text-muted fw-800 small text-uppercase mb-4">Sedang Dipinjam</h6>
                    <?php 
                    if(mysqli_num_rows($q_pinjam) > 0) {
                        while($loan = mysqli_fetch_array($q_pinjam)) {
                            $buku_id = $loan['id_buku'];
                            $buku_info = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$buku_id'"));
                    ?>
                    <div class="return-item d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3">
                                <i class="bi bi-bookmark-star-fill fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0 text-truncate" style="max-width: 200px;"><?= $buku_info['judul_buku'] ?></h6>
                                <small class="text-muted">Jatuh tempo: <span class="fw-bold"><?= date('d M Y', strtotime($loan['tgl_pinjam'] . ' + 7 days')) ?></span></small>
                            </div>
                        </div>
                        <a href="?halaman=pengembalian&id=<?= $loan['id_transaksi'] ?>&buku=<?= $loan['id_buku'] ?>" 
                           class="btn btn-dark btn-sm rounded-pill px-4"
                           onclick="return confirm('Kembalikan buku ini?')">Kembalikan</a>
                    </div>
                    <?php } } else { ?>
                    <div class="text-center py-4 opacity-50">
                        <i class="bi bi-journal-x fs-1"></i>
                        <p class="small mt-2">Belum ada buku yang kamu pinjam.</p>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <section class="mt-5 pt-4 mb-5">
            <div class="d-flex align-items-end justify-content-between mb-4">
                <div>
                    <h3 class="fw-800 mb-1">Seluruh Koleksi Buku</h3>
                    <p class="text-muted small">Menampilkan semua buku yang tersedia di perpustakaan kami.</p>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $data_buku = mysqli_query($koneksi,"SELECT * FROM buku ORDER BY judul_buku ASC");
                if(mysqli_num_rows($data_buku) > 0) {
                    while($buku = mysqli_fetch_array($data_buku)){
                        $img = !empty($buku['gambar']) ? "../assets/img/".$buku['gambar'] : "../assets/img/default_book.jpg";
                        $status_color = ($buku['status'] == "tersedia") ? "bg-success" : "bg-danger";
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="book-card position-relative">
                            <span class="badge-status <?= $status_color ?> text-white shadow-sm">
                                <?= $buku['status'] ?>
                            </span>
                            <img src="<?= $img ?>" class="book-cover" alt="Cover">
                            
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <h6 class="fw-800 text-truncate mb-1" title="<?= $buku['judul_buku'] ?>"><?= $buku['judul_buku'] ?></h6>
                                <p class="text-muted small mb-4"><i class="bi bi-person me-1"></i> <?= $buku['pengarang'] ?></p>
                                
                                <?php if($buku['status'] == "tersedia"): ?>
                                    <a href="?halaman=peminjaman&id=<?= $buku['id_buku'] ?>" 
                                       class="btn btn-primary btn-action w-100 shadow-sm"
                                       onclick="return confirm('Pinjam buku ini?')">
                                       Pinjam Sekarang
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-light btn-action w-100 disabled text-muted small">Sedang Dipinjam</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php 
                    } 
                } else {
                    echo "<div class='col-12 text-center py-5'><p class='text-muted'>Tidak ada buku di database.</p></div>";
                }
                ?>
            </div>
        </section>
    </div>

    <?php } else { ?>
        <div class="container mt-5 pt-4 mb-5">
            <div class="card border-0 shadow-lg rounded-4 p-4 min-vh-50">
                <?php 
                if (file_exists($halaman . ".php")) {
                    include $halaman . ".php";
                } else {
                    echo "<div class='text-center py-5'><h2 class='fw-800'>Halaman tidak ditemukan.</h2></div>";
                }
                ?>
            </div>
        </div>
    <?php } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>