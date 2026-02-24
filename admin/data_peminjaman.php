<div class="row mb-4 align-items-end">
    <div class="col">
        <h6 class="text-uppercase text-muted fw-bold small mb-1" style="letter-spacing: 1px;">Sistem Sirkulasi</h6>
        <h2 class="fw-extrabold m-0" style="color: #003366; font-weight: 800;">Manajemen Transaksi</h2>
    </div>
    <div class="col-auto">
        <a href="?halaman=input_peminjaman" class="btn btn-primary px-4 py-2 rounded-4 shadow-sm fw-bold">
            <i class="bi bi-plus-circle me-2"></i>Transaksi Baru
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex align-items-center">
            <div class="bg-warning-subtle text-warning p-2 rounded-3 me-3">
                <i class="bi bi-hourglass-split fs-5"></i>
            </div>
            <h5 class="m-0 fw-bold" style="color: #2d3436;">Peminjaman Aktif</h5>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr class="small text-muted text-uppercase">
                    <th class="ps-4 border-0">Detail Peminjam</th>
                    <th class="border-0">Buku yang Dipinjam</th>
                    <th class="border-0">Waktu Pinjam</th>
                    <th class="text-center border-0">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "../koneksi.php";
                $query = "SELECT * FROM transaksi, buku, anggota WHERE buku.id_buku=transaksi.id_buku AND anggota.id_anggota=transaksi.id_anggota AND transaksi.status_transaksi='Peminjaman' ORDER BY transaksi.id_transaksi DESC";
                $data = mysqli_query($koneksi, $query);
                foreach($data as $pinjam) {
                ?>
                <tr style="transition: 0.3s;">
                    <td class="ps-4 py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark"><?= $pinjam['nama_anggota']; ?></div>
                                <div class="text-muted" style="font-size: 11px;">NIS: <?= $pinjam['nis']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="fw-semibold text-primary"><?= $pinjam['judul_buku']; ?></div>
                        <div class="small text-muted">ID: #B-<?= $pinjam['id_buku']; ?></div>
                    </td>
                    <td>
                        <div class="badge bg-light text-dark border fw-normal px-3 py-2 rounded-pill">
                            <i class="bi bi-calendar-event me-2 text-primary"></i><?= date('d M Y', strtotime($pinjam['tgl_pinjam'])); ?>
                        </div>
                    </td>
                    <td class="text-center">
                        <button onclick="prosesSelesai('Proses pengembalian buku ini?', <?= $pinjam['id_transaksi'] ?>, <?= $pinjam['id_buku'] ?>)" 
                                class="btn btn-success btn-sm px-4 rounded-pill shadow-sm fw-bold">
                            Selesaikan
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white border-0 py-3">
        <div class="d-flex align-items-center">
            <div class="bg-success-subtle text-success p-2 rounded-3 me-3">
                <i class="bi bi-journal-check fs-5"></i>
            </div>
            <h5 class="m-0 fw-bold" style="color: #2d3436;">Riwayat Pengembalian</h5>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-sm table-hover align-middle mb-0">
            <thead class="bg-dark text-white">
                <tr class="small text-uppercase">
                    <th class="ps-4 py-3 border-0">Peminjam</th>
                    <th class="border-0">Buku</th>
                    <th class="border-0">Tanggal Kembali</th>
                    <th class="text-center border-0">Opsi</th>
                </tr>
            </thead>
            <tbody class="text-muted">
                <?php
                $query2 = "SELECT * FROM transaksi, buku, anggota WHERE buku.id_buku=transaksi.id_buku AND anggota.id_anggota=transaksi.id_anggota AND transaksi.status_transaksi='Pengembalian' ORDER BY transaksi.id_transaksi DESC";
                $data2 = mysqli_query($koneksi, $query2);
                foreach($data2 as $pinjam) {
                ?>
                <tr>
                    <td class="ps-4 py-3 fw-bold"><?= $pinjam['nama_anggota']; ?></td>
                    <td><?= $pinjam['judul_buku']; ?></td>
                    <td><span class="text-success small fw-bold"><i class="bi bi-check-all me-1"></i><?= date('d/m/Y', strtotime($pinjam['tgl_kembali'])); ?></span></td>
                    <td class="text-center">
                        <button onclick="prosesHapus('Hapus riwayat permanen?', <?= $pinjam['id_transaksi'] ?>)" class="btn btn-outline-danger btn-sm border-0">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function prosesSelesai(pesan, id_transaksi, id_buku) {
    if (confirm(pesan)) {
        // Saya samakan ke nama file upload-an kamu: proses_pengembalian.php
        window.location.assign('?halaman=proses_pengembalian&id_transaksi=' + id_transaksi + '&id_buku=' + id_buku);
    }
}

function prosesHapus(pesan, id_transaksi) {
    if (confirm(pesan)) {
        // Saya samakan ke nama file upload-an kamu: hapus.php
        window.location.assign('?halaman=hapus&id_transaksi=' + id_transaksi);
    }
}
</script>