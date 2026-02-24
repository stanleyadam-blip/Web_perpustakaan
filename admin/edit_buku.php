<?php
include "../koneksi.php";
$id = $_GET['id'];
$query_buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
$data_buku = mysqli_fetch_array($query_buku);
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <h3 class="fw-bold mb-4" style="color: #003366;"><i class="bi bi-pencil-square me-2"></i>Edit Data Buku</h3>
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Judul Buku</label>
                            <input value="<?= $data_buku['judul_buku']; ?>" name="judul_buku" type="text" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Pengarang</label>
                                <input value="<?= $data_buku['pengarang']; ?>" name="pengarang" type="text" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Penerbit</label>
                                <input value="<?= $data_buku['penerbit']; ?>" name="penerbit" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tahun Terbit</label>
                                <input value="<?= $data_buku['tahun_terbit']; ?>" name="tahun_terbit" type="number" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Ganti Cover (Opsional)</label>
                                <input name="gambar" type="file" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center border-start">
                        <label class="form-label fw-bold d-block">Cover Saat Ini</label>
                        <img src="../assets/img/<?= $data_buku['gambar'] ?>" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px;">
                        <p class="text-muted small">Abaikan jika tidak ingin mengganti gambar.</p>
                    </div>
                </div>

                <div class="mt-4 border-top pt-3">
                    <button name="tombol" type="submit" class="btn btn-primary px-5">SIMPAN PERUBAHAN</button>
                    <a href="?halaman=data_buku" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['tombol'])) {
    $judul_buku   = $_POST['judul_buku'];
    $pengarang    = $_POST['pengarang'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    
    $gambar_final = $data_buku['gambar']; // Default to old image

    if($_FILES['gambar']['name'] != "") {
        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $gambar_final = time() . "_" . $nama_file;
        move_uploaded_file($tmp_file, "../assets/img/" . $gambar_final);
    }

    $query = "UPDATE buku SET judul_buku='$judul_buku', pengarang='$pengarang', penerbit='$penerbit', 
              tahun_terbit='$tahun_terbit', gambar='$gambar_final' WHERE id_buku='$id'";
    $data = mysqli_query($koneksi, $query);

    if($data) {
        echo "<script>alert('Data buku diperbarui!'); window.location.assign('?halaman=data_buku');</script>";
    }
}
?>