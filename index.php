<?php
$page_title = "Dashboard | Portal O2SN Perlombaan";
include "koneksi.php";
include "header.php";

// Ambil statistik real-time dari database
$q_peserta = mysqli_query($kon, "SELECT COUNT(*) as total FROM peserta");
$total_peserta = ($q_peserta) ? mysqli_fetch_assoc($q_peserta)['total'] : 0;

$q_sekolah = mysqli_query($kon, "SELECT COUNT(*) as total FROM sekolah");
$total_sekolah = ($q_sekolah) ? mysqli_fetch_assoc($q_sekolah)['total'] : 0;

$q_lomba = mysqli_query($kon, "SELECT COUNT(*) as total FROM lomba");
$total_lomba = ($q_lomba) ? mysqli_fetch_assoc($q_lomba)['total'] : 0;

// Daftar hari dalam bahasa Indonesia
$hari_array = array(
    'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
);
$hari_ini = $hari_array[date('l')];
$tanggal_sekarang = $hari_ini . ', ' . tgl_indo(date('Y-m-d'));
?>

<div class="container-fluid px-4 px-lg-5">
    <!-- Hero Banner -->
    <div class="dashboard-hero">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <span class="badge bg-white text-primary px-3 py-1 rounded-pill mb-3 fw-bold shadow-sm">
                    <i class="fa-solid fa-calendar-day me-1"></i> <?php echo $tanggal_sekarang; ?>
                </span>
                <h2 class="display-6 fw-bold mb-2">Selamat Datang di Portal O2SN</h2>
                <p class="lead mb-4 text-white-50" style="font-size: 1.05rem;">
                    Sistem informasi manajemen pendataan peserta, sekolah, dan cabang perlombaan O2SN secara terpadu, terstruktur, dan profesional.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="data_peserta.php" class="btn btn-light px-4 py-2 rounded-pill fw-semibold shadow-sm text-primary">
                        <i class="fa-solid fa-list-check me-1"></i> Kelola Peserta
                    </a>
                    <a href="t_data_peserta.php" class="btn btn-outline-light px-4 py-2 rounded-pill fw-semibold">
                        <i class="fa-solid fa-plus me-1"></i> Tambah Peserta Baru
                    </a>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-flex justify-content-center">
                <div style="font-size: 8rem; color: rgba(255,255,255,0.18);">
                    <i class="fa-solid fa-award"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="stat-label">Total Peserta</div>
                        <div class="stat-number"><?php echo number_format($total_peserta); ?></div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-blue">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                    <span class="small text-muted">Siswa telah terdaftar</span>
                    <a href="data_peserta.php" class="small fw-bold text-decoration-none text-primary">
                        Lihat Data <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="stat-label">Total Sekolah</div>
                        <div class="stat-number"><?php echo number_format($total_sekolah); ?></div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-emerald">
                        <i class="fa-solid fa-school"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                    <span class="small text-muted">Sekolah berpartisipasi</span>
                    <a href="data_sekolah.php" class="small fw-bold text-decoration-none text-success">
                        Lihat Data <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <div class="stat-label">Cabang Lomba</div>
                        <div class="stat-number"><?php echo number_format($total_lomba); ?></div>
                    </div>
                    <div class="stat-icon-wrapper stat-icon-amber">
                        <i class="fa-solid fa-trophy"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                    <span class="small text-muted">Kategori lomba tersedia</span>
                    <a href="data_lomba.php" class="small fw-bold text-decoration-none text-warning">
                        Lihat Data <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Preview Grid -->
    <div class="row g-4">
        <!-- Peserta Terbaru -->
        <div class="col-lg-7">
            <div class="card-custom h-100">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-clock-rotate-left text-primary"></i>
                        <span>Peserta Terbaru Terdaftar</span>
                    </div>
                    <a href="data_peserta.php" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        Semua Peserta
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Peserta</th>
                                <th>Asal Sekolah</th>
                                <th>Jenis Lomba</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q_recent_peserta = mysqli_query($kon, "SELECT * FROM peserta ORDER BY id_peserta DESC LIMIT 5");
                            if ($q_recent_peserta && mysqli_num_rows($q_recent_peserta) > 0) {
                                while ($p = mysqli_fetch_assoc($q_recent_peserta)) {
                                    $initial = strtoupper(substr($p['nama_peserta'], 0, 1));
                                    $jekel = trim($p['jekel']);
                                    $is_male = (strpos(strtolower($jekel), 'laki') !== false);
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initial"><?php echo $initial; ?></div>
                                        <div>
                                            <div class="fw-semibold text-dark"><?php echo htmlspecialchars($p['nama_peserta']); ?></div>
                                            <small>
                                                <?php if ($is_male): ?>
                                                    <span class="badge-custom badge-gender-male py-0 px-2" style="font-size: 0.7rem;">Laki-Laki</span>
                                                <?php else: ?>
                                                    <span class="badge-custom badge-gender-female py-0 px-2" style="font-size: 0.7rem;">Perempuan</span>
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium text-dark small"><?php echo htmlspecialchars($p['sekolah']); ?></div>
                                    <div class="text-muted small"><?php echo htmlspecialchars($p['jurusan']); ?></div>
                                </td>
                                <td>
                                    <span class="badge-custom badge-lomba">
                                        <i class="fa-solid fa-medal"></i> <?php echo htmlspecialchars($p['jenis_lomba']); ?>
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="edit_peserta.php?id_peserta=<?php echo $p['id_peserta']; ?>" class="btn-action btn-action-edit" title="Edit Peserta">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="4" class="text-center py-4 text-muted"><i class="fa-regular fa-folder-open me-2"></i>Belum ada data peserta.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Jadwal / Cabang Lomba -->
        <div class="col-lg-5">
            <div class="card-custom h-100">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-trophy text-warning"></i>
                        <span>Cabang Perlombaan</span>
                    </div>
                    <a href="data_lomba.php" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                        Semua Lomba
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Nama Lomba</th>
                                <th>Tingkat</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $q_recent_lomba = mysqli_query($kon, "SELECT * FROM lomba ORDER BY id_lomba DESC LIMIT 5");
                            if ($q_recent_lomba && mysqli_num_rows($q_recent_lomba) > 0) {
                                while ($l = mysqli_fetch_assoc($q_recent_lomba)) {
                            ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold text-dark"><?php echo htmlspecialchars($l['nama_lomba']); ?></div>
                                </td>
                                <td>
                                    <span class="badge-custom badge-level">
                                        <?php echo htmlspecialchars($l['tingkat_lomba']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="small text-muted">
                                        <i class="fa-regular fa-calendar me-1"></i> <?php echo tgl_indo($l['tanggal_lomba']); ?>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo '<tr><td colspan="3" class="text-center py-4 text-muted"><i class="fa-regular fa-folder-open me-2"></i>Belum ada data lomba.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
