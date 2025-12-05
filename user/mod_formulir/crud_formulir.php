<?php
require("../../config/database.php");
require("../../config/function.php");
require("../../config/functions.crud.php");
session_start();
$id = isset($_SESSION['id_daftar']) ? $_SESSION['id_daftar'] : 0;
if ($pg == 'konfirmasi') {
    $data = [
        'tgl_konfirmasi'              => $_POST['tgl_konfirmasi'],
		'konfirmasi'              => 1
    ];

     $exec = update($koneksi, 'daftar', $data, ['id_daftar' => $id]);
    if ($exec) {
        $pesan = [
            'pesan' => 'Selamat.... Data Anda Berhasil Di Konfirmasi'
        ];
        echo 'ok';
    } else {
        $pesan = [
            'pesan' => mysqli_error($koneksi)
        ];
        echo mysqli_error($koneksi);
    }
}
if ($pg == 'simpandatadiri') {
    if (empty($id)) {
        echo 'not_logged_in';
        exit;
    }
    // ensure additional columns exist (add if missing)
    function column_exists($koneksi, $table, $column){
        $q = mysqli_query($koneksi, "SHOW COLUMNS FROM `".$table."` LIKE '".mysqli_real_escape_string($koneksi,$column)."'");
        return mysqli_num_rows($q) > 0;
    }
    $cols_to_add = [
        'alergi' => "VARCHAR(20) DEFAULT ''",
        'alergi_detail' => "VARCHAR(255) DEFAULT ''",
        'penyakit' => "VARCHAR(20) DEFAULT ''",
        'penyakit_detail' => "VARCHAR(255) DEFAULT ''"
    ];
    foreach($cols_to_add as $col=>$def){
        if(!column_exists($koneksi,'daftar',$col)){
            @mysqli_query($koneksi, "ALTER TABLE `daftar` ADD `".mysqli_real_escape_string($koneksi,$col)."` " . $def);
        }
    }
    $status = (isset($_POST['status'])) ? 1 : 0;
    $data = [
        'asal_sekolah'     => $_POST['asal_sekolah'],
        'npsn_asal'        => $_POST['npsn_asal'],
        'jurusan'        => $_POST['jurusan'],
        'nisn'              => $_POST['nisn'],
        'nik'               => $_POST['nik'],
        'warga_siswa'       => !empty($_POST['warga_siswa_lain']) ? mysqli_escape_string($koneksi, $_POST['warga_siswa_lain']) : $_POST['warga_siswa'],
        'nama'              => mysqli_escape_string($koneksi, $_POST['nama']),
        'tempat_lahir'      => mysqli_escape_string($koneksi, $_POST['tempat']),
        'tgl_lahir'         => $_POST['tgllahir'],
        'jenkel'            => $_POST['jenkel'],
        'email'             => $_POST['email'],
        'no_hp'             => $_POST['nohp'],
        'anak_ke'           => $_POST['anakke'],
        'saudara'           => $_POST['saudara'],
        'biaya_sekolah'     => $_POST['biaya_sekolah'],
    'paud'              => isset($_POST['paud']) ? $_POST['paud'] : '',
    'tk'                => isset($_POST['tk']) ? $_POST['tk'] : '',
    'hepatitis'         => isset($_POST['hepatitis']) ? $_POST['hepatitis'] : '',
    'polio'             => isset($_POST['polio']) ? $_POST['polio'] : '',
    'bcg'               => isset($_POST['bcg']) ? $_POST['bcg'] : '',
    'campak'            => isset($_POST['campak']) ? $_POST['campak'] : '',
    'dpt'               => isset($_POST['dpt']) ? $_POST['dpt'] : '',
    'covid'             => isset($_POST['covid']) ? $_POST['covid'] : '',
        // prefer manual 'lain' fields when provided
        'citacita'          => !empty($_POST['citacita_lain']) ? mysqli_escape_string($koneksi, $_POST['citacita_lain']) : $_POST['citacita'],
            'hobi'              => !empty($_POST['hobi_lain']) ? mysqli_escape_string($koneksi, $_POST['hobi_lain']) : $_POST['hobi'],
            'agama'             => $_POST['agama'],
            'alergi'            => isset($_POST['alergi']) ? $_POST['alergi'] : 'Tidak',
            'alergi_detail'     => isset($_POST['alergi_detail']) ? mysqli_escape_string($koneksi, $_POST['alergi_detail']) : '',
            'penyakit'          => isset($_POST['penyakit']) ? $_POST['penyakit'] : 'Tidak',
            'penyakit_detail'   => isset($_POST['penyakit_detail']) ? mysqli_escape_string($koneksi, $_POST['penyakit_detail']) : '',
        'no_kk'             => $_POST['nokk'],
        'no_kip'            => $_POST['kip'],
        'kepala_keluarga'   => $_POST['kepala_keluarga']

    ];

     $exec = update($koneksi, 'daftar', $data, ['id_daftar' => $id]);
    if ($exec) {
        $pesan = [
            'pesan' => 'ok'
        ];
        echo 'ok';
    } else {
        $pesan = [
            'pesan' => mysqli_error($koneksi)
        ];
        echo mysqli_error($koneksi);
    }
}
if ($pg == 'simpanalamat') {
    if (empty($id)) {
        echo 'not_logged_in';
        exit;
    }

    $data = [
        'status_tinggal'    => $_POST['status_tinggal'],
        'alamat'            => mysqli_escape_string($koneksi, $_POST['alamat']),
        'rt'                => $_POST['rt'],
        'rw'                => $_POST['rw'],
        'desa'              => mysqli_escape_string($koneksi, $_POST['desa']),
        'kecamatan'         => mysqli_escape_string($koneksi, $_POST['kecamatan']),
        'kota'              => mysqli_escape_string($koneksi, $_POST['kota']),
        'provinsi'          => mysqli_escape_string($koneksi, $_POST['provinsi']),
        'kode_pos'          => $_POST['kodepos'],
        'koordinat'         => $_POST['koordinat'],
        'jarak'             => $_POST['jarak'],
        'waktu'             => $_POST['waktu'],
        'transportasi'      => $_POST['transportasi']

    ];

    $exec = update($koneksi, 'daftar', $data, ['id_daftar' => $id]);
    if ($exec) {
        $pesan = [
            'pesan' => 'ok'
        ];
        echo 'ok';
    } else {
        $pesan = [
            'pesan' => mysqli_error($koneksi)
        ];
        echo mysqli_error($koneksi);
    }
}
if ($pg == 'simpanortu') {
    if (empty($id)) {
        echo 'not_logged_in';
        exit;
    }

    $data = [
        'status_ayah'            => $_POST['status_ayah'],
		'nik_ayah'            => $_POST['nikayah'],
        'nama_ayah'           => mysqli_escape_string($koneksi, $_POST['namaayah']),
        'tahun_ayah'         => mysqli_escape_string($koneksi, $_POST['tahunayah']),
        'tempat_lahir_ayah'  => $_POST['tempatlahirayah'],
        'pendidikan_ayah'     => $_POST['pendidikan_ayah'],
        'pekerjaan_ayah'      => $_POST['pekerjaan_ayah'],
        'penghasilan_ayah'    => $_POST['penghasilan_ayah'],
        'no_hp_ayah'          => $_POST['nohpayah'],
        'status_ibu'            => $_POST['status_ibu'],
		'nik_ibu'             => $_POST['nikibu'],
        'nama_ibu'            => mysqli_escape_string($koneksi, $_POST['namaibu']),
        'tahun_ibu'          => mysqli_escape_string($koneksi, $_POST['tahunibu']),
        'tempat_lahir_ibu'  => $_POST['tempatlahiribu'],
        'pendidikan_ibu'      => $_POST['pendidikan_ibu'],
        'pekerjaan_ibu'       => $_POST['pekerjaan_ibu'],
        'penghasilan_ibu'     => $_POST['penghasilan_ibu'],
        'no_hp_ibu'           => $_POST['nohpibu'],
        'nik_wali'            => $_POST['nikwali'],
        'nama_wali'           => mysqli_escape_string($koneksi, $_POST['namawali']),
        'tahun_wali'         => mysqli_escape_string($koneksi, $_POST['tahunwali']),
        
        'pendidikan_wali'     => $_POST['pendidikan_wali'],
        'pekerjaan_wali'      => $_POST['pekerjaan_wali'],
        'penghasilan_wali'    => $_POST['penghasilan_wali'],
        'no_hp_wali'          => $_POST['nohpwali'],
    ];

   $exec = update($koneksi, 'daftar', $data, ['id_daftar' => $id]);
    if ($exec) {
        $pesan = [
            'pesan' => 'ok'
        ];
        echo 'ok';
    } else {
        $pesan = [
            'pesan' => mysqli_error($koneksi)
        ];
        echo mysqli_error($koneksi);
    }
}
