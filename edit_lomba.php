<?php
$page_title = "Edit Lomba | Portal O2SN";
include "koneksi.php";

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_lomba = intval($_POST["id_lomba"]);
    $nama_lomba = input($_POST["nama_lomba"]);
    $tingkat_lomba = input($_POST["tingkat_lomba"]);
    $tanggal_lomba = input($_POST["tanggal_lomba"]);

    if (empty($nama_lomba) || empty($tingkat_lomba) || empty($tanggal_lomba)) {
        $error_msg = "Semua bidang formulir perlombaan wajib diisi!";
    } else {
        $sql = "UPDATE lomba SET 
                    nama_lomba = '$nama_lomba',
                    tingkat_lomba = '$tingkat_lomba',
                    tanggal_lomba = '$tanggal_lomba'
                WHERE id_lomba = $id_lomba";
        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            header("Location: data_lomba.php?status=updated");
            exit;
        } else {
            $error_msg = "Data cabang lomba gagal diperbarui: " . mysqli_error($kon);
        }
    }
}

// Ambil data lomba yang akan diedit
if (isset($_GET['id_lomba'])) {
    $id_lomba = intval($_GET["id_lomba"]);
    $sql = "SELECT * FROM lomba WHERE id_lomba = $id_lomba";
    $hasil = mysqli_query($kon, $sql);
    $data = mysqli_fetch_assoc($hasil);

    if (!$data) {
        header("Location: data_lomba.php");
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: data_lomba.php");
    exit;
}

include "header.php";
$tingkat = $data['tingkat_lomba'] ?? '';
?>

<div class="container-fluid px-4 px-lg-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa-solid fa-house me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="data_lomba.php">Data Lomba</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Lomba</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card-custom">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-trophy text-warning"></i>
                        <span>Edit Data Cabang Lomba: <strong><?php echo htmlspecialchars($data['nama_lomba'] ?? ''); ?></strong></span>
                    </div>
                    <a href="data_lomba.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="p-4 p-md-5">
                    <?php if (!empty($error_msg)): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo htmlspecialchars($error_msg); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="hidden" name="id_lomba" value="<?php echo $data['id_lomba']; ?>">

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label-custom">Nama Cabang Lomba <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-medal input-icon"></i>
                                    <input type="text" name="nama_lomba" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['nama_lomba'] ?? ''); ?>" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Tingkat Perlombaan <span class="text-danger">*</span></label>
                                <select name="tingkat_lomba" class="form-select form-select-custom" required>
                                    <option value="SD" <?php echo ($tingkat == 'SD') ? 'selected' : ''; ?>>SD / Sederajat</option>
                                    <option value="SMP/SLTP Sederajad" <?php echo (strpos($tingkat, 'SMP') !== false) ? 'selected' : ''; ?>>SMP / SLTP Sederajat</option>
                                    <option value="SMA/SLTA Sederajad" <?php echo (strpos($tingkat, 'SMA') !== false) ? 'selected' : ''; ?>>SMA / SLTA Sederajat</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Tanggal Pelaksanaan <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-calendar-day input-icon"></i>
                                    <input type="date" name="tanggal_lomba" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['tanggal_lomba'] ?? ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-12 pt-3 border-top d-flex gap-2 justify-content-end">
                                <a href="data_lomba.php" class="btn btn-light px-4 py-2 rounded-pill fw-semibold border">
                                    Batal
                                </a>
                                <button type="submit" name="submit" class="btn btn-warning px-4 py-2 rounded-pill fw-semibold shadow-sm text-dark">
                                    <i class="fa-solid fa-check me-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
