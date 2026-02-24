<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold m-0" style="color: #003366;">
        <i class="bi bi-people-fill me-2"></i>Data Anggota
    </h3>
    <a href="?halaman=input_anggota" class="btn btn-primary px-4 shadow-sm">
        <i class="bi bi-person-plus me-1"></i> Register Siswa
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background-color: #f8f9fa;">
                <tr class="text-uppercase small fw-bold" style="color: #003366;">
                    <th class="ps-4 py-3">Nama Lengkap</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Akun</th>
                    <th class="text-center">Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                include "../koneksi.php";
                $data = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY id_anggota DESC");
                foreach($data as $anggota) {
                ?>
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width: 35px; height: 35px; font-size: 12px;">
                                <?= substr($anggota['nama_anggota'], 0, 2); ?>
                            </div>
                            <span class="fw-bold"><?= $anggota['nama_anggota']; ?></span>
                        </div>
                    </td>
                    <td class="text-muted fw-semibold small"><?= $anggota['nis']; ?></td>
                    <td><span class="badge bg-light text-dark border px-3"><?= $anggota['kelas']; ?></span></td>
                    <td>
                        <div class="small"><i class="bi bi-at text-primary me-1"></i><?= $anggota['username']; ?></div>
                        <div class="small text-muted"><i class="bi bi-lock text-muted me-1"></i>*******</div>
                    </td>
                    <td class="text-center">
                        <a href="?halaman=edit_anggota&id=<?= $anggota['id_anggota']; ?>" class="btn btn-sm btn-outline-warning border-0 rounded-pill px-3">Edit</a>
                        <a onclick="return confirm('Hapus anggota ini?')" href="?halaman=hapus_anggota&id=<?= $anggota['id_anggota']; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-pill px-3">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>