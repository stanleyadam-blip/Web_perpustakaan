<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0" style="color: #003366;">
        <i class="bi bi-book-half me-2"></i>Koleksi Buku
    </h3>
    <a href="?halaman=input_buku" class="btn btn-primary px-4 shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Buku
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-uppercase small fw-bold" style="color: #003366;">
                    <th class="ps-4 py-3">No</th>
                    <th>Cover</th>
                    <th>Informasi Buku</th>
                    <th>Penerbit</th>
                    <th>Status</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                include "../koneksi.php";
                $query = "SELECT * FROM buku ORDER BY id_buku DESC";
                $data = mysqli_query($koneksi, $query);
                foreach($data as $buku) {
                    $img = !empty($buku['gambar']) ? $buku['gambar'] : 'default_book.jpg';
                ?>
                <tr>
                    <td class="ps-4 fw-bold text-muted"><?= $no++; ?></td>
                    <td>
                        <img src="../assets/img/<?= $img ?>" class="rounded shadow-sm" style="width: 45px; height: 60px; object-fit: cover;">
                    </td>
                    <td>
                        <div class="fw-bold text-dark"><?= $buku['judul_buku']; ?></div>
                        <div class="small text-muted"><?= $buku['pengarang']; ?> (<?= $buku['tahun_terbit']; ?>)</div>
                    </td>
                    <td><span class="text-muted small"><?= $buku['penerbit']; ?></span></td>
                    <td>
                        <?php if($buku['status'] == 'tersedia'): ?>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3">Tersedia</span>
                        <?php else: ?>
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3">Dipinjam</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="btn-group shadow-sm">
                            <a href="?halaman=edit_buku&id=<?= $buku['id_buku']; ?>" class="btn btn-sm btn-light border" title="Edit">
                                <i class="bi bi-pencil text-warning"></i>
                            </a>
                            <a onclick="return confirm('Hapus buku ini?')" href="?halaman=hapus_buku&id=<?= $buku['id_buku']; ?>" class="btn btn-sm btn-light border" title="Hapus">
                                <i class="bi bi-trash text-danger"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>