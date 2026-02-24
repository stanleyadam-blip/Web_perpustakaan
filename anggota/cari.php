<?php
$kunci = isset($_POST['kunci']) ? $_POST['kunci'] : '';
?>

<div class="mb-4">
    <div class="d-flex align-items-center mb-2">
        <div class="bg-primary-subtle p-2 rounded-3 me-3">
            <i class="bi bi-search text-primary fs-4"></i>
        </div>
        <div>
            <h4 class="fw-800 mb-0" style="color: #003366;">Hasil Pencarian</h4>
            <p class="text-muted small mb-0">Menampilkan hasil untuk kata kunci: <span class="fw-bold text-dark">"<?= $kunci ?>"</span></p>
        </div>
    </div>
</div>

<form action="?halaman=cari" method="post" class="mb-5">
    <div class="input-group shadow-sm rounded-pill overflow-hidden">
        <input type="text" name="kunci" class="form-control border-0 ps-4 py-2" value="<?= $kunci ?>" placeholder="Cari judul buku lain...">
        <button type="submit" class="btn btn-warning px-4 fw-bold">
            <i class="bi bi-search me-2"></i>Cari Lagi
        </button>
    </div>
</form>

<div class="row g-4">
    <?php
    include "../koneksi.php";
    $id_member = $_SESSION['id_anggota']; // Untuk ngecek status pinjaman user
    $query = "SELECT * FROM buku WHERE judul_buku LIKE '%$kunci%' OR pengarang LIKE '%$kunci%'";
    $data_buku = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($data_buku) > 0) {
        foreach ($data_buku as $buku) {
            $img = !empty($buku['gambar']) ? "../assets/img/".$buku['gambar'] : "../assets/img/default_book.jpg";
            $is_mine = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_buku='".$buku['id_buku']."' AND id_anggota='$id_member' AND status_transaksi='Peminjaman'");
    ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="book-container card h-100 border-0 shadow-sm" style="transition: transform 0.3s ease;">
            <div class="position-relative overflow-hidden" style="height: 250px; border-radius: 15px 15px 0 0;">
                <img src="<?= $img ?>" class="w-100 h-100 object-fit-cover" alt="Cover">
                <?php if($buku['status']=="tersedia"){ ?>
                    <span class="badge bg-success position-absolute top-0 end-0 m-3 shadow-sm rounded-pill px-3">Tersedia</span>
                <?php } else { ?>
                    <span class="badge bg-danger position-absolute top-0 end-0 m-3 shadow-sm rounded-pill px-3">Dipinjam</span>
                <?php } ?>
            </div>
            
            <div class="card-body d-flex flex-column p-3">
                <h6 class="fw-bold text-dark mb-1 text-truncate"><?= $buku['judul_buku'] ?></h6>
                <p class="text-muted small mb-3"><i class="bi bi-person me-1"></i><?= $buku['pengarang'] ?></p>
                
                <div class="mt-auto">
                    <?php if($buku['status']=="tersedia"){ ?>
                        <a href="?halaman=peminjaman&id=<?= $buku['id_buku'] ?>" 
                           class="btn btn-primary w-100 rounded-pill fw-bold py-2"
                           onclick="return confirm('Pinjam buku ini?')">
                           Pinjam Sekarang
                        </a>
                    <?php } else if(mysqli_num_rows($is_mine) > 0) { 
                        $row_mine = mysqli_fetch_array($is_mine);
                    ?>
                        <a href="?halaman=pengembalian&id=<?= $row_mine['id_transaksi'] ?>&buku=<?= $buku['id_buku'] ?>" 
                           class="btn btn-warning w-100 rounded-pill fw-bold py-2 text-dark">
                           Kembalikan
                        </a>
                    <?php } else { ?>
                        <button class="btn btn-light w-100 rounded-pill disabled text-muted fw-bold">Terpinjam</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        } 
    } else { ?>
        <div class="col-12 text-center py-5">
            <div class="mb-3">
                <i class="bi bi-journal-x display-1 text-muted opacity-25"></i>
            </div>
            <h5 class="fw-bold text-secondary">Aduh, bukunya gak ketemu...</h5>
            <p class="text-muted small">Coba cari dengan kata kunci lain atau periksa ejaanmu, jier.</p>
        </div>
    <?php } ?>
</div>

<style>
    .book-container:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0,51,102,0.1) !important;
    }
    .object-fit-cover {
        object-fit: cover;
    }
</style>