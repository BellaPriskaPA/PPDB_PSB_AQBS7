<?php
// Migration: add integrasi_smp and integrasi_sma, drop nsm and jenjang
require __DIR__ . '/../config/database.php';

$queries = [
    // add columns if not exists (MySQL doesn't support IF NOT EXISTS for ADD COLUMN
    // so check via information_schema
    "SELECT COUNT(*) AS cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'setting' AND COLUMN_NAME = 'integrasi_smp'",
    "SELECT COUNT(*) AS cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'setting' AND COLUMN_NAME = 'integrasi_sma'",
    // drop columns if exist
    "SELECT COUNT(*) AS cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'setting' AND COLUMN_NAME = 'nsm'",
    "SELECT COUNT(*) AS cnt FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'setting' AND COLUMN_NAME = 'jenjang'",
];

$results = [];
foreach ($queries as $q) {
    $r = mysqli_query($koneksi, $q);
    $row = mysqli_fetch_assoc($r);
    $results[] = $row['cnt'];
}

// results[0] -> integrasi_smp exists?
if ($results[0] == 0) {
    $sql = "ALTER TABLE setting ADD COLUMN integrasi_smp VARCHAR(255) DEFAULT ''";
    mysqli_query($koneksi, $sql);
    echo "Added column integrasi_smp\n";
} else {
    echo "Column integrasi_smp already exists\n";
}

if ($results[1] == 0) {
    $sql = "ALTER TABLE setting ADD COLUMN integrasi_sma VARCHAR(255) DEFAULT ''";
    mysqli_query($koneksi, $sql);
    echo "Added column integrasi_sma\n";
} else {
    echo "Column integrasi_sma already exists\n";
}

// drop nsm if exists
if ($results[2] > 0) {
    $sql = "ALTER TABLE setting DROP COLUMN nsm";
    mysqli_query($koneksi, $sql);
    echo "Dropped column nsm\n";
} else {
    echo "Column nsm does not exist\n";
}
// drop jenjang if exists
if ($results[3] > 0) {
    $sql = "ALTER TABLE setting DROP COLUMN jenjang";
    mysqli_query($koneksi, $sql);
    echo "Dropped column jenjang\n";
} else {
    echo "Column jenjang does not exist\n";
}

echo "Done\n";
