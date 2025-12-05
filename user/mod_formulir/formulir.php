<?php require "fungsi.php"; ?>
<?php if (isset($siswa['konfirmasi']) && $siswa['konfirmasi'] == 1) { ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Terimakasih !!!<br />
        Data Anda Telah Berhasil <button class="badge badge-danger"> Dikonfirmasi Pada Tanggal  <?= $siswa['tgl_konfirmasi'] ?></button>
    </div>
<?php } ?>
                    <style>
                        /* Custom Tab Navigation - Fully Responsive */
                        .custom-nav-tabs {
                            display: flex;
                            flex-wrap: wrap;
                            gap: 6px;
                            margin-bottom: 25px;
                            padding: 12px 10px;
                            background: linear-gradient(135deg, #f5f7fa 0%, #f9fafb 100%);
                            border-radius: 10px;
                            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
                            border: 1px solid #e8ecf1;
                        }
                        .custom-nav-item {
                            flex: 1 1 calc(50% - 6px);
                            min-width: 90px;
                            max-width: 100%;
                        }
                        .custom-nav-link {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            gap: 6px;
                            padding: 10px 10px;
                            border-radius: 6px;
                            border: 1.5px solid #d1d8e0;
                            background-color: #fff;
                            color: #495057;
                            font-weight: 500;
                            font-size: 12px;
                            text-decoration: none;
                            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
                            cursor: pointer;
                            width: 100%;
                            white-space: nowrap;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            outline: none;
                        }
                        .custom-nav-link:hover:not(.active) {
                            border-color: #0d6efd;
                            background-color: #f0f8ff;
                            color: #0d6efd;
                            box-shadow: 0 3px 10px rgba(13, 110, 253, 0.12);
                        }
                        .custom-nav-link:focus {
                            outline: 2px solid #0d6efd;
                            outline-offset: -2px;
                        }
                        .custom-nav-link.active {
                            background: linear-gradient(135deg, #0d6efd 0%, #0051b3 100%);
                            border-color: #0051b3;
                            color: #fff;
                            box-shadow: 0 4px 14px rgba(13, 110, 253, 0.3);
                        }
                        .custom-nav-link i {
                            font-size: 15px;
                            flex-shrink: 0;
                        }
                        .custom-nav-label {
                            display: none;
                            flex-shrink: 0;
                        }
                        /* Small devices (landscape phones) */
                        @media (min-width: 480px) {
                            .custom-nav-item {
                                flex: 1 1 calc(50% - 6px);
                            }
                            .custom-nav-link {
                                padding: 10px 12px;
                                font-size: 12px;
                            }
                        }
                        /* Tablets and up */
                        @media (min-width: 576px) {
                            .custom-nav-tabs {
                                gap: 8px;
                                padding: 14px 12px;
                            }
                            .custom-nav-item {
                                flex: 1 1 auto;
                                min-width: 130px;
                            }
                            .custom-nav-link {
                                padding: 12px 14px;
                                font-size: 13px;
                                gap: 8px;
                            }
                            .custom-nav-label {
                                display: inline;
                            }
                        }
                        /* Desktop */
                        @media (min-width: 768px) {
                            .custom-nav-tabs {
                                gap: 10px;
                                padding: 15px 14px;
                            }
                            .custom-nav-item {
                                min-width: 160px;
                            }
                            .custom-nav-link {
                                padding: 13px 16px;
                                font-size: 14px;
                            }
                        }
                    </style>
                    <ul class="nav nav-tabs custom-nav-tabs" id="myTab3" role="tablist">
                        <li class="nav-item custom-nav-item">
                            <a class="nav-link custom-nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home3" aria-selected="true" title="Data Diri Siswa">
                                <i class="fas fa-user"></i>
                                <span class="custom-nav-label">Data Diri</span>
                            </a>
                        </li>
                        <li class="nav-item custom-nav-item">
                            <a class="nav-link custom-nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile3" aria-selected="false" title="Data Alamat Tempat Tinggal">
                                <i class="fas fa-home"></i>
                                <span class="custom-nav-label">Data Alamat</span>
                            </a>
                        </li>
                        <li class="nav-item custom-nav-item">
                            <a class="nav-link custom-nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact3" aria-selected="false" title="Data Orang Tua & Wali">
                                <i class="fas fa-user-friends"></i>
                                <span class="custom-nav-label">Orang Tua</span>
                            </a>
                        </li>
                        <li class="nav-item custom-nav-item">
                            <a class="nav-link custom-nav-link" id="foto-tab3" data-toggle="tab" href="#foto3" role="tab" aria-controls="foto3" aria-selected="false" title="Upload Foto Profile">
                                <i class="fas fa-image"></i>
                                <span class="custom-nav-label">Foto</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
            <div class="card-body">
                            <form id="form-datadiri">
                                <!-- Data Diri ditampilkan; sebagian field disembunyikan sesuai permintaan user -->
                                        <input type="text" name="warga_siswa_lain" id="warga_siswa_lain" class="form-control mt-2" placeholder="Isi kewarganegaraan lain" style="display:none;" value="<?= (!isset($warga_siswa[$siswa['warga_siswa']]) ? $siswa['warga_siswa'] : '') ?>">
                                
                                <!-- 1. Data Diri Siswa -->
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="nama" class="form-control" value="<?= $siswa['nama'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tempat Lahir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="tempat" class="form-control" value="<?= $siswa['tempat_lahir'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="tgllahir" class="form-control datepicker" value="<?= $siswa['tgl_lahir'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class='form-control' name='jenkel_display' id="jenkel_display" disabled>
                                            <option value='Perempuan'>Perempuan</option>
                                        </select>
                                        <input type="hidden" name="jenkel" value="Perempuan">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Agama</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class='form-control' id="agama_display" disabled>
                                            <option value='Islam'>Islam</option>
                                        </select>
                                        <input type="hidden" name="agama" value="Islam">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="email" class="form-control" value="<?= $siswa['email'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Handphone</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="d-flex">
                                            <input type="text" placeholder="+62" disabled style="width: 35px;">
                                            <input type="number" name="nohp" class="form-control" value="<?= $siswa['no_hp'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Anak Ke</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="anakke" class="form-control" value="<?= $siswa['anak_ke'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Saudara</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="saudara" class="form-control" value="<?= $siswa['saudara'] ?>" >
                                    </div>
                                </div>
                                <!-- 2. Identitas Keluarga -->
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Yang Bertanggung Jawab</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class='form-control' name='biaya_sekolah' >
                                            <option value="Orang Tua" <?= ($siswa['biaya_sekolah'] == 'Orang Tua') ? 'selected' : '' ?>>Orang Tua</option>
                                            <option value="Wali/Orang Tua Asuh" <?= ($siswa['biaya_sekolah'] == 'Wali/Orang Tua Asuh') ? 'selected' : '' ?>>Wali/Orang Tua Asuh</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No KK</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="nokk" class="form-control" value="<?= $siswa['no_kk'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Kepala Keluarga</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="kepala_keluarga" class="form-control" value="<?= $siswa['kepala_keluarga'] ?>" >
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No KIP</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="kip" class="form-control" value="<?= $siswa['no_kip'] ?>" placeholder="kosongkan jika tidak punya KIP">
                                    </div>
                                </div>
                                <!-- 3. Riwayat Pendidikan -->
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Asal Sekolah</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="asal_sekolah" class="form-control" value="<?= $siswa['asal_sekolah'] ?? '' ?>" placeholder="Nama sekolah asal">
                                    </div>
                                </div>
                                <!-- 4. Kondisi Kesehatan -->
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Punya Alergi?</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="alergi" id="alergi_ya" value="Ya" <?= ($siswa['alergi'] ?? '')=='Ya'?'checked':'' ?>>
                                            <label class="form-check-label" for="alergi_ya">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="alergi" id="alergi_tidak" value="Tidak" <?= ($siswa['alergi'] ?? '')=='Tidak'?'checked':'' ?>>
                                            <label class="form-check-label" for="alergi_tidak">Tidak</label>
                                        </div>
                                        <div id="alergi_detail" style="display:none; margin-top:8px;">
                                            <input type="text" name="alergi_detail" class="form-control" placeholder="Jelaskan alergi" value="<?= $siswa['alergi_detail'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Punya Penyakit Dalam?</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="penyakit" id="penyakit_ya" value="Ya" <?= ($siswa['penyakit'] ?? '')=='Ya'?'checked':'' ?>>
                                            <label class="form-check-label" for="penyakit_ya">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="penyakit" id="penyakit_tidak" value="Tidak" <?= ($siswa['penyakit'] ?? '')=='Tidak'?'checked':'' ?>>
                                            <label class="form-check-label" for="penyakit_tidak">Tidak</label>
                                        </div>
                                        <div id="penyakit_detail" style="display:none; margin-top:8px;">
                                            <input type="text" name="penyakit_detail" class="form-control" placeholder="Jelaskan penyakit" value="<?= $siswa['penyakit_detail'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Informasi ringkas: Data Diri disimpan melalui tombol di bagian ini -->
                                    <center><button id="btnsimpan-datadiri" type="submit" class="btn btn-primary btn-lg mt-2">Simpan Data Diri</button></center>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                            <!-- Data Alamat (profile3) -->
                            <form id="form-alamat">

                                <!-- Alamat Utama -->
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Tempat Tinggal</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class='form-control' name='status_tinggal'>
                                            <option value="Tinggal dengan Orang Tua/Wali" <?= ($siswa['status_tinggal'] == 'Tinggal dengan Orang Tua/Wali') ? 'selected' : '' ?>>Tinggal dengan Orang Tua/Wali</option>
                                            <option value="Tinggal di Kontrakan/Kost" <?= ($siswa['status_tinggal'] == 'Tinggal di Kontrakan/Kost') ? 'selected' : '' ?>>Tinggal di Kontrakan/Kost</option>
                                            <option value="Tinggal di Asrama/Madrasah" <?= ($siswa['status_tinggal'] == 'Tinggal di Asrama/Madrasah') ? 'selected' : '' ?>>Tinggal di Asrama/Madrasah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Jalan / Kampung</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="nama_jalan" class="form-control" value="<?= $siswa['nama_jalan'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">RT</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="rt" class="form-control" placeholder="RT" value="<?= $siswa['rt'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">RW</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="rw" class="form-control" placeholder="RW" value="<?= $siswa['rw'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Desa / Kelurahan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="desa" class="form-control" value="<?= $siswa['desa'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="kecamatan" class="form-control" value="<?= $siswa['kecamatan'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kabupaten / Kota</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="kabupaten" class="form-control" value="<?= $siswa['kabupaten'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Provinsi</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="provinsi" class="form-control" value="<?= $siswa['provinsi'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Pos</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="kodepos" class="form-control" value="<?= $siswa['kodepos'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <p>*Harap isi data alamat dengan sebenar-benarnya</p>
                                    <center><button id="btnsimpan-alamat" type="submit" class="btn btn-primary btn-lg mt-2">Simpan Data Alamat</button></center>
                                </div>

                            </form>
                        </div>
                        <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                            <!-- Data Orang Tua -->
                            <form id="form-orangtua">
								<!-- Data Ayah -->
<h5><i class="fas fa-user-check"></i> Data Ayah</h5>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK Ayah</label>
    <div class="col-sm-12 col-md-7">
        <input type="number" name="nikayah" class="form-control" value="<?= $siswa['nik_ayah'] ?>" >
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Ayah</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="namaayah" class="form-control" value="<?= $siswa['nama_ayah'] ?>" >
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tempat Lahir Ayah</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="tempat_lahir_ayah" class="form-control" value="<?= $siswa['tempat_lahir_ayah'] ?? '' ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir Ayah</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="tgl_lahir_ayah" class="form-control datepicker" value="<?= $siswa['tgl_lahir_ayah'] ?? '' ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pendidikan Ayah</label>
    <div class="col-sm-12 col-md-7">
        <select class='form-control' name='pendidikan_ayah'>
            <?php foreach ($pendidikan as $val) { ?>
                <?php if (($siswa['pendidikan_ayah'] ?? '') == $val) { ?>
                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                <?php  } else { ?>
                    <option value='<?= $val ?>'><?= $val ?> </option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan Ayah</label>
    <div class="col-sm-12 col-md-7">
        <select class='form-control' name='pekerjaan_ayah' id="pekerjaan_ayah_select">
            <?php foreach ($pekerjaan as $val) { ?>
                <?php if ($siswa['pekerjaan_ayah'] == $val) { ?>
                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                <?php  } else { ?>
                    <option value='<?= $val ?>'><?= $val ?> </option>
                <?php } ?>
            <?php } ?>
        </select>
        <div id="pekerjaan_ayah_lain" style="display:none; margin-top:8px;">
            <input type="text" name="pekerjaan_ayah_lain" class="form-control" placeholder="Sebutkan pekerjaan Ayah" value="<?= $siswa['pekerjaan_ayah_lain'] ?? '' ?>">
        </div>
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penghasilan Ayah</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="penghasilan_ayah" class="form-control" value="<?= $siswa['penghasilan_ayah'] ?>" placeholder="Masukkan penghasilan">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No HP Ayah</label>
    <div class="col-sm-12 col-md-7">
        <input type="number" name="nohpayah" class="form-control" value="<?= $siswa['no_hp_ayah'] ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Ayah</label>
    <div class="col-sm-12 col-md-7">
        <select class="form-control" name="status_ayah" required>
            <option value="Masih Hidup" <?= ($siswa['status_ayah'] ?? '') == 'Masih Hidup' ? 'selected' : '' ?>>Masih Hidup</option>
            <option value="Meninggal Dunia" <?= ($siswa['status_ayah'] ?? '') == 'Meninggal Dunia' ? 'selected' : '' ?>>Meninggal Dunia</option>
            <option value="Tidak Diketahui" <?= ($siswa['status_ayah'] ?? '') == 'Tidak Diketahui' ? 'selected' : '' ?>>Tidak Diketahui</option>
        </select>
    </div>
</div>
<!-- Data Ibu -->
<h5><i class="fas fa-user-check"></i> Data Ibu</h5>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK Ibu</label>
    <div class="col-sm-12 col-md-7">
        <input type="number" name="nikibu" class="form-control" value="<?= $siswa['nik_ibu'] ?>" >
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Ibu</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="namaibu" class="form-control" value="<?= $siswa['nama_ibu'] ?>" >
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tempat Lahir Ibu</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="tempat_lahir_ibu" class="form-control" value="<?= $siswa['tempat_lahir_ibu'] ?? '' ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir Ibu</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="tgl_lahir_ibu" class="form-control datepicker" value="<?= $siswa['tgl_lahir_ibu'] ?? '' ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pendidikan Ibu</label>
    <div class="col-sm-12 col-md-7">
        <select class='form-control' name='pendidikan_ibu'>
            <?php foreach ($pendidikan as $val) { ?>
                <?php if ($siswa['pendidikan_ibu'] == $val) { ?>
                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                <?php  } else { ?>
                    <option value='<?= $val ?>'><?= $val ?> </option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan Ibu</label>
    <div class="col-sm-12 col-md-7">
        <select class='form-control' name='pekerjaan_ibu' id="pekerjaan_ibu_select">
            <?php foreach ($pekerjaan as $val) { ?>
                <?php if ($siswa['pekerjaan_ibu'] == $val) { ?>
                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                <?php  } else { ?>
                    <option value='<?= $val ?>'><?= $val ?> </option>
                <?php } ?>
            <?php } ?>
        </select>
        <div id="pekerjaan_ibu_lain" style="display:none; margin-top:8px;">
            <input type="text" name="pekerjaan_ibu_lain" class="form-control" placeholder="Sebutkan pekerjaan Ibu" value="<?= $siswa['pekerjaan_ibu_lain'] ?? '' ?>">
        </div>
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penghasilan Ibu</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="penghasilan_ibu" class="form-control" value="<?= $siswa['penghasilan_ibu'] ?>" placeholder="Masukkan penghasilan">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No HP Ibu</label>
    <div class="col-sm-12 col-md-7">
        <input type="number" name="nohpibu" class="form-control" value="<?= $siswa['no_hp_ibu'] ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Ibu</label>
    <div class="col-sm-12 col-md-7">
        <select class="form-control" name="status_ibu" required>
            <option value="Masih Hidup" <?= ($siswa['status_ibu'] ?? '') == 'Masih Hidup' ? 'selected' : '' ?>>Masih Hidup</option>
            <option value="Meninggal Dunia" <?= ($siswa['status_ibu'] ?? '') == 'Meninggal Dunia' ? 'selected' : '' ?>>Meninggal Dunia</option>
            <option value="Tidak Diketahui" <?= ($siswa['status_ibu'] ?? '') == 'Tidak Diketahui' ? 'selected' : '' ?>>Tidak Diketahui</option>
        </select>
    </div>
</div>
<!-- Data Wali -->
<h5><i class="fas fa-user-check"></i> Data Wali</h5>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK Wali</label>
    <div class="col-sm-12 col-md-7">
        <input type="number" name="nikwali" class="form-control" value="<?= $siswa['nik_wali'] ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Wali</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="namawali" class="form-control" value="<?= $siswa['nama_wali'] ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tempat Lahir Wali</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="tempat_lahir_wali" class="form-control" value="<?= $siswa['tempat_lahir_wali'] ?? '' ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir Wali</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="tgl_lahir_wali" class="form-control datepicker" value="<?= $siswa['tgl_lahir_wali'] ?? '' ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pendidikan Wali</label>
    <div class="col-sm-12 col-md-7">
        <select class='form-control' name='pendidikan_wali'>
            <?php foreach ($pendidikan as $val) { ?>
                <?php if ($siswa['pendidikan_wali'] == $val) { ?>
                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                <?php  } else { ?>
                    <option value='<?= $val ?>'><?= $val ?> </option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan Wali</label>
    <div class="col-sm-12 col-md-7">
        <select class='form-control' name='pekerjaan_wali' id="pekerjaan_wali_select">
            <?php foreach ($pekerjaan as $val) { ?>
                <?php if ($siswa['pekerjaan_wali'] == $val) { ?>
                    <option value='<?= $val ?>' selected><?= $val ?> </option>
                <?php  } else { ?>
                    <option value='<?= $val ?>'><?= $val ?> </option>
                <?php } ?>
            <?php } ?>
        </select>
        <div id="pekerjaan_wali_lain" style="display:none; margin-top:8px;">
            <input type="text" name="pekerjaan_wali_lain" class="form-control" placeholder="Sebutkan pekerjaan Wali" value="<?= $siswa['pekerjaan_wali_lain'] ?? '' ?>">
        </div>
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Penghasilan Wali</label>
    <div class="col-sm-12 col-md-7">
        <input type="text" name="penghasilan_wali" class="form-control" value="<?= $siswa['penghasilan_wali'] ?>" placeholder="Masukkan penghasilan">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No HP Wali</label>
    <div class="col-sm-12 col-md-7">
        <input type="number" name="nohpwali" class="form-control" value="<?= $siswa['no_hp_wali'] ?>">
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Wali</label>
    <div class="col-sm-12 col-md-7">
        <select class="form-control" name="status_wali" required>
            <option value="Masih Hidup" <?= ($siswa['status_wali'] ?? '') == 'Masih Hidup' ? 'selected' : '' ?>>Masih Hidup</option>
            <option value="Meninggal Dunia" <?= ($siswa['status_wali'] ?? '') == 'Meninggal Dunia' ? 'selected' : '' ?>>Meninggal Dunia</option>
            <option value="Tidak Diketahui" <?= ($siswa['status_wali'] ?? '') == 'Tidak Diketahui' ? 'selected' : '' ?>>Tidak Diketahui</option>
        </select>
    </div>
</div>
                                <div class="form-group">
                                    <p>*Harap isi data orang tua dengan sebenar-benarnya</p>
                                    <center><button id="btnsimpan-ortu" type="submit" class="btn btn-primary btn-lg mt-2">Simpan Data Orang Tua</button></center>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="foto3" role="tabpanel" aria-labelledby="profile-tab3">
                            <form id="form-setting" enctype="multipart/form-data">
                                <div class="card" id="settings-card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Preview Foto</label>
                                            <div id="foto-preview">
                                                <img alt="image" src="../<?= !empty($siswa['foto']) ? $siswa['foto'] : 'assets/img/avatar/avatar-1.png' ?>" class="rounded-circle mr-1" style="width:100px; height:100px; object-fit:cover; border-radius:50%;">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>upload foto untuk profile</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="foto_file" name="foto" accept="image/*">
                                                <label class="custom-file-label" for="foto_file">Pilih file</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan Foto</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                
                </div>
            </div>
        </div>
    </div>
		
</div>
<script>
     $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
    $('#form-setting').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'mod_formulir/crud_upload.php?pg=foto',
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                $('form button').on("click", function(e) {
                    e.preventDefault();
                });
            },
            success: function(data) {
                // Expect server returns new photo path
                let newPhoto = '';
                try {
                    let json = JSON.parse(data);
                    newPhoto = json.foto_path || '';
                } catch(e) {
                    newPhoto = data;
                }
                if(newPhoto) {
                    $('#foto-preview img').attr('src', '../'+newPhoto);
                }
                iziToast.success({
                    title: 'Mantap! ',
                    message: 'Foto Anda berhasil disimpan',
                    position: 'topRight'
                });
                // No reload, just update preview
            }
        });
    });
</script>

<script>
// Conditional show/hide and autosave (centralized)
$(function(){
    function toggleAlergi(){
        if($('#alergi_ya').is(':checked')) $('#alergi_detail').show(); else $('#alergi_detail').hide();
    }
    function togglePenyakit(){
        if($('#penyakit_ya').is(':checked')) $('#penyakit_detail').show(); else $('#penyakit_detail').hide();
    }
    function toggleHobi(){
        if($('#hobi_select').val()=='Lainnya') $('#hobi_lain').show(); else $('#hobi_lain').hide();
    }
    function toggleCitacita(){
        if($('#citacita_select').val()=='Lainnya') $('#citacita_lain').show(); else $('#citacita_lain').hide();
    }
    function toggleWarga(){
        if($('#warga_siswa_select').val()=='Lainnya') $('#warga_siswa_lain').show(); else $('#warga_siswa_lain').hide();
    }
    function togglePekerjaanAyah(){
        if($('#pekerjaan_ayah_select').val()=='Lainnya') $('#pekerjaan_ayah_lain').show(); else $('#pekerjaan_ayah_lain').hide();
    }
    function togglePekerjaanIbu(){
        if($('#pekerjaan_ibu_select').val()=='Lainnya') $('#pekerjaan_ibu_lain').show(); else $('#pekerjaan_ibu_lain').hide();
    }
    function togglePekerjaanWali(){
        if($('#pekerjaan_wali_select').val()=='Lainnya') $('#pekerjaan_wali_lain').show(); else $('#pekerjaan_wali_lain').hide();
    }

    // initial
    toggleAlergi(); togglePenyakit(); toggleHobi(); toggleCitacita(); toggleWarga();
    togglePekerjaanAyah(); togglePekerjaanIbu(); togglePekerjaanWali();

    $('input[name="alergi"]').on('change', function(){ toggleAlergi(); autosaveDatadiriDebounced(); });
    $('input[name="penyakit"]').on('change', function(){ togglePenyakit(); autosaveDatadiriDebounced(); });
    $('#hobi_select').on('change', function(){ toggleHobi(); autosaveDatadiriDebounced(); });
    $('#citacita_select').on('change', function(){ toggleCitacita(); autosaveDatadiriDebounced(); });
    $('#warga_siswa_select').on('change', function(){ toggleWarga(); autosaveDatadiriDebounced(); });
    $('#pekerjaan_ayah_select').on('change', function(){ togglePekerjaanAyah(); });
    $('#pekerjaan_ibu_select').on('change', function(){ togglePekerjaanIbu(); });
    $('#pekerjaan_wali_select').on('change', function(){ togglePekerjaanWali(); });
    $('#hobi_lain, #citacita_lain, #alergi_detail, #penyakit_detail, #warga_siswa_lain').on('input', function(){ autosaveDatadiriDebounced(); });

    var autosaveTimer = null;
    window.autosaveDatadiriDebounced = function(){
        if(autosaveTimer) clearTimeout(autosaveTimer);
        autosaveTimer = setTimeout(function(){
            var $form = $('#form-datadiri');
            $.ajax({
                type: 'POST',
                url: 'mod_formulir/crud_formulir.php?pg=simpandatadiri',
                data: $form.serialize(),
                success: function(data){
                    // silent
                }
            });
        }, 900);
    };
});
</script>
<script>
	$('.form-control').keyup(function(event) {

        $(this).val($(this).val().toUpperCase());
    });
    $(document).ready(function() {
                $('#form-datadiri').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'mod_formulir/crud_formulir.php?pg=simpandatadiri',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btnsimpan-datadiri').prop('disabled', true);
                },
                success: function(data) {
                    var json = data;
                    $('#btnsimpan-datadiri').prop('disabled', false);
                    if (json == 'ok') {
                        iziToast.success({
                            title: 'Terima Kasih!',
                            message: 'Data Diri Anda berhasil disimpan',
                            position: 'topCenter'
                        });

                    } else {
                        iziToast.error({
                            title: 'Maaf!',
                            message: json,
                            position: 'topCenter'
                        });
                    }
                    //$('#bodyreset').load(location.href + ' #bodyreset');
                }
            });
            return false;
        });
        $('#form-alamat').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'mod_formulir/crud_formulir.php?pg=simpanalamat',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btnsimpan-alamat').prop('disabled', true);
                },
                success: function(data) {
                    var json = data;
                    $('#btnsimpan-alamat').prop('disabled', false);
                    if (json == 'ok') {
                        iziToast.success({
                            title: 'Terima Kasih!',
                            message: 'Data Alamat anda berhasil disimpan',
                            position: 'topCenter'
                        });

                    } else {
                        iziToast.error({
                            title: 'Maaf!',
                            message: json,
                            position: 'topCenter'
                        });
                    }
                    //$('#bodyreset').load(location.href + ' #bodyreset');
                }
            });
            return false;
        });
        $('#form-orangtua').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'mod_formulir/crud_formulir.php?pg=simpanortu',
                data: $(this).serialize(),
                beforeSend: function() {
                    $('#btnsimpan-ortu').prop('disabled', true);
                },
                success: function(data) {
                    var json = data;
                    $('#btnsimpan-ortu').prop('disabled', false);
                    if (json == 'ok') {
                        iziToast.success({
                            title: 'Terima Kasih!',
                            message: 'Data Orang Tua anda berhasil disimpan',
                            position: 'topCenter'
                        });

                    } else {
                        iziToast.error({
                            title: 'Maaf!',
                            message: json,
                            position: 'topCenter'
                        });
                    }
                    //$('#bodyreset').load(location.href + ' #bodyreset');
                }
            });
            return false;
        });
        // $("#form-datadiri").validate({
        //     rules: {
        //         "b[firstname]": {
        //             : true
        //         },
        //         "b[email]": {
        //             : true,
        //             email: true
        //         },
        //         "book[contact]": {
        //             : true
        //         }
        //     },
        //     submitHandler: function(form) {
        //         var formData = $(form).serialize();
        //         alert(formData); // for demo
        //         // comment out ajax for demo
        //         /*
        //         $.ajax({
        //             url: "bs_client_function.php?action=new_b",
        //             type: "post",
        //             data: formData,
        //             beforeSend: function () {

        //             },
        //             success: function (data) {

        //             }
        //         });
        //         */
        //     }
        // });

    });
    
    // Sync custom nav links active state with Bootstrap tab toggle - Responsive Tab Navigation
    $(document).ready(function() {
        // When a tab is shown, update the active state
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var target = $(this).attr('href');
            $('.custom-nav-link').removeClass('active');
            $('.custom-nav-link[href="' + target + '"]').addClass('active');
            // Update aria-selected for accessibility
            $('a[data-toggle="tab"]').attr('aria-selected', 'false');
            $(this).attr('aria-selected', 'true');
        });
        
        // Initialize active state on page load
        var activeTab = $('.tab-pane.show.active').attr('id');
        if (activeTab) {
            $('.custom-nav-link[href="#' + activeTab + '"]').addClass('active');
        }
    });

</script>
<!-- Tambahkan Bootstrap JS dan jQuery jika belum ada -->
<script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/modules/bootstrap/js/bootstrap.js"></script>
