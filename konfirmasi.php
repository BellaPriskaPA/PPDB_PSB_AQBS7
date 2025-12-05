<?php
require "config/database.php";
require "config/function.php";
require "config/functions.crud.php";

$nisn = isset($_GET['nisn']) ? htmlspecialchars($_GET['nisn']) : '';
$pass = isset($_GET['pass']) ? htmlspecialchars($_GET['pass']) : '';
$nama = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : '';
$no = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PSB ONLINE | <?= isset($setting['nama_sekolah']) ? $setting['nama_sekolah'] : 'PSB' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="vendor/bootstrap-4/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/front.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <style>
        /* Cheerful rounded UI for confirmation page */
        :root{
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --primary: #0d9488; /* teal */
            --accent: #ff7b00;  /* warm orange */
            --muted: #475569;   /* slate-ish text */
            --success: #16a34a; /* green */
        }
        html,body{ height:100%; }
        body{ background: linear-gradient(180deg, #f0fbfa 0%, #ffffff 100%); font-family: 'Quicksand', system-ui, -apple-system, 'Segoe UI', Roboto, Arial; color:var(--muted); -webkit-font-smoothing:antialiased; }
        .confirm-card { max-width: 820px; margin: 28px auto 60px; border-radius: 14px; overflow: hidden; box-shadow: 0 18px 40px rgba(13,25,40,0.08); border:1px solid rgba(13,25,40,0.04); background:var(--card-bg); transform: translateZ(0); }
        .confirm-header { background: linear-gradient(90deg,var(--primary), #0ea5a4); color:#fff; padding:18px 20px; display:flex; gap:12px; align-items:center; justify-content:center; font-weight:800; letter-spacing:0.6px }
        .confirm-header .header-icon { background: rgba(255,255,255,0.12); padding:10px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; box-shadow: 0 6px 18px rgba(12,74,77,0.07); }
        /* Emoji sizing and accessibility */
        .emoji { display:inline-block; line-height:1; font-size:28px; }
        .confirm-header .emoji { font-size:30px; }
        .confirm-illustration .ill .emoji { font-size:48px; }
        @media (max-width:576px) { .confirm-header .emoji { font-size:20px } .confirm-illustration .ill .emoji { font-size:40px } }
        .confirm-body { background:var(--card-bg); color:var(--muted); padding:32px 38px; text-align:center; }
        .confirm-body h3 { color: #0b2b2a; font-weight:800; margin-bottom:8px; font-size:1.8rem; letter-spacing:0.2px }
        .confirm-illustration { margin: 10px 0 18px; }
        .confirm-illustration .ill { display:inline-flex; align-items:center; justify-content:center; width:110px; height:110px; border-radius:20px; background: linear-gradient(135deg, rgba(16,185,129,0.12), rgba(99,102,241,0.08)); box-shadow: 0 10px 30px rgba(16,185,129,0.06); }
        .confirm-illustration .ill i { color:var(--success); font-size:44px; }
        .confirm-body .info { color: rgba(11,43,43,0.82); margin-bottom:12px; font-size:1.05rem; font-weight:600 }
        .small-muted { color: rgba(11,43,43,0.65); font-size:1rem; margin:6px 0 }

        /* Buttons: rounded, shadow, subtle hover */
        .btn-orange { background:var(--accent); border-color:transparent; color:#fff; padding:12px 18px; font-weight:700; border-radius:999px; box-shadow: 0 8px 20px rgba(255,123,0,0.12); transition: transform .18s ease, box-shadow .18s ease; }
        .btn-orange:hover { transform: translateY(-3px); box-shadow: 0 18px 36px rgba(255,123,0,0.16); }
        .btn-ghost { background: transparent; border: 2px solid rgba(11,43,43,0.06); color:var(--muted); padding:10px 16px; border-radius:12px; }

        /* Button row: responsive */
        .btn-row { display:flex; flex-direction:column; gap:12px; align-items:stretch; }
        .btn-row .btn-flex { width:100%; }
        @media(min-width:768px){ .btn-row { flex-direction:row; } .btn-row .btn-flex { width:auto; flex:1 1 0; } .btn-row .btn-flex + .btn-flex { margin-left:12px; } }

        /* Micro-animations */
        @keyframes popIn { from { transform: scale(.96); opacity:0 } to { transform: scale(1); opacity:1 } }
        .pop-in { animation: popIn .42s cubic-bezier(.2,.9,.3,1) both }
        @keyframes floaty { 0% { transform: translateY(0) } 50% { transform: translateY(-6px) } 100% { transform: translateY(0) } }
        .floaty { animation: floaty 4s ease-in-out infinite; }

        /* Accessibility / small screens */
        @media (max-width:576px) { .confirm-card{ margin:12px 12px 30px } .confirm-body { padding:18px 16px } .confirm-illustration .ill { width:88px; height:88px } .confirm-body h3 { font-size:1.45rem } }
    </style>
</head>
<body>
    <div class="container">
        <div class="confirm-card card shadow-sm pop-in">
            <div class="confirm-header">
                <div class="header-icon" aria-hidden="true"><i class="fas fa-circle-check fa-lg" aria-hidden="true"></i></div>
                <h4 class="mb-0">SELAMAT PENDAFTARAN BERHASIL</h4>
            </div>
            <div class="confirm-body">
                <div class="confirm-illustration pop-in">
                    <div class="ill floaty"><span class="emoji" role="img" aria-label="partying face">🥳</span></div>
                </div>
                <h3>Hai!, <?= $nama ? $nama : 'Calon Peserta' ?></h3>
                <p class="small-muted">NO Pendaftaran : <strong><?= $no ?></strong></p>
                <p class="info">"AKUN ANDA BERHASIL DIBUAT"<br>
                silahkan login dengan menggunakan</p>
                <p class="small-muted">USERNAME : <strong><?= $nisn ?></strong></p>
                <p class="small-muted">PASSWORD : <strong><?= $pass ?></strong></p>
                <p class="small-muted">*MOHON DIINGAT JIKA PERLU SCREENSHOT</p>

                <div class="row mt-4">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="btn-row">
                            <a class="btn btn-orange btn-lg btn-flex" href="beranda.php?nisn=<?= urlencode($nisn) ?>&pass=<?= urlencode($pass) ?>&autologin=1">Lanjut Proses</a>
                            <a class="btn btn-orange btn-lg btn-flex" href="beranda.php">Lanjut Nanti</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-footer">
        <div class="container text-center">
            Copyright ©2025 AISYIYAH QUR'ANIC BOARDING SCHOOL
            <div style="left: -1988px; position: absolute; top: -1999px;"><a href="#">--</a></div>
        </div>
    </div>
</body>
</html>
