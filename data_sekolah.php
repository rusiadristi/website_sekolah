<?php
$page_title = "Data Sekolah | Portal O2SN";
include "koneksi.php";

$status_msg = "";
$status_type = "";

// Handle proses hapus data dengan proteksi intval
if (isset($_GET['id_sekolah'])) {
    $id_sekolah = intval($_GET["id_sekolah"]);

    $sql = "DELETE FROM sekolah WHERE id_sekolah = $id_sekolah";
    $hasil = mysqli_query($kon, $sql);

    if ($hasil) {
        header("Location: data_sekolah.php?status=deleted");
        exit;
    } else {
        $status_msg = "Gagal menghapus data sekolah: " . mysqli_error($kon);
        $status_type = "danger";
    }
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'deleted') {
        $status_msg = "Data sekolah berhasil dihapus dari sistem.";
        $status_type = "success";
    } elseif ($_GET['status'] == 'added') {
        $status_msg = "Data sekolah baru berhasil ditambahkan!";
        $status_type = "success";
    } elseif ($_GET['status'] == 'updated') {
        $status_msg = "Data sekolah berhasil diperbarui!";
        $status_type = "success";
    }
}

include "header.php";

$sql = "SELECT s.*, (SELECT COUNT(*) FROM peserta p WHERE p.sekolah = s.nama_sekolah) as jml_peserta 
        FROM sekolah s 
        ORDER BY s.id_sekolah DESC";
$hasil = mysqli_query($kon, $sql);
$total_rows = ($hasil) ? mysqli_num_rows($hasil) : 0;
?>

<div class="container-fluid px-4 px-lg-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa-solid fa-house me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Sekolah</li>
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
                <span class="fs-5 fw-bold text-dark"><i class="fa-solid fa-school text-success me-2"></i>Daftar Sekolah Berpartisipasi</span>
                <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1"><?php echo $total_rows; ?> Sekolah</span>
            </div>
            
            <div class="d-flex align-items-center gap-2 ms-auto flex-wrap">
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="tableSearch" class="form-control form-control-sm form-control-custom" placeholder="Cari nama sekolah, kontak, alamat...">
                </div>
                <a href="t_data_sekolah.php" class="btn btn-success btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm text-nowrap">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Sekolah
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-custom align-middle">
                <thead>
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th>Nama Sekolah</th>
                        <th>Kontak / Telepon</th>
                        <th>Alamat Lengkap</th>
                        <th class="text-center">Partisipasi Peserta</th>
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
                                <div class="avatar-initial" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                                    <i class="fa-solid fa-school" style="font-size: 0.9rem;"></i>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($data['nama_sekolah']); ?></div>
                                    <small class="text-muted">ID: #SCH-<?php echo str_pad($data['id_sekolah'], 3, '0', STR_PAD_LEFT); ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="tel:<?php echo htmlspecialchars($data['tlp']); ?>" class="text-decoration-none fw-medium text-dark small">
                                <i class="fa-solid fa-phone text-primary me-1"></i> <?php echo htmlspecialchars($data['tlp']); ?>
                            </a>
                        </td>
                        <td>
                            <span class="small text-muted"><i class="fa-solid fa-location-dot text-danger me-1"></i> <?php echo htmlspecialchars($data['alamat']); ?></span>
                        </td>
                        <td class="text-center">
                            <span class="badge-custom badge-school">
                                <i class="fa-solid fa-user-graduate text-primary"></i> <?php echo $data['jml_peserta']; ?> Peserta
                            </span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a href="edit_sekolah.php?id_sekolah=<?php echo $data['id_sekolah']; ?>" class="btn-action btn-action-edit me-1" title="Edit Sekolah">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="data_sekolah.php?id_sekolah=<?php echo $data['id_sekolah']; ?>" class="btn-action btn-action-delete btn-delete-confirm" data-name="Sekolah '<?php echo htmlspecialchars($data['nama_sekolah']); ?>'" title="Hapus Sekolah">
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
                                <i class="fa-regular fa-building"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Belum Ada Data Sekolah</h6>
                            <p class="text-muted small mb-3">Silakan tambahkan data sekolah yang berpartisipasi.</p>
                            <a href="t_data_sekolah.php" class="btn btn-success btn-sm px-4 py-2 rounded-pill">
                                <i class="fa-solid fa-plus me-1"></i> Tambah Sekolah Sekarang
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
