<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "crud";

$kon = mysqli_connect($host, $user, $password, $db);
if (!$kon) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

// Helper sanitasi input
if (!function_exists('input')) {
    function input($data) {
        global $kon;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        if ($kon) {
            $data = mysqli_real_escape_string($kon, $data);
        }
        return $data;
    }
}

// Helper format tanggal Indonesia
if (!function_exists('tgl_indo')) {
    function tgl_indo($tanggal) {
        if (!$tanggal || $tanggal == '0000-00-00') return '-';
        $bulan = array(
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        );
        $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));
        return (int)$pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}
?>
