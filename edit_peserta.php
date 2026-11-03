<?php
$page_title = "Edit Peserta | Portal O2SN";
include "koneksi.php";

$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_peserta = intval($_POST["id_peserta"]);
    $nama = input($_POST["nama_peserta"]);
    $jekel = input($_POST["jekel"]);
    $sekolah = input($_POST["sekolah"]);
    $jurusan = input($_POST["jurusan"]);
    $jenis_lomba = input($_POST["jenis_lomba"]);
    $no_hp = input($_POST["no_hp"]);
    $alamat = input($_POST["alamat"]);

    if (empty($nama) || empty($jekel) || empty($sekolah)) {
        $error_msg = "Nama peserta, jenis kelamin, dan asal sekolah wajib diisi!";
    } else {
        $sql = "UPDATE peserta SET 
                    nama_peserta = '$nama',
                    jekel = '$jekel',
                    sekolah = '$sekolah',
                    jurusan = '$jurusan',
                    jenis_lomba = '$jenis_lomba',
                    no_hp = '$no_hp',
                    alamat = '$alamat'
                WHERE id_peserta = $id_peserta";
        $hasil = mysqli_query($kon, $sql);

        if ($hasil) {
            header("Location: data_peserta.php?status=updated");
            exit;
        } else {
            $error_msg = "Data gagal diperbarui: " . mysqli_error($kon);
        }
    }
}

// Ambil data yang akan diedit
if (isset($_GET['id_peserta'])) {
    $id_peserta = intval($_GET["id_peserta"]);
    $sql = "SELECT * FROM peserta WHERE id_peserta = $id_peserta";
    $hasil = mysqli_query($kon, $sql);
    $data = mysqli_fetch_assoc($hasil);

    if (!$data) {
        header("Location: data_peserta.php");
        exit;
    }
} elseif ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: data_peserta.php");
    exit;
}

// Ambil daftar sekolah untuk suggestions
$q_sekolah = mysqli_query($kon, "SELECT nama_sekolah FROM sekolah ORDER BY nama_sekolah ASC");

// Ambil daftar lomba untuk suggestions
$q_lomba = mysqli_query($kon, "SELECT nama_lomba FROM lomba ORDER BY nama_lomba ASC");

include "header.php";

$curr_jekel = isset($data['jekel']) ? strtolower(trim($data['jekel'])) : '';
$is_male = (strpos($curr_jekel, 'laki') !== false);
?>

<div class="container-fluid px-4 px-lg-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item"><a href="index.php"><i class="fa-solid fa-house me-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item"><a href="data_peserta.php">Data Peserta</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Peserta</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card-custom">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-user-pen text-primary"></i>
                        <span>Edit Data Peserta: <strong><?php echo htmlspecialchars($data['nama_peserta'] ?? ''); ?></strong></span>
                    </div>
                    <a href="data_peserta.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
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
                        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>">

                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="form-label-custom">Nama Lengkap Peserta <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-user input-icon"></i>
                                    <input type="text" name="nama_peserta" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['nama_peserta'] ?? ''); ?>" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label-custom">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jekel" class="form-select form-select-custom" required>
                                    <option value="Laki-Laki" <?php echo ($is_male) ? 'selected' : ''; ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?php echo (!$is_male) ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Asal Sekolah <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-school input-icon"></i>
                                    <input type="text" name="sekolah" list="listSekolah" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['sekolah'] ?? ''); ?>" required>
                                </div>
                                <datalist id="listSekolah">
                                    <?php while ($s = mysqli_fetch_assoc($q_sekolah)): ?>
                                        <option value="<?php echo htmlspecialchars($s['nama_sekolah']); ?>"></option>
                                    <?php endwhile; ?>
                                </datalist>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Jurusan / Kelas <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-graduation-cap input-icon"></i>
                                    <input type="text" name="jurusan" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['jurusan'] ?? ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Cabang / Jenis Lomba <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-medal input-icon"></i>
                                    <input type="text" name="jenis_lomba" list="listLomba" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['jenis_lomba'] ?? ''); ?>" required>
                                </div>
                                <datalist id="listLomba">
                                    <?php while ($l = mysqli_fetch_assoc($q_lomba)): ?>
                                        <option value="<?php echo htmlspecialchars($l['nama_lomba']); ?>"></option>
                                    <?php endwhile; ?>
                                </datalist>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">No. WhatsApp / HP <span class="text-danger">*</span></label>
                                <div class="input-icon-group">
                                    <i class="fa-solid fa-phone input-icon"></i>
                                    <input type="tel" name="no_hp" class="form-control form-control-custom" value="<?php echo htmlspecialchars($data['no_hp'] ?? ''); ?>" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat" class="form-control form-control-custom" rows="3" required><?php echo htmlspecialchars($data['alamat'] ?? ''); ?></textarea>
                            </div>

                            <div class="col-12 pt-3 border-top d-flex gap-2 justify-content-end">
                                <a href="data_peserta.php" class="btn btn-light px-4 py-2 rounded-pill fw-semibold border">
                                    Batal
                                </a>
                                <button type="submit" name="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
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
