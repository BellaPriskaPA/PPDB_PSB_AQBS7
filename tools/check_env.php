<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/function.php';

echo 'koneksi_exists:' . (isset($koneksi) ? '1' : '0') . PHP_EOL;
echo 'koneksi_is_object:' . (is_object($koneksi) ? '1' : '0') . PHP_EOL;
echo 'setting_exists:' . (isset($setting) ? '1' : '0') . PHP_EOL;
echo 'nama_sekolah:' . (isset($setting['nama_sekolah']) ? $setting['nama_sekolah'] : '(null)') . PHP_EOL;
