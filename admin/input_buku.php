<div class="row justify-content-center">
    <div class="col-md-8">
        <h3 class="fw-bold mb-4" style="color: #003366;">Tambah Koleksi Buku</h3>
        <div class="card p-4 border-0 shadow-sm">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Buku</label>
                    <input name="judul_buku" type="text" class="form-control" placeholder="Nama Buku" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Pengarang</label>
                        <input name="pengarang" type="text" class="form-control" placeholder="Nama Penulis" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Penerbit</label>
                        <input name="penerbit" type="text" class="form-control" placeholder="Nama Penerbit" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input name="tahun_terbit" type="number" class="form-control" placeholder="YYYY" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Cover Buku</label>
                        <input name="gambar" type="file" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="mt-3">
                    <button name="tombol" type="submit" class="btn btn-primary px-5">SIMPAN DATA</button>
                    <a href="?halaman=data_buku" class="btn btn-outline-secondary px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['tombol'])) {
    include "../koneksi.php";
    $judul_buku   = $_POST['judul_buku'];
    $pengarang    = $_POST['pengarang'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $status       = "tersedia";

    // Image Upload Logic
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    
    // Default image if no upload
    $gambar_final = "default_book.jpg";

    if($nama_file != "") {
        $ekstensi_diperbolehkan = array('png','jpg','jpeg');
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));
        
        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            // Rename file to avoid duplicates
            $gambar_final = time() . "_" . $nama_file;
            move_uploaded_file($tmp_file, "../assets/img/" . $gambar_final);
        }
    }

    $query = "INSERT INTO buku (judul_buku, pengarang, penerbit, tahun_terbit, status, gambar) 
              VALUES ('$judul_buku', '$pengarang', '$penerbit', '$tahun_terbit', '$status', '$gambar_final')";
    
    $data = mysqli_query($koneksi, $query);

    if($data) {
        echo "<script>alert('Buku berhasil ditambahkan!'); window.location.assign('?halaman=data_buku');</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data.');</script>";
    }
}
?>