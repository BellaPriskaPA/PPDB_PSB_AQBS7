<?php
require "../../config/database.php";
require "../../config/function.php";
require "../../config/functions.crud.php";
session_start();
if (!isset($_SESSION['id_user'])) {
    die('Anda tidak diijinkan mengakses langsung');
}
$pg = isset($_GET['pg']) ? $_GET['pg'] : (isset($_POST['pg']) ? $_POST['pg'] : null);
function send_response($exec) {
    if ($exec) {
        echo "ok";
    } else {
        echo "Gagal menyimpan";
    }
}
if ($pg == 'aktif') {
    $ppdb = isset($_POST['ppdb']) ? $_POST['ppdb'] : 0;
    $exec = update($koneksi, 'setting', ['ppdb' => 1], ['ppdb' => $ppdb]);
    send_response($exec);
}
if ($pg == 'tutup') {
    $ppdb = isset($_POST['ppdb']) ? $_POST['ppdb'] : 0;
    $exec = update($koneksi, 'setting', ['ppdb' => 0], ['ppdb' => $ppdb]);
    send_response($exec);
}
if ($pg == 'ppdbon') {
    $data = [ 'ppdb' => 1 ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'ppdb1') {
    $data = [ 'ppdb' => isset($_POST['ppdb']) ? $_POST['ppdb'] : 0 ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}



if ($pg == 'ubahppdb') {
    $data = [ 'ppdb' => isset($_POST['ppdb']) ? $_POST['ppdb'] : 0 ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'live') {
    $data = [
        'klikchat' => isset($_POST['klikchat']) ? $_POST['klikchat'] : '',
        'livechat' => isset($_POST['livechat']) ? $_POST['livechat'] : '',
        'nolivechat' => isset($_POST['nolivechat']) ? $_POST['nolivechat'] : ''
    ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'ubah') {
    $data = [
        'nama_sekolah' => isset($_POST['nama_sekolah']) ? $_POST['nama_sekolah'] : '',
        'npsn' => isset($_POST['npsn']) ? $_POST['npsn'] : ''
    ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    if ($exec) {
        $ektensi = ['jpg', 'png'];
        $upload_success = true;
        foreach (['logo', 'kop', 'logo_ppdb'] as $filekey) {
            if (isset($_FILES[$filekey]) && $_FILES[$filekey]['name'] <> '') {
                $filename = $_FILES[$filekey]['name'];
                $temp = $_FILES[$filekey]['tmp_name'];
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                if (in_array($ext, $ektensi)) {
                    if ($filekey == 'kop') {
                        $dest_folder = 'assets/img/kop/';
                        $dest_name = 'kop' . rand(1, 1000) . '.' . $ext;
                    } else {
                        $dest_folder = 'assets/img/logo/';
                        $dest_name = $filekey . rand(1, 1000) . '.' . $ext;
                    }
                    $dest = $dest_folder . $dest_name;
                    $upload = move_uploaded_file($temp, '../../' . $dest);
                    if ($upload) {
                        // Simpan path relatif dari root web
                        $data2 = [ $filekey => $dest ];
                        $exec2 = update($koneksi, 'setting', $data2, $where);
                        if (!$exec2) $upload_success = false;
                    } else {
                        $upload_success = false;
                    }
                } else {
                    $upload_success = false;
                }
            }
        }
        send_response($upload_success);
    } else {
        echo "Gagal menyimpan";
    }
}
if ($pg == 'profile') {
    $nama = str_replace("'", "`", isset($_POST['nama']) ? $_POST['nama'] : '');
    $data = [
        'npsn' => isset($_POST['npsn']) ? $_POST['npsn'] : '',
        'nama_sekolah' => ucwords(strtoupper($nama)),
        'status' => isset($_POST['status']) ? $_POST['status'] : '',
        'integrasi_smp' => isset($_POST['integrasi_smp']) ? $_POST['integrasi_smp'] : '',
        'integrasi_sma' => isset($_POST['integrasi_sma']) ? $_POST['integrasi_sma'] : ''
    ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'alamat') {
    $data = [
        'alamat' => isset($_POST['alamat']) ? $_POST['alamat'] : '',
        'provinsi' => isset($_POST['provinsi']) ? $_POST['provinsi'] : '',
        'kab' => isset($_POST['kab']) ? $_POST['kab'] : '',
        'kec' => isset($_POST['kec']) ? $_POST['kec'] : ''
    ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'kontak') {
    $data = [
        'no_telp' => isset($_POST['no_telp']) ? $_POST['no_telp'] : '',
        'email' => isset($_POST['email']) ? $_POST['email'] : '',
        'web' => isset($_POST['web']) ? $_POST['web'] : ''
    ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'kepala') {
    $data = [
        'kepala' => isset($_POST['kepala']) ? $_POST['kepala'] : '',
        'nip' => isset($_POST['nip']) ? $_POST['nip'] : ''
    ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'ubah2') {
    $data = [
        'nama_sekolah' => isset($_POST['nama']) ? $_POST['nama'] : '',
        'alamat' => isset($_POST['alamat']) ? $_POST['alamat'] : '',
        'kota' => isset($_POST['kota']) ? $_POST['kota'] : '',
        'npsn' => isset($_POST['npsn']) ? $_POST['npsn'] : '',
        'integrasi_smp' => isset($_POST['integrasi_smp']) ? $_POST['integrasi_smp'] : '',
        'integrasi_sma' => isset($_POST['integrasi_sma']) ? $_POST['integrasi_sma'] : ''
    ];
    $where = [ 'id_setting' => 1 ];
    $exec = update($koneksi, 'setting', $data, $where);
    send_response($exec);
}
if ($pg == 'infobayar') {
    $data = [
        'infobayar' => $_POST['info']
    ];
    $where = [
        'id_setting' => 1
    ];
    $exec = update($koneksi, 'setting', $data, $where);

    if ($exec) {
        echo "ok";
    } else {
        echo "Gagal menyimpan";
    }
}
if ($pg == 'aktifppdb') {
    $data = [
        'tgl_pengumuman' => $_POST['tgl_pengumuman']
		
    ];
    $where = [
        'id_setting' => 1
    ];
    $exec = update($koneksi, 'setting', $data, $where);

    if ($exec) {
        echo "ok";
    } else {
        echo "Gagal menyimpan";
    }
}
