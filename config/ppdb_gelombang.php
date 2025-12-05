<?php
// File: config/ppdb_gelombang.php
// Struktur tabel: id, tanggal_mulai, bulan_mulai, gelombang
// Contoh penggunaan: include dan query dari sini

require_once(dirname(__FILE__) . '/database.php');

function get_gelombang_ppdb($koneksi) {
    $result = mysqli_query($koneksi, "SELECT * FROM ppdb_gelombang ORDER BY gelombang ASC");
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

function set_gelombang_ppdb($koneksi, $tanggal, $bulan, $gelombang) {
    $tanggal = mysqli_real_escape_string($koneksi, $tanggal);
    $bulan = mysqli_real_escape_string($koneksi, $bulan);
    $gelombang = (int)$gelombang;
    mysqli_query($koneksi, "INSERT INTO ppdb_gelombang (tanggal_mulai, bulan_mulai, gelombang) VALUES ('$tanggal', '$bulan', $gelombang)");
}

?>