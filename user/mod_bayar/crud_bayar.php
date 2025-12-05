<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
$id = $_SESSION['id_siswa'];
// accept pg from GET or POST
$pg = '';
if (isset($_GET['pg'])) $pg = $_GET['pg'];
elseif (isset($_POST['pg'])) $pg = $_POST['pg'];

if ($pg == 'ubah') {
    $verifikasi = (isset($_POST['verifikasi'])) ? 1 : 0;
    $data = [
        'nama_bayar' => $_POST['nama'],
        'verifikasi' => $verifikasi
    ];
    $id_bayar = $_POST['id_bayar'];
    $exec = update($koneksi, 'bayar', $data, ['id_bayar' => $id_bayar]);
    if ($exec) {
    echo "ok";
} else {
    echo "error: Gagal menyimpan data ke database";
}
}
if ($pg == 'tambah') {
    // Check if database connection is working
    if (!$koneksi) {
        echo "error: database_connection_failed";
        exit;
    }
    
    // Validate required POST fields
    if (!isset($_POST['id']) || !isset($_POST['jumlah']) || !isset($_POST['tgl'])) {
        echo "error: missing_required_fields";
        exit;
    }
    
    $today = date("Ymd");
    $query = "SELECT max(id_bayar) AS last FROM bayar WHERE id_bayar LIKE '$today%'";
    $hasil = mysqli_query($koneksi, $query);
    if (!$hasil) {
        echo "error: query_failed | " . mysqli_error($koneksi);
        exit;
    }
    $data  = mysqli_fetch_array($hasil);
    $lastNoTransaksi = $data['last'];
    $lastNoUrut = $lastNoTransaksi ? substr($lastNoTransaksi, 8, 4) : 0;
    $nextNoUrut = $lastNoUrut + 1;
    $nextNoTransaksi = $today . sprintf('%04s', $nextNoUrut);
    $ektensi = ['jpg', 'png', 'jpeg'];

    if (!isset($_FILES['bukti']) || $_FILES['bukti']['name'] == '') {
        echo "error: no_file_uploaded";
        exit;
    }

    $logo = $_FILES['bukti']['name'];
    $temp = $_FILES['bukti']['tmp_name'];
    $ext = strtolower(pathinfo($logo, PATHINFO_EXTENSION));

    if (!in_array($ext, $ektensi)) {
        echo "error: invalid_file_type";
        exit;
    }

    if (isset($_FILES['bukti']['error']) && $_FILES['bukti']['error'] !== 0) {
        echo "error: upload_error_code=" . $_FILES['bukti']['error'];
        exit;
    }

    // Create upload directory with absolute path
    $upload_dir = __DIR__ . '/bukti_transaksi';
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            echo "error: failed_create_upload_dir";
            exit;
        }
    }

    if (!is_writable($upload_dir)) {
        echo "error: upload_dir_not_writable";
        exit;
    }

    $dest = 'bukti_transaksi/bukti_' . $nextNoTransaksi . '.' . $ext;
    $upload_path = __DIR__ . '/' . $dest;

    // Ensure the temporary file exists and was uploaded via HTTP POST
    if (!is_uploaded_file($temp)) {
        echo "error: not_uploaded_file; tmp_exists=" . (file_exists($temp) ? '1' : '0');
        exit;
    }

    if (move_uploaded_file($temp, $upload_path)) {
        $data = [
            'id_bayar'      => $nextNoTransaksi,
            'id_daftar'     => $_POST['id'],
            'jumlah'        => str_replace(",", "", $_POST['jumlah']),
            'tgl_bayar'     => $_POST['tgl'],
            'id_user'       => 0,
            'bukti'         => $dest
        ];
        
        error_log("Attempting to insert payment data: " . print_r($data, true));
        
        $exec = insert($koneksi, 'bayar', $data);
        if ($exec) {
            echo 'ok';
        } else {
            $error = mysqli_error($koneksi);
            error_log("Database insert failed: " . $error);
            echo "error: gagal menyimpan ke database | " . $error;
        }
    } else {
        $tmp_exists = file_exists($temp) ? '1' : '0';
        $tmp_size = $tmp_exists ? filesize($temp) : 0;
        $upload_dir_exists = is_dir($upload_dir) ? '1' : '0';
        $upload_dir_writable = is_writable($upload_dir) ? '1' : '0';
        error_log("File upload failed - tmp_exists: $tmp_exists, tmp_size: $tmp_size, dir_exists: $upload_dir_exists, dir_writable: $upload_dir_writable");
        echo "error: gagal mengupload file | move_failed tmp_exists={$tmp_exists} tmp_size={$tmp_size} dir_exists={$upload_dir_exists} dir_writable={$upload_dir_writable}";
    }
    }
if ($pg == 'hapus') {
    $id_bayar = $_POST['id_bayar'];

    $bayar = fetch($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
    if (file_exists($bayar['bukti'])) {
        if (unlink($bayar['bukti'])) {
            delete($koneksi, 'bayar', ['id_bayar' => $id_bayar]);
        }
    }
}
