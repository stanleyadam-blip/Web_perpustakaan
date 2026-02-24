<?php
// Get the ID from the URL
$id = $_GET['id'];
include "../koneksi.php";

// Execute the deletion
$query = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id'");

if ($query) {
    // Use JavaScript redirect to avoid "headers already sent" error
    echo "<script>
            alert('Buku berhasil dihapus!');
            window.location.assign('?halaman=data_buku');
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus buku.');
            window.location.assign('?halaman=data_buku');
          </script>";
}
?>