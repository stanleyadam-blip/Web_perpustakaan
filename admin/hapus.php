<?php
$id_transaksi = $_GET['id_transaksi'];

include "../koneksi.php";

$data = mysqli_query($koneksi, 
    "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'"
);

if($data) {
    echo "<script>
        alert('Riwayat berhasil dihapus');
        window.location.assign('?halaman=data_peminjaman');
    </script>";
}
?>
