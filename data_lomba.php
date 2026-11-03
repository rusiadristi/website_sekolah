<?php
$page_title = "Data Cabang Lomba | Portal O2SN";
include "koneksi.php";

$status_msg = "";
$status_type = "";

// Handle proses hapus data dengan proteksi intval
if (isset($_GET['id_lomba'])) {
    $id_lomba = intval($_GET["id_lomba"]);

    $sql = "DELETE FROM lomba WHERE id_lomba = $id_lomba";
    $hasil = mysqli_query($kon, $sql);

    if ($hasil) {
        header("Location: data_lomba.php?status=deleted");
        exit;
    } else {
        $status_msg = "Gagal menghapus data lomba: " . mysqli_error($kon);
        $status_type = "danger";
    }
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'deleted') {
        $status_msg = "Data cabang lomba berhasil dihapus dari sistem.";
        $status_type = "success";
    } elseif ($_GET['status'] == 'added') {
        $status_msg = "Data cabang lomba baru berhasil ditambahkan!";
        $status_type = "success";
    } elseif ($_GET['status'] == 'updated') {
        $status_msg = "Data cabang lomba berhasil diperbarui!";
        $status_type = "success";
    }
}

include "header.php";

$sql = "SELECT l.*, (SELECT COUNT(*) FROM peserta p WHERE p.jenis_lomba = l.nama_lomba) as jml_peserta 
        FROM lomba l 
        ORDER BY l.id_lomba DESC";
$hasil = mysqli_query($kon, $sql);
$total_rows = ($hasil) ? mysqli_num_rows($hasil) : 0;
?>

<div class="container-fluid px-4 px-lg-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa-solid fa-house me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Cabang Lomba</li>
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
                <span class="fs-5 fw-bold text-dark"><i class="fa-solid fa-trophy text-warning me-2"></i>Daftar Cabang Perlombaan O2SN</span>
                <span class="badge bg-warning-subtle text-warning rounded-pill px-2 py-1"><?php echo $total_rows; ?> Cabang Lomba</span>
            </div>
            
            <div class="d-flex align-items-center gap-2 ms-auto flex-wrap">
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="tableSearch" class="form-control form-control-sm form-control-custom" placeholder="Cari cabang lomba, tingkat...">
                </div>
                <a href="t_data_lomba.php" class="btn btn-warning btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm text-nowrap text-dark">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Lomba
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Nama Cabang Lomba</th>
                        <th>Tingkat Perlombaan</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th class="text-center">Peserta Terdaftar</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($total_rows > 0) {
                        $no = 0;
                        while ($data = mysqli_fetch_array($hasil)) {
                            $no++;
                    ?>
                    <tr>
                        <td class="text-center fw-semibold text-muted"><?php echo $no; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-initial" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                                    <i class="fa-solid fa-trophy" style="font-size: 0.9rem;"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($data['nama_lomba']); ?></div>
                                    <small class="text-muted">Kode: #LMB-<?php echo str_pad($data['id_lomba'], 3, '0', STR_PAD_LEFT); ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge-custom badge-level">
                                <i class="fa-solid fa-layer-group"></i> <?php echo htmlspecialchars($data['tingkat_lomba']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="fw-medium text-dark">
                                <i class="fa-regular fa-calendar-check text-primary me-1"></i> <?php echo tgl_indo($data['tanggal_lomba']); ?>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="badge-custom badge-lomba">
                                <i class="fa-solid fa-users"></i> <?php echo $data['jml_peserta']; ?> Peserta
                            </span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="edit_lomba.php?id_lomba=<?php echo $data['id_lomba']; ?>" class="btn-action btn-action-edit me-1" title="Edit Lomba">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="data_lomba.php?id_lomba=<?php echo $data['id_lomba']; ?>" class="btn-action btn-action-delete btn-delete-confirm" data-name="Lomba '<?php echo htmlspecialchars($data['nama_lomba']); ?>'" title="Hapus Lomba">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="text-muted mb-3" style="font-size: 3rem;">
                                <i class="fa-regular fa-folder-open"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Belum Ada Data Perlombaan</h6>
                            <p class="text-muted small mb-3">Silakan tambahkan cabang perlombaan O2SN baru.</p>
                            <a href="t_data_lomba.php" class="btn btn-warning btn-sm px-4 py-2 rounded-pill text-dark">
                                <i class="fa-solid fa-plus me-1"></i> Tambah Lomba Sekarang
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
