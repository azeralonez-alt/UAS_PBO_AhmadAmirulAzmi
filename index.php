<?php
// File: index.php

require_once 'koneksi/database.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

try {
    $pdo = Database::getConnection();
    // Ambil semua data registrasi secara dinamis dari database
    $sql = "SELECT * FROM tabel_mahasiswa ORDER BY id_mahasiswa ASC";
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Array Master untuk menampung semua objek mahasiswa secara global (Poin 1)
    $daftarRegistrasi = [];

    // Proses Hydration: Mengubah data mentah DB menjadi kumpulan objek resmi
    foreach ($rows as $row) {
        if ($row['jenis_pembiayaan'] === 'Mandiri') {
            $daftarRegistrasi[] = new MahasiswaMandiri(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], 
                $row['semester'], $row['tarif_ukt_nominal'], 
                $row['golongan_ukt'], $row['nama_wali']
            );
        } elseif ($row['jenis_pembiayaan'] === 'Bidikmisi') {
            $daftarRegistrasi[] = new MahasiswaBidikmisi(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], 
                $row['semester'], $row['tarif_ukt_nominal'], 
                $row['nomor_kip_kuliah'], $row['dana_saku_subsidi']
            );
        } elseif ($row['jenis_pembiayaan'] === 'Prestasi') {
            $daftarRegistrasi[] = new MahasiswaPrestasi(
                $row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], 
                $row['semester'], $row['tarif_ukt_nominal'], 
                $row['nama_instansi_beasiswa'], $row['minimal_ipk_syarat']
            );
        }
    }
} catch (Exception $e) {
    die("Gagal memuat data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMB PNC - Daftar Registrasi Pembayaran Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --pnc-skyblue: #5BB2E7;
            --pnc-darknavy: #1C2D42;
            --pnc-orange: #F39C12;
            --pnc-lightbg: #F4F7F9;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--pnc-lightbg);
            color: #444;
        }
        .pnc-topbar {
            background-color: var(--pnc-skyblue);
            color: white;
            font-size: 0.85rem;
            padding: 8px 0;
        }
        .pnc-brand-section {
            background-color: white;
            padding: 20px 0;
            border-bottom: 1px solid #E2E8F0;
        }
        .pnc-logo-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--pnc-darknavy);
            margin: 0;
        }
        .pnc-logo-text span {
            color: var(--pnc-orange);
        }
        .nav-tabs-pnc .nav-link {
            color: var(--pnc-darknavy);
            font-weight: 500;
            border: none;
            padding: 12px 20px;
        }
        .nav-tabs-pnc .nav-link.active {
            color: white;
            background-color: var(--pnc-darknavy);
            border-radius: 5px 5px 0 0;
        }
        .card-pnc {
            background: white;
            border: none;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        .table-pnc thead {
            background-color: #EDF2F7;
            color: var(--pnc-darknavy);
        }
        .table-pnc td, .table-pnc th {
            padding: 12px 20px;
            font-size: 0.9rem;
        }
        .badge-kategori {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-spesifikasi {
            background-color: #E2E8F0;
            color: var(--pnc-darknavy);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<div class="pnc-topbar">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <span class="me-3">📧 pmb@pnc.ac.id</span>
            <span>📞 (0282) 533329</span>
        </div>
        <div>📍 Jl. Dr. Soetomo No.1, Sidakaya, Cilacap</div>
    </div>
</div>

<div class="pnc-brand-section">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="pnc-logo-text">
            <h1>PMB <span>PNC</span></h1>
            <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">
                Sistem Registrasi & Pembayaran Kuliah Terpadu
            </small>
        </div>
        <div class="text-end">
            <h6 class="mb-0 fw-bold text-dark">Ahmad Amirul Azmi</h6>
            <span class="badge bg-secondary" style="font-size: 0.7rem;">Kelas TI1D - UAS PBO</span>
        </div>
    </div>
</div>

<div class="container my-5">

    <ul class="nav nav-tabs nav-tabs-pnc" id="pncTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all-pane" type="button" role="tab">
                📋 Halaman Utama (Daftar Registrasi Dinamis)
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="grouped-tab" data-bs-toggle="tab" data-bs-target="#grouped-pane" type="button" role="tab">
                📊 Laporan Terkelompok Kategori
            </button>
        </li>
    </ul>

    <div class="tab-content" id="pncTabContent">
        
        <div class="tab-pane fade show active" id="all-pane" role="tabpanel" aria-labelledby="all-tab">
            <div class="card card-pnc p-4">
                <div class="mb-3">
                    <h5 class="fw-bold text-dark m-0">Seluruh Daftar Registrasi Pembayaran Mahasiswa</h5>
                    <p class="text-muted small">Menampilkan data secara *real-time* dan dinamis langsung dari database.</p>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-pnc align-middle">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Semester</th>
                                <th>Kategori Pembiayaan</th>
                                <th>Total Tagihan (Polimorfisme)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($daftarRegistrasi)): ?>
                                <tr><td colspan="5" class="text-center text-muted">Belum ada data registrasi di database.</td></tr>
                            <?php else: ?>
                                <?php foreach($daftarRegistrasi as $mhs): ?>
                                    <tr>
                                        <td class="fw-bold text-secondary"><?= $mhs->getNim(); ?></td>
                                        <td class="fw-semibold" style="color: var(--pnc-darknavy);"><?= $mhs->getNamaMahasiswa(); ?></td>
                                        <td>Semester <?= $mhs->getSemester(); ?></td>
                                        <td>
                                            <?php 
                                            // Menentukan badge teks kategori secara dinamis lewat tipe objek
                                            if ($mhs instanceof MahasiswaMandiri) {
                                                echo '<span class="badge-kategori bg-dark text-white">Mandiri</span>';
                                            } elseif ($mhs instanceof MahasiswaBidikmisi) {
                                                echo '<span class="badge-kategori text-white" style="background-color: var(--pnc-skyblue);">Bidikmisi</span>';
                                            } elseif ($mhs instanceof MahasiswaPrestasi) {
                                                echo '<span class="badge-kategori text-white" style="background-color: var(--pnc-orange);">Prestasi</span>';
                                            }
                                            ?>
                                        </td>
                                        <td class="fw-bold text-dark">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="grouped-pane" role="tabpanel" aria-labelledby="grouped-tab">
            <div class="card card-pnc p-4">
                
                <h6 class="fw-bold mt-2 mb-3" style="color: var(--pnc-darknavy);">▶ Kategori: Mahasiswa Mandiri</h6>
                <div class="table-responsive mb-4">
                    <table class="table table-sm table-hover table-pnc align-middle">
                        <thead class="table-light">
                            <tr><th>NIM</th><th>Nama</th><th>UKT Pokok</th><th>Tagihan + Praktikum</th><th>Spesifikasi Akademik</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach($daftarRegistrasi as $mhs): ?>
                                <?php if($mhs instanceof MahasiswaMandiri): ?>
                                    <tr>
                                        <td><?= $mhs->getNim(); ?></td>
                                        <td class="fw-semibold"><?= $mhs->getNamaMahasiswa(); ?></td>
                                        <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                        <td class="text-danger fw-bold">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                        <td><span class="badge-spesifikasi"><?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <h6 class="fw-bold mb-3" style="color: var(--pnc-skyblue);">▶ Kategori: Mahasiswa Bidikmisi</h6>
                <div class="table-responsive mb-4">
                    <table class="table table-sm table-hover table-pnc align-middle">
                        <thead class="table-light">
                            <tr><th>NIM</th><th>Nama</th><th>UKT Pokok</th><th>Tagihan Akhir</th><th>Spesifikasi Akademik</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach($daftarRegistrasi as $mhs): ?>
                                <?php if($mhs instanceof MahasiswaBidikmisi): ?>
                                    <tr>
                                        <td><?= $mhs->getNim(); ?></td>
                                        <td class="fw-semibold"><?= $mhs->getNamaMahasiswa(); ?></td>
                                        <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                        <td class="text-success fw-bold">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?> (Gratis)</td>
                                        <td><span class="badge-spesifikasi" style="background-color: #EBF8FF; color: #2B6CB0;"><?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <h6 class="fw-bold mb-3" style="color: var(--pnc-orange);">▶ Kategori: Mahasiswa Prestasi</h6>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-pnc align-middle">
                        <thead class="table-light">
                            <tr><th>NIM</th><th>Nama</th><th>UKT Pokok</th><th>Tagihan (Diskon 75%)</th><th>Spesifikasi Akademik</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach($daftarRegistrasi as $mhs): ?>
                                <?php if($mhs instanceof MahasiswaPrestasi): ?>
                                    <tr>
                                        <td><?= $mhs->getNim(); ?></td>
                                        <td class="fw-semibold"><?= $mhs->getNamaMahasiswa(); ?></td>
                                        <td>Rp <?= number_format($mhs->getTarifUktNominal(), 0, ',', '.'); ?></td>
                                        <td class="text-primary fw-bold">Rp <?= number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                                        <td><span class="badge-spesifikasi" style="background-color: #FEFCBF; color: #B7791F;"><?= $mhs->tampilkanSpesifikasiAkademik(); ?></span></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>