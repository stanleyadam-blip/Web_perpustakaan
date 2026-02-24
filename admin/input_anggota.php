<h5>Tambah Data Anggota</h5>
<div class="row justify-content-center">
    <div class="col-md-8">
        <h3 class="fw-bold mb-4" style="color: #003366;">
            <i class="bi bi-person-plus me-2"></i><?= isset($_GET['id']) ? 'Edit' : 'Tambah' ?> Data Anggota
        </h3>
        <div class="card p-4 border-0 shadow-sm rounded-4">
            <form method="post">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted text-uppercase">Nomor Induk Siswa (NIS)</label>
                        <input value="<?= @$data_anggota['nis'] ?>" name="nis" type="number" class="form-control p-2" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted text-uppercase">Kelas</label>
                        <input value="<?= @$data_anggota['kelas'] ?>" name="kelas" type="text" class="form-control p-2" placeholder="Contoh: XII TKR 1" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted text-uppercase">Nama Lengkap</label>
                    <input value="<?= @$data_anggota['nama_anggota'] ?>" name="nama_anggota" type="text" class="form-control p-2" required>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted text-uppercase">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-at"></i></span>
                            <input value="<?= @$data_anggota['username'] ?>" name="username" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted text-uppercase">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                            <input value="<?= @$data_anggota['password'] ?>" name="password" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="pt-3 border-top">
                    <button name="tombol" type="submit" class="btn btn-primary px-5 fw-bold">SIMPAN DATA</button>
                    <a href="?halaman=data_anggota" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if(isset($_POST['tombol'])){
    include '../koneksi.php';
    $nis = $_POST['nis'];
    $nama_anggota = $_POST['nama_anggota'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $kelas = $_POST['kelas'];

    $query = "INSERT INTO anggota(nis,nama_anggota, username, password, kelas) VALUES('$nis', '$nama_anggota', '$username', '$pass', '$kelas')";
    $data = mysqli_query($koneksi, $query);

    if($data){
        echo "<script>alert('data tersimpan'); window.location.assign('?halaman=data_anggota');</script>";
    } else {
        echo "<script>alert('data gagal tersimpan'); window.location.assign('?halaman=input_anggota');</script>";
    }
}
?>