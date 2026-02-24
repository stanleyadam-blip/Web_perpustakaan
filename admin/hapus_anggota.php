<?php 
$id = $_GET['id'];
include '../koneksi.php'; 
$query = mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota='$id'"); 
if($query) {
    echo "<script>
        alert('Data berhasil dihapus');
        window.location.assign('?halaman=data_anggota');
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data');
        window.location.assign('?halaman=data_anggota');
    </script>";
}
?>