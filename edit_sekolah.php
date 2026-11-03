<?php
$page_title = "Edit Sekolah | Portal O2SN";
include "koneksi.php";

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_sekolah = intval($_POST["id_sekolah"]);
    $nama_sekolah = input($_POST["nama_sekolah"]);
    $tlp = input($_POST["tlp"]);
    $alamat = input($_POST["alamat"]);

    if (empty($nama_sekolah) || empty($tlp) || empty($alamat)) {
        $error_msg = "Semua bidang formulir sekolah wajib diisi!";
    } else {
        $sql = "UPDATE sekolah SET 
                    nama_sekolah = '$nama_sekolah',
                    tlp = '$tlp',
                    alamat = '$alamat'
                WHERE id_sekolah = $id_sekolah";
        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            header("Location: data_sekolah.php?status=updated");
            exit;
        } else {
            $error_msg = "Data sekolah gagal diperbarui: " . mysqli_error($kon);
        }
    }
}

// Ambil data sekolah yang akan diedit
if (isset($_GET['id_sekolah'])) {
    $id_sekolah = intval($_GET["id_sekolah"]);
    $sql = "SELECT * FROM sekolah WHERE id_sekolah = $id_sekolah";
    $hasil = mysqli_query($kon, $sql);
    $data = mysqli_fetch_assoc($hasil);

    if (!$data) {
        header("Location: data_sekolah.php");
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: data_sekolah.php");
    exit;
}

include "header.php";
?>

<div class="container-fluid px-4 px-lg-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa-solid fa-house me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="data_sekolah.php">Data Sekolah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Sekolah</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card-custom">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-pen-to-square text-success"></i>
                        <span>Edit Data Sekolah: <strong><?php echo htmlspecialchars($data['nama_sekolah'] ?? ''); ?></strong></span>
                    </div>
                    <a href="data_sekolah.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
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
                        <input type="hidden" name="id_sekolah" value="<?php echo $data['id_sekolah']; ?>">

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label-custom">Nama Sekolah <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-school input-icon"></i>
                                    <input type="text" name="nama_sekolah" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['nama_sekolah'] ?? ''); ?>" required autofocus>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Nomor Telepon / Kontak <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-phone input-icon"></i>
                                    <input type="text" name="tlp" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['tlp'] ?? ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Alamat Lengkap Sekolah <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control form-control-custom" rows="3" required><?php echo htmlspecialchars($data['alamat'] ?? ''); ?></textarea>
                            </div>

                            <div class="col-12 pt-3 border-top d-flex gap-2 justify-content-end">
                                <a href="data_sekolah.php" class="btn btn-light px-4 py-2 rounded-pill fw-semibold border">
                                    Batal
                                </a>
                                <button type="submit" name="submit" class="btn btn-success px-4 py-2 rounded-pill fw-semibold shadow-sm">
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
