<?php
$page_title = "Data Peserta | Portal O2SN";
include "koneksi.php";

// Handle proses hapus data dengan proteksi intval
$status_msg = "";
$status_type = "";

if (isset($_GET['id_peserta'])) {
    $id_peserta = intval($_GET["id_peserta"]);

    $sql = "DELETE FROM peserta WHERE id_peserta = $id_peserta";
    $hasil = mysqli_query($kon, $sql);

    if ($hasil) {
        header("Location: data_peserta.php?status=deleted");
        exit;
    } else {
        $status_msg = "Gagal menghapus data peserta: " . mysqli_error($kon);
        $status_type = "danger";
    }
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'deleted') {
        $status_msg = "Data peserta berhasil dihapus dari sistem.";
        $status_type = "success";
    } elseif ($_GET['status'] == 'added') {
        $status_msg = "Data peserta baru berhasil ditambahkan!";
        $status_type = "success";
    } elseif ($_GET['status'] == 'updated') {
        $status_msg = "Data peserta berhasil diperbarui!";
        $status_type = "success";
    }
}

include "header.php";

$sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";
$hasil = mysqli_query($kon, $sql);
$total_rows = ($hasil) ? mysqli_num_rows($hasil) : 0;
?>

<div class="container-fluid px-4 px-lg-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa-solid fa-house me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Peserta</li>
        </ol>
    </nav>

    <!-- Alert Notifications -->
    <?php if (!empty($status_msg)): ?>
        <div class="alert alert-<?php echo $status_type; ?> alert-dismissible fade show alert-auto-dismiss rounded-3 shadow-sm border-0 mb-4" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> <?php echo htmlspecialchars($status_msg); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Main Card -->
    <div class="card-custom">
        <div class="card-header-custom flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <span class="fs-5 fw-bold text-dark"><i class="fa-solid fa-user-graduate text-primary me-2"></i>Daftar Peserta Pelatihan & Lomba</span>
                <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1"><?php echo $total_rows; ?> Siswa</span>
            </div>
            
            <div class="d-flex align-items-center gap-2 ms-auto flex-wrap">
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="tableSearch" class="form-control form-control-sm form-control-custom" placeholder="Cari nama, sekolah, lomba...">
                </div>
                <a href="t_data_peserta.php" class="btn btn-primary btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm text-nowrap">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Peserta
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Peserta</th>
                        <th>Jenis Kelamin</th>
                        <th>Asal Sekolah</th>
                        <th>Jurusan</th>
                        <th>Jenis Lomba</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($total_rows > 0) {
                        $no = 0;
                        while ($data = mysqli_fetch_array($hasil)) {
                            $no++;
                            $initial = strtoupper(substr($data['nama_peserta'], 0, 1));
                            $is_male = (strpos(strtolower($data['jekel']), 'laki') !== false);
                            
                            // Format clean phone for WA link
                            $clean_phone = preg_replace('/[^0-9]/', '', $data['no_hp']);
                            if (substr($clean_phone, 0, 1) === '0') {
                                $wa_phone = '62' . substr($clean_phone, 1);
                            } else {
                                $wa_phone = $clean_phone;
                            }
                    ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?php echo $no; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial"><?php echo $initial; ?></div>
                                <div class="fw-bold text-dark"><?php echo htmlspecialchars($data['nama_peserta']); ?></div>
                            </div>
                        </td>
                        <td>
                            <?php if ($is_male): ?>
                                <span class="badge-custom badge-gender-male">
                                    <i class="fa-solid fa-mars"></i> Laki-Laki
                                </span>
                            <?php else: ?>
                                <span class="badge-custom badge-gender-female">
                                    <i class="fa-solid fa-venus"></i> Perempuan
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="fw-medium text-dark"><?php echo htmlspecialchars($data['sekolah']); ?></span>
                        </td>
                        <td>
                            <span class="text-muted"><?php echo htmlspecialchars($data['jurusan']); ?></span>
                        </td>
                        <td>
                            <span class="badge-custom badge-lomba">
                                <i class="fa-solid fa-medal"></i> <?php echo htmlspecialchars($data['jenis_lomba']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="https://wa.me/<?php echo $wa_phone; ?>" target="_blank" class="text-decoration-none fw-medium text-dark small" title="Hubungi via WhatsApp">
                                <i class="fa-brands fa-whatsapp text-success me-1"></i> <?php echo htmlspecialchars($data['no_hp']); ?>
                            </a>
                        </td>
                        <td>
                            <span class="small text-muted"><?php echo htmlspecialchars($data['alamat']); ?></span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="edit_peserta.php?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn-action btn-action-edit me-1" title="Edit Peserta">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="data_peserta.php?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn-action btn-action-delete btn-delete-confirm" data-name="Peserta '<?php echo htmlspecialchars($data['nama_peserta']); ?>'" title="Hapus Peserta">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="text-muted mb-3" style="font-size: 3rem;">
                                <i class="fa-regular fa-folder-open"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Belum Ada Data Peserta</h6>
                            <p class="text-muted small mb-3">Silakan tambahkan data peserta pelatihan dan perlombaan baru.</p>
                            <a href="t_data_peserta.php" class="btn btn-primary btn-sm px-4 py-2 rounded-pill">
                                <i class="fa-solid fa-plus me-1"></i> Tambah Peserta Sekarang
                            </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
