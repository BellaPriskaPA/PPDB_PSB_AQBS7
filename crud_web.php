<?php
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";
session_start();
// start output buffering to avoid accidental output breaking JSON responses
ob_start();

// determine requested action (pg) from GET or POST
$pg = '';
if (isset($_GET['pg'])) $pg = $_GET['pg'];
elseif (isset($_POST['pg'])) $pg = $_POST['pg'];

// helper to send clean JSON and terminate
function send_json($arr)
{
    if (ob_get_length()) ob_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr);
    exit();
}

if ($pg == 'simpan') {
    include_once 'securimage/securimage.php';
    $securimage = new Securimage();
    if ($securimage->check($_POST['kodepengaman']) == false) {
        $pesan = [
            'pesan' => 'KODE CAPTCHA SALAH'
        ];
    send_json($pesan);
    } else {
        
        $query = "SELECT max(no_daftar) as maxKode FROM daftar";
        $hasil = mysqli_query($koneksi, $query);
        $data  = mysqli_fetch_array($hasil);
        $kodedaftar = $data['maxKode'];
        $noUrut = (int) substr($kodedaftar, 8, 3);
        $noUrut++;
        $char = "PSB" . date('Y');
        $newID = $char . sprintf("%03s", $noUrut);
        $nama = mysqli_escape_string($koneksi, ucwords(strtolower($_POST['nama'])));
        $data = [
            'no_daftar' => $newID,
            'jenis' => $_POST['jenis'],
			'jurusan' => $_POST['jurusan'],
            'jalur' => $_POST['jalur'],
            'jenjang' => $_POST['jenjang'],
            'cabang_ranting' => (!empty($_POST['cabang_ranting']) ? $_POST['cabang_ranting'] : NULL),
            'nisn' => $_POST['nisn'],
            'nama' => $nama,
            'no_hp' => $_POST['nohp'],
            'tempat_lahir' => ucwords($_POST['tempat']),
            'tgl_lahir' => $_POST['tgllahir'],
            'password' => $_POST['password'],
			'tgl_daftar' => $_POST['tgl_daftar'],
            'foto' => 'default.png'
        ];
        $cek = rowcount($koneksi, 'daftar', ['nisn' => $_POST['nisn']]);
        if ($cek == 0) {
            $exec = insert($koneksi, 'daftar', $data);
            $namapendek = explode(" ", $nama);
            $pesan = [
                'pesan' => 'ok',
                'id' => $newID,
				'nisn' => $_POST['nisn'],
                'pass' => $_POST['password'],
                'nama' => $namapendek[0]
            ];
            send_json($pesan);
        } else {
            $pesan = [
                'pesan' => 'Nisn sudah terdaftar'
            ];
            send_json($pesan);
        }
    }
}
if ($pg == 'simpan2') {
    include_once 'securimage/securimage.php';
    $securimage = new Securimage();
    if ($securimage->check($_POST['kodepengaman']) == false) {
        $pesan = [
            'pesan' => 'KODE CAPTCHA SALAH'
        ];
    send_json($pesan);
    } else {
        
        $query = "SELECT max(no_daftar) as maxKode FROM daftar";
        $hasil = mysqli_query($koneksi, $query);
        $data  = mysqli_fetch_array($hasil);
        $kodedaftar = $data['maxKode'];
        $noUrut = (int) substr($kodedaftar, 8, 3);
        $noUrut++;
        $char = "PSB" . date('Y');
        $newID = $char . sprintf("%03s", $noUrut);
        $nama = mysqli_escape_string($koneksi, ucwords(strtolower($_POST['nama'])));
        $data = [
            'no_daftar' => $newID,
            'jurusan' => $_POST['jurusan'],
            'jenis' => $_POST['jenis'],
            'jalur' => $_POST['jalur'],
            'jenjang' => $_POST['jenjang'],
            'cabang_ranting' => (!empty($_POST['cabang_ranting']) ? $_POST['cabang_ranting'] : NULL),
            'nisn' => $_POST['nisn'],
            'nama' => $nama,
            'no_hp' => $_POST['nohp'],
            'tempat_lahir' => ucwords($_POST['tempat']),
            'tgl_lahir' => $_POST['tgllahir'],
            'password' => $_POST['password'],
            'foto' => 'default.png'
        ];
        $cek = rowcount($koneksi, 'daftar', ['nisn' => $_POST['nisn']]);
        if ($cek == 0) {
            $exec = insert($koneksi, 'daftar', $data);
            $namapendek = explode(" ", $nama);
            $pesan = [
                'pesan' => 'ok',
                'id' => $newID,
				'nisn' => $_POST['nisn'],
                'pass' => $_POST['password'],
                'nama' => $namapendek[0]
            ];
            send_json($pesan);
        } else {
            $pesan = [
                'pesan' => 'Nisn sudah terdaftar'
            ];
            send_json($pesan);
        }
    }
}
if ($pg == 'login') {
    $username = mysqli_escape_string($koneksi, $_POST['username']);
    $password = mysqli_escape_string($koneksi, $_POST['password']);
    $siswaQ = mysqli_query($koneksi, "SELECT * FROM daftar WHERE nisn='$username'");
    if ($username <> "" and $password <> "") {
        if (mysqli_num_rows($siswaQ) == 0) {
            $data = [
                'pesan' => 'Anda belum terdaftar silahkan Hubungi Operator Sekolah!'
            ];
            send_json($data);
        } else {
            $siswa = mysqli_fetch_array($siswaQ);
            //$ceklogin=mysqli_num_rows(mysqli_query($koneksi, "select * from login where id_siswa='$siswa[id_siswa]'"));

            if ($password <> $siswa['password']) {
                $data = [
                    'pesan' => 'Password Salah !'
                ];
                send_json($data);
            } else {
                //if($ceklogin==0){
                $_SESSION['id_daftar'] = $siswa['id_daftar'];
                // Correctly update online status for the logged in registrant
                mysqli_query($koneksi, "UPDATE daftar SET online='1' WHERE id_daftar='" . mysqli_real_escape_string($koneksi, $siswa['id_daftar']) . "'");
                $data = [
                    'pesan' => 'ok'
                ];
                send_json($data);
            }
        }
    }
    }
if ($pg == 'login2') {

    $username = mysqli_escape_string($koneksi, $_POST['username']);
    $password = mysqli_escape_string($koneksi, $_POST['password']);
    $siswaQ = mysqli_query($koneksi, "SELECT * FROM siswa WHERE no_siswa='$username'");
    if ($username <> "" and $password <> "") {
        if (mysqli_num_rows($siswaQ) == 0) {
            $data = [
                'pesan' => 'Anda belum terdaftar silahkan Hubungi Operator Sekolah!'
            ];
            send_json($data);
        } else {
            $siswa = mysqli_fetch_array($siswaQ);
            //$ceklogin=mysqli_num_rows(mysqli_query($koneksi, "select * from login where id_siswa='$siswa[id_siswa]'"));

            if ($password <> $siswa['password']) {
                $data = [
                    'pesan' => 'Password Salah !'
                ];
                send_json($data);
            } else {
                //if($ceklogin==0){
                $_SESSION['id_siswa'] = $siswa['id_siswa'];
                mysqli_query($koneksi, "UPDATE siswa set online='1' where id_siswa='$siswa[id_siswa]'");
                $data = [
                    'pesan' => 'ok'
                ];
                send_json($data);
            }
        }
    }
}
