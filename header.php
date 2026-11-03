<?php
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($page_title)) {
    $page_title = "Portal O2SN | Pendataan Perlombaan Sekolah";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome 6.5.1 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Modern Stylesheet -->
    <link rel="stylesheet" href="css/custom.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">
            <span class="brand-icon">
                <i class="fa-solid fa-trophy"></i>
            </span>
            <div>
                <div class="fw-bold lh-1" style="font-size: 1.15rem;">PORTAL O2SN</div>
                <small class="text-white-50" style="font-size: 0.72rem; font-weight: 500;">Pendataan Perlombaan Sekolah</small>
            </div>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                <li class="nav-item">
                    <a class="nav-link-custom <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom <?php echo (in_array($current_page, ['data_peserta.php', 't_data_peserta.php', 'edit_peserta.php'])) ? 'active' : ''; ?>" href="data_peserta.php">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span>Data Peserta</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom <?php echo (in_array($current_page, ['data_sekolah.php', 't_data_sekolah.php', 'edit_sekolah.php'])) ? 'active' : ''; ?>" href="data_sekolah.php">
                        <i class="fa-solid fa-school"></i>
                        <span>Data Sekolah</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom <?php echo (in_array($current_page, ['data_lomba.php', 't_data_lomba.php', 'edit_lomba.php'])) ? 'active' : ''; ?>" href="data_lomba.php">
                        <i class="fa-solid fa-medal"></i>
                        <span>Data Lomba</span>
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2 mt-2 mt-lg-0">
                <div class="dropdown">
                    <button class="btn btn-light btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm dropdown-toggle text-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-plus me-1"></i> Tambah Data
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2">
                        <li>
                            <a class="dropdown-item py-2" href="t_data_peserta.php">
                                <i class="fa-solid fa-user-plus text-primary me-2"></i> Tambah Peserta
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="t_data_sekolah.php">
                                <i class="fa-solid fa-school-flag text-success me-2"></i> Tambah Sekolah
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="t_data_lomba.php">
                                <i class="fa-solid fa-trophy text-warning me-2"></i> Tambah Lomba
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="py-4">
