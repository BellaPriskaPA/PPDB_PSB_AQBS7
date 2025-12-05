<?php
// Ensure DB and helper functions are loaded so $koneksi and $setting are available
if (!isset($koneksi)) {
    require_once __DIR__ . '/config/database.php';
}
if (!isset($setting) || !is_array($setting)) {
    // config/function.php reads $setting from DB; ensure functions are available
    require_once __DIR__ . '/config/function.php';
}
require_once __DIR__ . '/config/functions.crud.php';
// Ensure `jenjang` key exists to avoid undefined index notices when the column was removed
if (!isset($setting['jenjang'])) {
    $setting['jenjang'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
        <title>PSB ONLINE | <?= $setting['nama_sekolah'] ?></title>
        <!-- META DISKRIPSI-->
        <meta name="description" content="Mari bergabung Bersama Kami di <?= $setting['nama_sekolah'] ?>, Pendaftaran Santriwati Baru Tahun <?= date('Y') ?> Kembali dibuka ">
        <meta name="keywords" content="simasapp v.1.1,simas madrasah, simas sekolah, web simas,"/>

        <!-- Vendor -->
        <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
        
        <link href="https://unbk.kemdikbud.go.id/vendor/chart/Chart.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">
        
        <!-- <link href="https://unbk.kemdikbud.go.id/assets/css/front.min.css" rel="stylesheet" /> -->
        <link href="assets/css/front.min.css" rel="stylesheet" />
        <link href="assets/css/custom.css" rel="stylesheet" />
        <link rel="shortcut icon" href="<?= $setting['logo'] ?>" />
		
		 <link rel="stylesheet" href="assets/css/1.css">
		 <link rel="stylesheet" href="assets/css/2.css">
		 <link rel="stylesheet" href="assets/css/3.css">
        
		 <link rel="stylesheet" href="assets/css/components2.css">
		
		
		
      <link rel="stylesheet" href="assets/modules/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
	<!--WAKTU JALAN-->
    <style>
                /* Vertically center icons in input fields */
                .input-icon {
                    position: absolute;
                    left: 12px;
                    top: 0;
                    height: 100%;
                    display: flex;
                    align-items: center;
                    font-size: 20px;
                    color: #888;
                }
                .input-group-append .btn {
                    height: 100%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .input-group-append .fa-eye {
                    font-size: 20px;
                    color: #ff8000;
                    vertical-align: middle;
                }
        /* Professional form styling with enhanced dropdown/input UX */
        body { font-family: 'Poppins', sans-serif; }
        label { 
            font-weight: 700; 
            color: #111827; 
            font-size: 13px; 
            margin-bottom: 8px; 
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control { 
            font-size: 14px; 
            color: #222; 
            padding: 12px 14px; 
            border-radius: 6px; 
            border: 2px solid #e5e7eb;
            transition: all 0.2s ease;
            height: auto;
            min-height: 44px;
        }
        .form-control:focus {
            border-color: #1266f1;
            background-color: #f0f4ff;
            box-shadow: 0 0 0 3px rgba(18, 102, 241, 0.1);
        }
        .form-control::placeholder { 
            color: #9ca3af; 
            opacity: 1; 
        }
        .input-group .form-control { border-right:0; }
        .input-group-append .btn { border-radius:0 6px 6px 0; }
        .btn-lg { font-size:16px; font-weight:700; padding:12px 20px; border-radius:6px; }
        .card-header h4 { font-size:18px; font-weight:700; color:#fff; }
        .btn-orange { background:#1266f1; border-color:#0f53d1; color:#fff; font-weight:700; }
        .btn-orange:hover { background:#0f53d1; }
        /* Dropdown/Select styling */
        .select-wrap { 
            position: relative; 
            display: block;
        }
        .select-wrap select { 
            -webkit-appearance: none; 
            -moz-appearance: none; 
            appearance: none; 
            background: transparent; 
            width: 100%;
            cursor: pointer;
        }
        .select-wrap:after {
            content: '▼';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #1266f1;
            font-size: 12px;
            font-weight: bold;
        }
        .select-wrap select:focus { outline: none; }
        /* Select2 rendering overrides: match control height */
        .select2-container { display: block; margin-bottom: 8px; }
        .select2-container--default .select2-selection--single {
            min-height: 44px;
            border: 2px solid #e5e7eb;
            border-radius: 6px;
            padding: 6px 10px;
            box-sizing: border-box;
            transition: all 0.2s ease;
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #1266f1;
            box-shadow: 0 0 0 3px rgba(18, 102, 241, 0.1);
        }
        .select2-container .select2-selection--single .select2-selection__rendered {
            font-size: 14px;
            color: #222;
            line-height: 20px;
            padding: 8px 0;
            height: auto !important;
            margin: 0 !important;
            display: block;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 44px; 
            right: 8px; 
            top: 0; 
            display: flex; 
            align-items: center; 
            color: #1266f1;
        }
        /* Form groups and spacing */
        .form-group { margin-bottom: 16px; }
        .form-row .form-group:last-child { margin-bottom: 16px; }
        .form-row { margin-bottom: 0; }
        /* Card styling */
        .card { box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid #e5e7eb; }
        .card-body { padding: 24px; }
        .card-header { background-color: #f3f4f6; border-bottom: 2px solid #1266f1; }
        /* Input group styling */
        .input-group { display: flex; gap: 0; }
        .input-group .form-control { border-radius: 6px 0 0 6px; }
        .input-group-append { margin-left: -2px; }
        .input-group-append .btn { border-radius: 0 6px 6px 0; }
        /* Helper text and labels */
        small, .form-text { font-size: 12px; color: #6b7280; margin-top: 4px; }
        /* Password field specific */
        .password-field { line-height: 1.5; }
        /* Placeholder text consistency */
        ::placeholder { color: #9ca3af; opacity: 1; }
        /* Info Pendaftaran section styling */
        #persyaratan h5, #persyaratan h6 { font-family: 'Poppins', sans-serif; font-weight: 700; }
        #persyaratan h5 { font-size: 22px; color: #111827; margin-bottom: 8px; }
        #persyaratan h6 { font-size: 14px; color: #6b7280; margin-bottom: 24px; }
        #persyaratan .card-header { background-color: #1266f1; color: #fff; font-weight: 700; border: none; font-size: 15px; }
        #persyaratan .card-header.bg-secondary { background-color: #6b7280 !important; }
        #persyaratan .activity-icon { width: 50px; height: 50px; min-width: 50px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 18px; border-radius: 50%; background-color: #1266f1 !important; color: #fff; }
        #persyaratan .activity-detail p { font-size: 15px; color: #1f2937; line-height: 1.6; margin-bottom: 12px; font-weight: 500; }
        #persyaratan .activity-detail h5 { font-size: 16px; color: #111827; margin-bottom: 8px; font-weight: 700; }
        #persyaratan .text-job { font-size: 13px; color: #6b7280; }
        #persyaratan .btn { font-size: 14px; padding: 10px 14px; font-weight: 600; border-radius: 6px; display: inline-block; text-decoration: none; }
        #persyaratan .btn-primary { background-color: #1266f1; border-color: #0f53d1; color: #fff !important; }
        #persyaratan .btn-primary:hover { background-color: #0f53d1; color: #fff; }
        #persyaratan .btn-success { background-color: #10b981; border-color: #059669; color: #fff !important; }
        #persyaratan .btn-success:hover { background-color: #059669; color: #fff; }
        #persyaratan .activities { margin-bottom: 16px; }
        /* Responsive spacing for form and image columns */
        @media (max-width: 768px) {
            .col-sm-6[style*="padding-right"] {
                padding-right: 0 !important;
                margin-bottom: 30px;
            }
            .col-sm-6[style*="margin-top"] {
                margin-top: 60px !important;
                padding-left: 0 !important;
            }
        }
    </style>
	<link rel="stylesheet" type="text/css" href="assets/front/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/front/vendor/countdowntime/flipclock.css">
	<link rel="stylesheet" type="text/css" href="assets/front/css/main.css">
	<!--===============================================================================================-->
    
    
    <!-- Start GA -->
    
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-94034622-3');
    </script>
	 <?php
	$akhir  = new DateTime($setting['tgl_pengumuman']); //Waktu awal
	$awal = new DateTime(); // Waktu sekarang atau akhir
	$diff  = $awal->diff($akhir);

	?>
    </head>
    
    <body data-spy="scroll" data-target="#menu" data-offset="100">
        <div class="home-wrapper" id="home">
            <div class="home-header">
                <div class="container p-0">
                    <nav class="navbar navbar-expand-lg navbar-light" id="navbar-header">
                        <a class="navbar-brand" href="javascript:;">
                            <img src="<?= $setting['logo'] ?>" height="75" />
                            <div class="home-header-text d-none d-sm-block">
                                <h5>PENERIMAAN SANTRIWATI BARU</h5>
                                <h6><?= $setting['nama_sekolah'] ?></h6>
                                <h6>Tahun 2026</h6>
                            </div>
                            <span class="logo-mini-unbk d-block d-sm-none">PSB </span>
                            <span class="logo-mini-tahun d-block d-sm-none">_ONLINE</span>
                        </a>
                        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="menu">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#home" id="link-home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tentang" id="link-tentang">Daftar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#statistik" id="link-statistik">Statistik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#persyaratan" id="link-persyaratan">Info Pendaftaran</a>
                                </li>
								
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="./login" id="link-jadwal">Admin</a>
                                </li> -->
                                
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
 <?php if ($akhir <= $awal) { ?>		
            <div class="home-banner">
                <div class="home-banner-bg home-banner-bg-color" ></div>
                <div class="container mt-5">
                    <div class="row">
                        
						<div class="col-sm-8">
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel" data-slide-to="1"></li>
                                    <li data-target="#carousel" data-slide-to="2"></li>
                                   
                                    
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div>
                                            <h5 data-animation="animated fadeInDownBig">
                                                Selamat Datang Di web PSB Online
                                            </h5>
                                            <br />
                                            <p data-animation="animated slideInRight" data-delay="1s">
                                                Aplikasi Penerimaan Santriwati Baru Tahun Pelajaran 2025/2026 AISYIYAH QUR'ANIC BOARDING SCHOOL.
                                            </p>
                                            <p data-animation="animated slideInRight" data-delay="2s">
                                                Pendaftaran Santriwati Baru Tahun 2025 ini telah dibuka. Silahkan Segera Daftar dan lengkapi Formulir
                                            </p>
                                            <p data-animation="animated flipInX" data-delay="3s">
                                                <a href="#tentang" class="btn nav-link btn-orange">
                                                    Lihat Alur Pendaftaran
                                                    <span class="fa fa-chevron-down"></span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div>
                                            <h5 data-animation="animated fadeInDownBig">
                                                Syarat Pendaftaran Santriwati Baru
                                            </h5>
                                            <h5 data-animation="animated fadeInDownBig">
                                                Tahun Pelajaran 2025/2026
                                            </h5>
                                            <ul>
                                                <li data-animation="animated fadeInDownBig" data-delay="1s">
                                                    Surat Keterangan Lulus
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="2s">
                                                    Ijazah Jenjang Sebelumnya
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="3s">
                                                    Kartu Keluarga
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="4s">
                                                    Akta Kelahiran
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="5s">
                                                    Scan Raport
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div>
                                            <h5 data-animation="animated fadeInDownBig">
                                                Alur Pendaftaran Santriwati Baru
                                            </h5>
                                            <h5 data-animation="animated fadeInDownBig">
                                                Tahun Pelajaran 2025/2026
                                            </h5>
                                            <ul>
                                                <li data-animation="animated fadeInDownBig" data-delay="1s">
                                                    Daftar Akun
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="2s">
                                                    Lengkapi Formulir
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="3s">
                                                    Upload Berkas
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="4s">
                                                    Pembayaran
                                                </li>
                                                <li data-animation="animated flipInX" data-delay="5s">
                                                    Download Berkas
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                   
                                    
                                    
                                </div>
                            </div>
							
                        </div>
                        <div class="col-sm-4">
						
                            <div class="card card-login" style="background-color: #9CDCFD !important;">
							
                                <div class="card-body">
								<img src="<?= $setting['logo_ppdb'] ?>" alt=""  width="85%">
									<br>
                                   <form id="form-login">
                                        <div class="form-group">
                                            <span class="fa fa-user" style="position:absolute; left:12px; top:70%; transform:translateY(-50%); font-size:20px; color:#888;"></span>
                                           <input type="text" onkeyup="this.value = this.value.toUpperCase()" class="form-control" name="username" placeholder="Masukkan NISN" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <span class="fa fa-key"></span>
                                           <div class="input-group">
                                               <input type="password" class="form-control password-field" name="password" placeholder="Password">
                                               <div class="input-group-append">
                                                   <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1" style="height:100%; display:flex; align-items:center; justify-content:center;"><i class="fa fa-eye" style="font-size:20px; color:#ff8000; vertical-align:middle; position:relative; top:14px;"></i></button>
                                               </div>
                                           </div>
                                        </div>
                                       
                                        <button type="submit" class="btn btn-orange btn-block btn-login" id="btnsimpan">
                                            Masuk
                                        </button>
										 
										  
                                    </form>
									<br>
                                    <a href="#tentang" class="btn btn-primary btn-block btn-login">
                                                    Daftar Disini</a>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-content">
                <section id="tentang">
                    <div class="container">
                        
                        <div class="row">
                            
                            <div class="col-sm-6 d-flex align-items-center">
							<div class="col-md-12 animated bounceInLeft">
								<?php if ($setting['jenjang'] == 1) { ?>
								<div class="card">
									<div class="card-header bg-info">
										<h4>Formulir Pendaftaran</h4>
									</div>
									<form id="form-daftar">
										<div class="card-body">
											<input type="date" name="tgl_daftar" class="form-control datepicker" value="<?= $daftar['tgl_daftar'] ?>" hidden>
											<!-- Row 1: Jalur Jenjang -->
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="jalur">JALUR JENJANG</label>
													<div class="select-wrap">
														<select class="form-control" name="jalur" id="jalur" required>
															<option value="">-- Pilih Jalur --</option>
															<option value="pribadi">Pribadi</option>
															<option value="kader">Kader</option>
															<option value="rekomendasi">Rekomendasi Cabang/Ranting</option>
														</select>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label for="jenjang">JENJANG</label>
													<div class="select-wrap">
														<select class="form-control" name="jenjang" id="jenjang" required>
															<option value="">-- Pilih Jenjang --</option>
															<option value="SMP">SMP</option>
															<option value="SMA">SMA</option>
														</select>
													</div>
												</div>
											</div>
											<!-- Conditional Cabang/Ranting -->
											<div class="form-group" id="cabang-container" style="display:none;">
												<label for="cabang_ranting">Nama Cabang/Ranting</label>
												<input type="text" class="form-control" name="cabang_ranting" id="cabang_ranting" placeholder="Masukkan nama cabang atau ranting">
											</div>
											<!-- Row 2: Jenis Pendaftaran & NISN -->
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="jenis">JENIS PENDAFTARAN</label>
													<div class="select-wrap">
														<select class="form-control" name="jenis" id="jenis" required>
															<option value="">-- Pilih Jenis --</option>
															<option value="1">Siswa Baru</option>
															<option value="2">Pindahan</option>
														</select>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label for="nisn">NISN <small>(sebagai Username Anda)</small></label>
													<input type="number" maxlength="10" class="form-control" name="nisn" placeholder="Masukkan NISN 10 digit" autocomplete="off" required>
												</div>
											</div>
											<!-- Row 3: Nama Lengkap -->
											<div class="form-group">
												<label for="nama">NAMA LENGKAP</label>
												<input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap sesuai ijazah" autocomplete="off" required>
											</div>
											<!-- Row 4: No Handphone (full width) -->
											<div class="form-group">
												<label for="nohp">NO HANDPHONE</label>
												<div class="input-group">
													<input type="text" value="+62" disabled class="form-control" style="max-width: 60px;">
													<input type="number" class="form-control" name="nohp" placeholder="Nomor HP WhatsApp" required>
												</div>
											</div>
											<!-- Row 5: Tempat & Tanggal Lahir -->
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="tempat">TEMPAT LAHIR</label>
													<input type="text" class="form-control" name="tempat" placeholder="Kota/Kabupaten lahir" required>
												</div>
												<div class="form-group col-md-6">
													<label for="tgllahir">TANGGAL LAHIR</label>
													<input type="date" class="form-control datepicker" name="tgllahir" required>
												</div>
											</div>
											<!-- Row 6: Password -->
											<div class="form-group">
												<label class="d-block">PASSWORD <small>(Mohon Diingat!)</small></label>
												<div class="input-group">
													<input type="password" class="form-control password-field" name="password" placeholder="Buat password minimal 8 karakter" minlength="8" required>
													<div class="input-group-append">
														<button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1"><i class="fa fa-eye"></i></button>
													</div>
												</div>
											</div>
											<!-- Row 7: CAPTCHA -->
											<div class="form-group">
												<label>KODE VERIFIKASI</label>
												<div class="row">
													<div class="col-md-6">
														<div style="padding: 8px; border: 2px solid #e5e7eb; border-radius: 6px; background: #f9fafb; text-align: center;">
															<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" style="height: 60px; display: block; margin: 0 auto;">
															<a href="#" class="btn btn-sm btn-link mt-2" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?t=' + Math.random(); return false;">↻ Refresh Kode</a>
														</div>
													</div>
													<div class="col-md-6">
														<input class="form-control" type="text" name="kodepengaman" placeholder="Masukkan kode dari gambar" required>
													</div>
												</div>
											</div>
										</div>
										<div class="card-footer text-right" style="background-color: #f9fafb; border-top: 1px solid #e5e7eb; padding: 16px 24px;">
											<button id='btnsimpan' type="submit" class="btn btn-orange btn-lg">DAFTAR SEKARANG</button>
										</div>
									</form>
								</div>
								<?php } else { ?>
								<div class="card">
									<div class="card-header bg-info">
										<h4>Formulir Pendaftaran</h4>
									</div>
									<form id="form-daftar2">
										<div class="card-body" style="background-color: #9CDCFD;">
											<input type="date" name="tgl_daftar" class="form-control datepicker" value="<?= $daftar['tgl_daftar'] ?>" hidden>
											<!-- Row 1: Jalur Jenjang -->
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="jalur">JALUR JENJANG</label>
													<div class="select-wrap">
														<select class="form-control" name="jalur" id="jalur2" required>
															<option value="">-- Pilih Jalur --</option>
															<option value="pribadi">Pribadi</option>
															<option value="kader">Kader</option>
															<option value="rekomendasi">Rekomendasi Cabang/Ranting</option>
														</select>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label for="jenjang">JENJANG</label>
													<div class="select-wrap">
														<select class="form-control" name="jenjang" id="jenjang2" required>
															<option value="">-- Pilih Jenjang --</option>
															<option value="SMP">SMP</option>
															<option value="SMA">SMA</option>
														</select>
													</div>
												</div>
											</div>
											<!-- Conditional Cabang/Ranting -->
											<div class="form-group" id="cabang-container2" style="display:none;">
												<label for="cabang_ranting">Nama Cabang/Ranting</label>
												<input type="text" class="form-control" name="cabang_ranting" id="cabang_ranting2" placeholder="Masukkan nama cabang atau ranting">
											</div>
											<!-- Row 2: Jenis Pendaftaran & NISN -->
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="jenis">JENIS PENDAFTARAN</label>
													<div class="select-wrap">
														<select class="form-control" name="jenis" id="jenis2" required>
															<option value="">-- Pilih Jenis --</option>
															<option value="1">Siswa Baru</option>
															<option value="2">Pindahan</option>
														</select>
													</div>
												</div>
												<div class="form-group col-md-6">
													<label for="nisn">NISN <small>(sebagai Username Anda)</small></label>
													<input type="number" maxlength="10" class="form-control" name="nisn" placeholder="Masukkan NISN 10 digit" autocomplete="off" required>
												</div>
											</div>
											<!-- Row 3: Nama Lengkap -->
											<div class="form-group">
												<label for="nama">NAMA LENGKAP</label>
												<input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap sesuai ijazah" autocomplete="off" required>
											</div>
											<!-- Row 4: No Handphone (full width) -->
											<div class="form-group">
												<label for="nohp">NO HANDPHONE</label>
												<div class="input-group">
													<input type="text" value="+62" disabled class="form-control" style="max-width: 60px;">
													<input type="number" class="form-control" name="nohp" placeholder="Nomor HP WhatsApp" required>
												</div>
											</div>
											<!-- Row 5: Tempat & Tanggal Lahir -->
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="tempat">TEMPAT LAHIR</label>
													<input type="text" class="form-control" name="tempat" placeholder="Kota/Kabupaten lahir" required>
												</div>
												<div class="form-group col-md-6">
													<label for="tgllahir">TANGGAL LAHIR</label>
													<input type="date" class="form-control datepicker" name="tgllahir" required>
												</div>
											</div>
											<!-- Row 6: Password -->
											<div class="form-group">
												<label class="d-block">PASSWORD <small>(Mohon Diingat!)</small></label>
												<div class="input-group">
													<input type="password" class="form-control password-field" name="password" placeholder="Buat password minimal 8 karakter" minlength="8" required>
													<div class="input-group-append">
														<button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1"><i class="fa fa-eye"></i></button>
													</div>
												</div>
											</div>
											<!-- Row 7: CAPTCHA -->
											<div class="form-group">
												<label>KODE VERIFIKASI</label>
												<div class="row">
													<div class="col-md-6">
														<div style="padding: 8px; border: 2px solid #e5e7eb; border-radius: 6px; background: #f9fafb; text-align: center;">
															<img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" style="height: 60px; display: block; margin: 0 auto;">
															<a href="#" class="btn btn-sm btn-link mt-2" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?t=' + Math.random(); return false;">↻ Refresh Kode</a>
														</div>
													</div>
													<div class="col-md-6">
														<input class="form-control" type="text" name="kodepengaman" placeholder="Masukkan kode dari gambar" required>
													</div>
												</div>
											</div>
										</div>
										<div class="card-footer text-right" style="background-color: #f9fafb; border-top: 1px solid #e5e7eb; padding: 16px 24px;">
											<button id='btnsimpan' type="submit" class="btn btn-orange btn-lg">SIMPAN DATA</button>
										</div>
									</form>
								</div>
								<?php } ?>
							</div>
                            </div>
							<div class="col-sm-6">
							
                               <p align="center">
                                    <img src="assets/alurppdb.png" align="center" width="600" style="max-width: 100%" />
                                </p>
										
                            </div>
                        </div>
                    </div>
                </section>
								<?php } ?>
 <?php if ($awal <= $akhir) { ?>

				<div class="home-banner">
                <div class="home-banner-bg home-banner-bg-color"></div>
                <!-- <div class="home-banner-bg home-banner-img-bg"></div> -->
                <div class="container mt-5">
                    <div class="row">
                        
						<div class="col-sm-8">
						
						
                                    <div class="carousel-item active">
                                        <div>
                                            <h5 data-animation="animated fadeInDownBig">
                                                Selamat Datang Di web PSB Online
                                            </h5>
                                            <br />
                                            <p data-animation="animated slideInRight" data-delay="1s">
                                                Aplikasi Penerimaan Santri Baru Tahun Pelajaran 2025/2026 AISYIYAH QUR'ANIC BOARDING SCHOOL.
                                            </p>
                                            <p data-animation="animated slideInRight" data-delay="2s">
                                                Pendaftaran Santriwati Baru Tahun 2025 ini Belum Dibuka.
                                            </p>
                                            <p data-animation="animated flipInX" data-delay="3s">
                                                <a href="" class="btn btn-success nav-link">
                                                    Pendaftaran Dibuka Dalam
                                                    <span class="fa fa-chevron-down"></span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
							<center><div class="cd100"></div></center>
						
                        </div>
                        <div class="col-sm-4">
                            <div class="card card-login bg-info">
                                <div class="card-body">
                                    <div class="avatar bg-info" align="center">
										<img src="<?= $setting['logo_ppdb'] ?>" alt="" height="70%" width="70%">
									</div>
									<br>
                                   <form id="form-login">
                                        <div class="form-group">
                                            <span class="fa fa-user"></span>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase()" class="form-control" name="username" placeholder="Masukkan NISN" required autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <span class="fa fa-key"></span>
                                           <div class="input-group">
                                               <input type="password" class="form-control password-field" name="password" placeholder="Password">
                                               <div class="input-group-append">
                                                   <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1"><i class="fa fa-eye"></i></button>
                                               </div>
                                           </div>
                                        </div>
                                       
                                        <button type="submit" class="btn btn-primary btn-block btn-login" id="btnsimpan">
                                            Masuk
                                        </button>
										 
										  
                                    </form>
									<br>
                                    <a href="#tentang" class="btn btn-primary btn-block btn-login">
                                                    Daftar Disini</a>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-content">
                <section id="tentang">
                    <div class="container">
                        
                        <div class="row">
                            
                            <div class="col-sm-6 d-flex align-items-center" style="padding-right: 15px;">
							<div class="col-md-12 ">
								<div class="card">
									<div class="card-header bg-info">
										<h4>Formulir Pendaftaran</h4>
									</div>
									<form id="form-daftar">
										<div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="jenis">JENIS PENDAFTARAN</label>
                                                    <select class="form-control" name="jenis" id="jenis">
                                                        <option value="1">Siswa Baru</option>
                                                        <option value="2">Pindahan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="jenjang">JENJANG</label>
                                                    <select class="form-control" name="jenjang" id="jenjang">
                                                        <option value="SMP">SMP</option>
                                                        <option value="SMA">SMA</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="jalur">JALUR</label>
                                                    <select class="form-control" name="jalur" id="jalur">
                                                        <option value="mandiri">Mandiri</option>
                                                        <option value="rekomendasi">Rekomendasi Cabang/Ranting</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row" id="cabang-container" style="display:none;">
                                                <div class="form-group col-md-12">
                                                    <label for="cabang_ranting">Nama Cabang/Ranting</label>
                                                    <input type="text" class="form-control" name="cabang_ranting" id="cabang_ranting" placeholder="Masukkan nama cabang/ranting">
                                                </div>
                                            </div>

											<div class="form-row">
											<div class="form-group col-md-6">
												<label for="nama">NAMA LENGKAP*</label>
                                                   <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" autocomplete="off">
											</div>
											<div class="form-group col-md-6">
  <label for="nohp">NO HANDPHONE</label>
  <div class="row">
    <div class="col-2">
    <input type="text" value="+62" disabled tabindex="-1" style="width:55px; font-size:17px; font-weight:bold; text-align:center; background:transparent; color:#1266f1; border:none; box-shadow:none; margin-right:8px; margin-top:2px; padding:0; height:44px; display:inline-block; vertical-align:middle;">
    </div>
    <div class="col-10">
    <input type="number" class="form-control" name="nohp" placeholder="No HP Whatsapp" required>
    </div>
  </div>
</div>

											</div>
											
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="tempat">TEMPAT LAHIR</label>
                                                       <input type="text" class="form-control" name="tempat">
												</div>
												<div class="form-group col-md-6">
													<label for="tgllahir">TANGGAL LAHIR</label>
                                                       <input type="date" class="form-control datepicker" name="tgllahir">
												</div>

											</div>
                                            <div class="form-group">
                                                <label class="d-block">PASSWORD (Mohon Diingat!)</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control password-field" name="password" placeholder="Password">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary toggle-password" type="button" tabindex="-1"><i class="fa fa-eye"></i></button>
                                                    </div>
                                                </div>
                                            </div>
											<div class="form-row">
											<div class="form-group col-md-6">
											<a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?t=' + Math.random(); return false">Refresh Kode</a>

											<img class="p-b-5" id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" style="height:70px" /><br>
											 </div>
												<div class="form-group col-md-6">
                                                       <input class="form-control" type="text" name="kodepengaman" placeholder="masukan kode">
												</div>
										   
											 </div>
										</div>
										<div class="card-footer">
											<button id='btnsimpan' type="submit" class="btn btn-lg btn-primary">SIMPAN DATA</button>
										</div>
									</form>
								</div>
							</div>
                            </div>
							<div class="col-sm-6" style="margin-top: 30px; padding-left: 15px;">
                            <p align="center">
                                <img src="assets/alurppdb.png" align="center" width="600" style="max-width: 90%" />
                            </p>
                            </div>
                        </div>
                    </div>
                </section>
<?php } ?>

                <section class="bg-light statistik" id="persyaratan">
                    <div class="container">
                        <h5 class="text-center">Info Pendaftaran</h5>
                        <h6 class="text-center">Santriwati Baru <?= $setting['nama_sekolah'] ?> Tahun 2026</h6>
                        <div class="row mt-12">
                            <div class="col-sm-6">
                                <div class="card mt-2">
                                    <div class="card-header">Cara Daftar</div>
                                    <div class="card-body">
										<div class="col-12 animated bounceIn">
											<div class="activities">
												<div class="activity">
													<div class="activity-icon">1</div>
													<div class="activity-detail">
														<p>Calon Santriwati mendaftar di web pendaftaran.</p>
														<a href="#tentang" class="btn btn-primary">Klik Disini</a>
													</div>
												</div>
											</div>
											<div class="activities">
												<div class="activity">
													<div class="activity-icon">2</div>
													<div class="activity-detail">
														<p>Jika selesai pendaftaran silahkan login dengan username dan password saat pendaftaran</p>
														<a href="#tentang" class="btn btn-success">Daftar Disini</a>
													</div>
												</div>
											</div>
											<div class="activities">
												<div class="activity">
													<div class="activity-icon">3</div>
													<div class="activity-detail">
														<p>Lengkapi Formulir yang diberikan dengan data yang benar.</p>
													</div>
												</div>
											</div>
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card mt-2">
                                    <div class="card-header bg-secondary">Pengumuman</div>
                                    <div class="card-body">
                                      <div class="row">
										<div class="col-12 animated bounceIn">
											<div class="activities">
												<?php $query = mysqli_query($koneksi, "SELECT * FROM pengumuman where jenis='2'");
												while ($data = mysqli_fetch_array($query)) {
												?>
													<div class="activity">
														<div class="activity-icon bg-primary text-white shadow-primary">
															<i class="fas fa-bullhorn"></i>
														</div>
														<div class="activity-detail">
															<div class="mb-2">
																<span class="text-job"><?= $data['tgl'] ?></span>
																<span class="bullet"></span>
																<a class="text-job" href="#">View</a>
															</div>
															<h5><?= $data['judul'] ?></h5>
															<p><?= $data['pengumuman'] ?></p>
														</div>
													</div>
												<?php } ?>
											</div>
										</div>
									</div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
				
                <section class="bg-light statistik" id="statistik">
                    <div class="container">
                        <h5 class="text-center mb-1">Data Pendaftar</h5>
                        <h6 class="text-center mb-4">Santriwati Baru <?= $setting['nama_sekolah'] ?> Tahun 2026</h6>
                        <div class="row mb-4">
                            <!-- Stat Widget Jenjang -->
                            <?php
                            // Query jenjang SMA & SMP
                            $sma = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM daftar WHERE jenjang='SMA'");
                            $smp = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM daftar WHERE jenjang='SMP'");
                            $sma_total = ($sma && mysqli_num_rows($sma)) ? mysqli_fetch_assoc($sma)['total'] : 0;
                            $smp_total = ($smp && mysqli_num_rows($smp)) ? mysqli_fetch_assoc($smp)['total'] : 0;
                            // Total pendaftar dan quota
                            $total_pendaftar = rowcount($koneksi, 'daftar');
                            $kuota_query = mysqli_query($koneksi, "SELECT SUM(kuota) AS kuota FROM jurusan");
                            $kuota = ($kuota_query && mysqli_num_rows($kuota_query)) ? mysqli_fetch_assoc($kuota_query)['kuota'] : 0;
                            $percent = ($kuota > 0) ? round($total_pendaftar / $kuota * 100) : 0;
                            ?>
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3" style="background: #f8fafc;">
                                    <div class="card-header bg-white border-0 mb-3">
                                        <h5 class="mb-0 text-primary">Statistik Berdasarkan Jenjang</h5>
                                    </div>
                                    <div class="d-flex justify-content-between gap-3">
                                        <!-- SMA Info Box -->
                                        <div class="flex-fill info-box d-flex align-items-center p-3 rounded" style="background: #e3f2fd;">
                                            <div class="mr-3">
                                                <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-dark" style="font-size: 1.1rem;">SMA</div>
                                                <div class="display-4 font-weight-bold text-success"><?= $sma_total ?></div>
                                            </div>
                                        </div>
                                        <!-- SMP Info Box -->
                                        <div class="flex-fill info-box d-flex align-items-center p-3 rounded" style="background: #e8f5e9;">
                                            <div class="mr-3">
                                                <i class="fas fa-book-reader fa-2x text-success"></i>
                                            </div>
                                            <div>
                                                <div class="font-weight-bold text-dark" style="font-size: 1.1rem;">SMP</div>
                                                <div class="display-4 font-weight-bold text-success"><?= $smp_total ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Stat Widget Total Pendaftar & Quota -->
                            <div class="col-md-6">
                                <div class="card shadow-sm p-3" style="background: #f8fafc;">
                                    <div class="card-header bg-white border-0 mb-3">
                                        <h5 class="mb-0 text-success">Total Pendaftar & Kuota</h5>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-users fa-2x text-info mr-3"></i>
                                        <div>
                                            <span class="font-weight-bold text-info" style="font-size: 1.2rem;"><?= $total_pendaftar ?></span>
                                            <span class="text-muted ml-2">dari</span>
                                            <span class="font-weight-bold text-warning" style="font-size: 1.2rem;"><?= $kuota ?></span>
                                            <span class="text-muted ml-2">Kuota</span>
                                        </div>
                                    </div>
                                    <div class="progress" style="height: 30px; background: #e0e7ef;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?= $percent ?>%;" aria-valuenow="<?= $total_pendaftar ?>" aria-valuemin="0" aria-valuemax="<?= $kuota ?>">
                                            <span class="font-weight-bold text-white"><?= $percent ?>%</span>
                                        </div>
                                    </div>
                                    <small class="text-muted mt-2 d-block">Pendaftar saat ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                            <script>
                            // Auto-login support: if konfirmasi.php redirected with autologin=1, prefill and submit login
                            (function(){
                                try {
                                    var params = new URLSearchParams(window.location.search);
                                    if (params.get('autologin') === '1') {
                                        var nisn = params.get('nisn');
                                        var pass = params.get('pass');
                                        if (nisn && pass) {
                                            // find visible login form; fallback to first form-login
                                            var form = document.querySelector('form#form-login');
                                            if (form) {
                                                var userInput = form.querySelector('input[name="username"]');
                                                var passInput = form.querySelector('input[name="password"]');
                                                if (userInput && passInput) {
                                                    userInput.value = nisn;
                                                    passInput.value = pass;
                                                    // submit the form (it uses AJAX)
                                                    $(form).submit();
                                                }
                                            }
                                        }
                                    }
                                } catch (e) {
                                    console.error('autologin error', e);
                                }
                            })();
                            </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



				
				
				
            </div>
			
			
			
            
        </div>
        <script>
            var baseURL = '/';
            var uniqueID = 'd8ac8098665d68759eeda768373bb6c2';
            var chartData = JSON.parse('[{"title":"SMK","data":[91.61,7.81,0.58]},{"title":"MA","data":[88.33,11.07,0.6]},{"title":"SMA","data":[89.69,8.33,1.98]},{"title":"SMP","data":[59.15,24.1,16.75]},{"title":"MTs","data":[79.46,19.25,1.29]},{"title":"Nasional","data":[74.84,17.31,7.85]}]');
            var chartLabel = JSON.parse('["Mandiri","Sekolah Lain","UNKP"]');
        </script>
		
        <!-- Vendor -->
        <script src="https://unbk.kemdikbud.go.id/vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="https://unbk.kemdikbud.go.id/vendor/jquery/jquery.form.min.js"></script>
        <script src="https://unbk.kemdikbud.go.id/vendor/bootstrap-4/js/bootstrap.min.js"></script>
        <script src="https://unbk.kemdikbud.go.id/vendor/bootstrap-4/js/popper.min.js"></script>
        <script src="https://unbk.kemdikbud.go.id/vendor/wow/js/wow.min.js"></script>
        <script src="https://unbk.kemdikbud.go.id/vendor/chart/Chart.min.js"></script>
           
        <!-- Assets -->
        <script src="https://unbk.kemdikbud.go.id/assets/js/front.min.js"></script>
        <!-- Assets -->
       
		    <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
		<script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
		
		 <script src="assets/modules/popper.js"></script>
    <script src="assets/modules/tooltip.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/modules/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>
    <!-- JS Libraies -->
    <script src="assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
    <!-- Page Specific JS File -->
    <!-- JS DATATABLE -->
    <script src="assets/modules/datatables/datatables.min.js"></script>
    <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    </body>
</html>
<script type="text/javascript">
        $('.loader').fadeOut('slow');
        $(document).ready(function() {
            $('.klikmenu').click(function() {
                var menu = $(this).data('id');
                if (menu == "beranda") {
                    $('#btndaftar').show();
                    $('#isi_load').load('home.php');
                } else if (menu == "pendaftaran") {
                    $('#btndaftar').hide();
                    $('#isi_load').load('pendaftaran.php');
                } else if (menu == "daftar") {
                    $('#isi_load').load('datadaftar.php');
				} else if (menu == "siswa") {
                    $('#isi_load').load('siswa.php');
                } else if (menu == "pengumuman") {
                    $('#isi_load').load('pengumuman.php');
                } else if (menu == "login") {
                    $('#isi_load').load('login.php');
                }
            });
            // halaman yang di load default pertama kali
            $('#isi_load').load('home.php');
        });
    </script>
<script>
        // Show/hide cabang/ranting input based on jalur selection
        $('#jalur').on('change', function() {
            if ($(this).val() === 'rekomendasi') {
                $('#cabang-container').show();
            } else {
                $('#cabang-container').hide();
                $('#cabang_ranting').val('');
            }
        });
    $('#form-login').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'crud_web.php?pg=login',
            data: $(this).serialize(),
            beforeSend: function() {
                $('#btnsimpan').prop('disabled', true);
            },
            success: function(data) {
                var json;
                try {
                    json = (typeof data === 'object') ? data : $.parseJSON(data);
                } catch (e) {
                    console.error('Invalid JSON response for login:', data);
                    iziToast.error({
                        title: 'Error',
                        message: 'Server error. Periksa console untuk detail.',
                        position: 'topCenter'
                    });
                    $('#btnsimpan').prop('disabled', false);
                    return;
                }
                $('#btnsimpan').prop('disabled', false);
                if (json.pesan == 'ok') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Login Berhasil',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.href = "user";
                    }, 2000);

                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: json.pesan,
                        position: 'topCenter'
                    });
                }
                //$('#bodyreset').load(location.href + ' #bodyreset');
            }
        });
        return false;
    });
    if (jQuery().daterangepicker) {
        if ($(".datepicker").length) {
            $('.datepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
            });
        }
        if ($(".datetimepicker").length) {
            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD hh:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }
        if ($(".daterange").length) {
            $('.daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                drops: 'down',
                opens: 'right'
            });
        }
    }
    if (jQuery().select2) {
        $(".select2").select2();
    }
</script>
<script>
    $('#form-daftar').submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        var $btn = $form.find(':submit');
        $.ajax({
            type: 'POST',
            url: 'crud_web.php?pg=simpan',
            data: $form.serialize(),
            beforeSend: function() {
                if ($btn.length) $btn.prop('disabled', true);
            },
            success: function(data) {
                console.log('simpan response:', data);
                var json;
                try {
                    json = (typeof data === 'object') ? data : $.parseJSON(data);
                } catch (err) {
                    console.error('Invalid JSON response for simpan:', data);
                    iziToast.error({
                        title: 'Error',
                        message: 'Server error. Periksa console untuk detail.',
                        position: 'topCenter'
                    });
                    if ($btn.length) $btn.prop('disabled', false);
                    return;
                }
                if ($btn.length) $btn.prop('disabled', false);
                if (json.pesan == 'ok') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.href = 'konfirmasi.php?id=' + json.id + '&nisn=' + json.nisn + '&pass=' + json.pass + '&nama=' + json.nama;
                    }, 2000);
                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: json.pesan,
                        position: 'topCenter'
                    });
                    try { document.getElementById('captcha').src = 'securimage/securimage_show.php?t=' + Math.random(); } catch (e) {}
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error simpan:', status, error, xhr.responseText);
                iziToast.error({
                    title: 'Error',
                    message: 'Request gagal. Periksa koneksi atau console.',
                    position: 'topCenter'
                });
                if ($btn.length) $btn.prop('disabled', false);
            }
        });
        return false;
    });
    if (jQuery().daterangepicker) {
        if ($(".datepicker").length) {
            $('.datepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
            });
        }
        if ($(".datetimepicker").length) {
            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD hh:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }
        if ($(".daterange").length) {
            $('.daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                drops: 'down',
                opens: 'right'
            });
        }
    }
    if (jQuery().select2) {
        $(".select2").select2();
    }
</script>
<script>
    // Handle Jalur dropdown for form-daftar
    $('#jalur').on('change', function() {
        if ($(this).val() === 'rekomendasi') {
            $('#cabang-container').show();
        } else {
            $('#cabang-container').hide();
            $('#cabang_ranting').val('');
        }
    });

    // Handle Jalur dropdown for form-daftar2
    $('#jalur2').on('change', function() {
        if ($(this).val() === 'rekomendasi') {
            $('#cabang-container2').show();
        } else {
            $('#cabang-container2').hide();
            $('#cabang_ranting2').val('');
        }
    });
</script>
<script>
    $('#form-daftar2').submit(function(e) {
        e.preventDefault();
        var $form = $(this);
        var $btn = $form.find(':submit');
        $.ajax({
            type: 'POST',
            url: 'crud_web.php?pg=simpan2',
            data: $form.serialize(),
            beforeSend: function() {
                if ($btn.length) $btn.prop('disabled', true);
            },
            success: function(data) {
                console.log('simpan2 response:', data);
                var json;
                try {
                    json = (typeof data === 'object') ? data : $.parseJSON(data);
                } catch (err) {
                    console.error('Invalid JSON response for simpan2:', data);
                    iziToast.error({
                        title: 'Error',
                        message: 'Server error. Periksa console untuk detail.',
                        position: 'topCenter'
                    });
                    if ($btn.length) $btn.prop('disabled', false);
                    return;
                }
                if ($btn.length) $btn.prop('disabled', false);
                if (json.pesan == 'ok') {
                    iziToast.success({
                        title: 'Mantap!',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    });
                    setTimeout(function() {
                        window.location.href = 'konfirmasi.php?id=' + json.id + '&nisn=' + json.nisn + '&pass=' + json.pass + '&nama=' + json.nama;
                    }, 2000);
                } else {
                    iziToast.error({
                        title: 'Maaf!',
                        message: json.pesan,
                        position: 'topCenter'
                    });
                    try { document.getElementById('captcha').src = 'securimage/securimage_show.php?t=' + Math.random(); } catch (e) {}
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error simpan2:', status, error, xhr.responseText);
                iziToast.error({
                    title: 'Error',
                    message: 'Request gagal. Periksa koneksi atau console.',
                    position: 'topCenter'
                });
                if ($btn.length) $btn.prop('disabled', false);
            }
        });
        return false;
    });
    if (jQuery().daterangepicker) {
        if ($(".datepicker").length) {
            $('.datepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
            });
        }
        if ($(".datetimepicker").length) {
            $('.datetimepicker').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD hh:mm'
                },
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
            });
        }
        if ($(".daterange").length) {
            $('.daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                drops: 'down',
                opens: 'right'
            });
        }
    }
    if (jQuery().select2) {
        $(".select2").select2();
    }
</script>
<!--WAKTU JALAN-->
	<script src="assets/front/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="assets/front/vendor/bootstrap/js/popper.js"></script>
	<script src="assets/front/vendor/countdowntime/flipclock.min.js"></script>
	<script src="assets/front/vendor/countdowntime/moment.min.js"></script>
	<script src="assets/front/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="assets/front/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="assets/front/vendor/countdowntime/countdowntime.js"></script>
	
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeMonth: <?= $diff->m ?>,
			endtimeDate: <?= $diff->d ?>,
			endtimeHours: <?= $diff->h ?>,
			endtimeMinutes: <?= $diff->i ?>,
			endtimeSeconds: <?= $diff->s ?>,
			timeZone: ""
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<script>
    // Password visibility toggle for any password-field within an input-group
    $(document).on('click', '.toggle-password', function() {
        var $btn = $(this);
        var $input = $btn.closest('.input-group').find('.password-field');
        if ($input.length) {
            if ($input.attr('type') === 'password') {
                $input.attr('type', 'text');
                $btn.find('i').removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                $input.attr('type', 'password');
                $btn.find('i').removeClass('fa-eye-slash').addClass('fa-eye');
            }
        }
    });
</script>
