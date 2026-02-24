<?php
include "../koneksi.php";
$anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
$buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE status='tersedia'");
?>

<h4>Tambah Peminjaman</h4>
<div class="row justify-content-center">
    <div class="col-md-7">
        <h3 class="fw-bold mb-4" style="color: #003366;"><i class="bi bi-journal-plus me-2"></i>Transaksi Baru</h3>
        <div class="card p-4 border-0 shadow-sm rounded-4" style="border-top: 5px solid #FFC107 !important;">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Nama Anggota</label>
                    <select name="id_anggota" class="form-select" required>
                        <option value="">-- Pilih Siswa/Guru --</option>
                        <?php foreach($anggota as $data) { ?>
                            <option value="<?= $data['id_anggota'] ?>"><?= $data['nama_anggota'] ?> (<?= $data['kelas'] ?>)</option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Pilih Judul Buku</label>
                    <select name="id_buku" class="form-select" required>
                        <option value="">-- Cari Buku Tersedia --</option>
                        <?php foreach($buku as $data) { ?>
                            <option value="<?= $data['id_buku'] ?>"><?= $data['judul_buku'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Tanggal Peminjaman</label>
                    <input name="tgl_pinjam" type="datetime-local" class="form-control" value="<?= date('Y-m-d\TH:i') ?>" required>
                </div>

                <button name="tombol" type="submit" class="btn btn-primary w-100 py-2 fw-bold">KONFIRMASI PEMINJAMAN</button>
            </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['tombol'])) {
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $status_transaksi = "Peminjaman";

    include "../koneksi.php";
    $query = "INSERT INTO transaksi(id_anggota, id_buku, tgl_pinjam, status_transaksi) 
              VALUES ('$id_anggota', '$id_buku', '$tgl_pinjam', '$status_transaksi')";
    $data = mysqli_query($koneksi, $query);

    if($data) {
        mysqli_query($koneksi, "UPDATE buku SET status='tidak tersedia' WHERE id_buku='$id_buku'");
        echo "<script>alert('data peminjaman tersimpan'); window.location.assign('?halaman=data_peminjaman');</script>";
    } else {
        echo "<script>alert('data gagal tersimpan'); window.location.assign('?halaman=input_peminjaman');</script>";
    }
}
?>