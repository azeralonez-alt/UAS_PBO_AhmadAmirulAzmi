<?php
// File: index.php

require_once 'koneksi/database.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

try {
    $pdo = Database::getConnection();
    $sql = "SELECT * FROM tabel_mahasiswa ORDER BY jenis_pembiayaan ASC, nama_mahasiswa ASC";
    $stmt = $pdo->query($sql);
    $allData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $listMandiri = [];
    $listBidikmisi = [];
    $listPrestasi = [];

    foreach ($allData as $row) {
        if ($row['jenis_pembiayaan'] === 'Mandiri') {
            $listMandiri[] = [
                'obj' => new MahasiswaMandiri($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['golongan_ukt'], $row['nama_wali']),
                'raw' => $row
            ];
        } elseif ($row['jenis_pembiayaan'] === 'Bidikmisi') {
            $listBidikmisi[] = [
                'obj' => new MahasiswaBidikmisi($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['nomor_kip_kuliah'], $row['dana_saku_subsidi']),
                'raw' => $row
            ];
        } elseif ($row['jenis_pembiayaan'] === 'Prestasi') {
            $listPrestasi[] = [
                'obj' => new MahasiswaPrestasi($row['id_mahasiswa'], $row['nama_mahasiswa'], $row['nim'], $row['semester'], $row['tarif_ukt_nominal'], $row['nama_instansi_beasiswa'], $row['minimal_ipk_syarat']),
                'raw' => $row
            ];
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

        /* Top Bar khas PNC */
        .pnc-topbar {
            background-color: var(--pnc-skyblue);
            color: white;
            font-size: 0.85rem;
            padding: 8px 0;
            font-weight: 300;
        }

        /* Navbar / Branding Area */
        .pnc-brand-section {
            background-color: white;
            padding: 20px 0;
            border-bottom: 1px solid #E2E8F0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .pnc-logo-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--pnc-darknavy);
            margin: 0;
            letter-spacing: 0.5px;
        }
        
        .pnc-logo-text span {
            color: var(--pnc-orange);
        }

        /* Styling Kartu & Tabel Kategori */
        .card-pnc {
            background: white;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 40px;
            overflow: hidden;
        }

        .card-pnc-header {
            padding: 15px 20px;
            font-weight: 600;
            font-size: 1.1rem;
            color: white;
        }

        /* Pembagian warna header card sesuai kategori */
        .bg-mandiri { background-color: var(--pnc-darknavy); }
        .bg-bidikmisi { background-color: var(--pnc-skyblue); }
        .bg-prestasi { background-color: var(--pnc-orange); }

        .table-pnc thead {
            background-color: #EDF2F7;
            color: var(--pnc-darknavy);
            font-weight: 600;
        }

        .table-pnc th {
            border-bottom: 2px solid #CBD5E0;
            font-size: 0.9rem;
        }

        .table-pnc td {
            font-size: 0.9rem;
            padding: 12px 20px;
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
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <span class="me-3">📧 pmb@pnc.ac.id</span>
            <span>📞 (0282) 533329</span>
        </div>
        <div class="d-none d-md-block">
            📍 Jl. Dr. Soetomo No.1, Sidakaya, Cilacap
        </div>
    </div>
</div>

<div class="pnc-brand-section">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="pnc-logo-text">
            <h1>PMB <span>PNC</span></h1>
            <small class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 1px;">
                Sistem Registrasi & Pembayaran Kuliah Terpadu
            </small>
        </div>
        <div class="text-end d-none d-sm-block">
            <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.9rem;">Ahmad Amirul Azmi</h6>
            <span class="badge bg-secondary" style="font-size: 0.7rem;">Kelas TI1D - UAS PBO</span>
        </div>
    </div>
</div>

<div class="container my-5">

    <div class="card card-pnc">
        <div class="card-pnc-header bg-mandiri">
            🔹 Kategori: Mahasiswa Mandiri (+ Biaya Praktikum Flat Rp 100.000)
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-pnc mb-0 align-middle">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Semester</th>
                        <th>UKT Pokok</th>
                        <th>Total Tagihan (Polimorfisme)</th>
                        <th>Spesifikasi Akademik</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listMandiri as $item): ?>
                        <tr>
                            <td class="fw-bold text-secondary"><?= $item['raw']['nim']; ?></td>
                            <td class="fw-semibold" style="color: var(--pnc-darknavy);"><?= $item['raw']['nama_mahasiswa']; ?></td>
                            <td>Semester <?= $item['raw']['semester']; ?></td>
                            <td>Rp <?= number_format($item['raw']['tarif_ukt_nominal'], 0, ',', '.'); ?></td>
                            <td class="text-danger fw-bold">Rp <?= number_format($item['obj']->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                            <td><span class="badge-spesifikasi"><?= $item['obj']->tampilkanSpesifikasiAkademik(); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-pnc">
        <div class="card-pnc-header bg-bidikmisi">
            🔹 Kategori: Mahasiswa Bidikmisi (Subsidi Penuh KIP-Kuliah)
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-pnc mb-0 align-middle">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Semester</th>
                        <th>UKT Pokok</th>
                        <th>Total Tagihan (Polimorfisme)</th>
                        <th>Spesifikasi Akademik</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listBidikmisi as $item): ?>
                        <tr>
                            <td class="fw-bold text-secondary"><?= $item['raw']['nim']; ?></td>
                            <td class="fw-semibold" style="color: var(--pnc-darknavy);"><?= $item['raw']['nama_mahasiswa']; ?></td>
                            <td>Semester <?= $item['raw']['semester']; ?></td>
                            <td>Rp <?= number_format($item['raw']['tarif_ukt_nominal'], 0, ',', '.'); ?></td>
                            <td class="text-success fw-bold">Rp <?= number_format($item['obj']->hitungTagihanSemester(), 0, ',', '.'); ?> (Gratis)</td>
                            <td><span class="badge-spesifikasi" style="background-color: #EBF8FF; color: #2B6CB0;"><?= $item['obj']->tampilkanSpesifikasiAkademik(); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-pnc">
        <div class="card-pnc-header bg-prestasi text-white">
            🔹 Kategori: Mahasiswa Prestasi (Potongan Beasiswa 75%)
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-pnc mb-0 align-middle">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Semester</th>
                        <th>UKT Pokok</th>
                        <th>Total Tagihan (Polimorfisme)</th>
                        <th>Spesifikasi Akademik</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($listPrestasi as $item): ?>
                        <tr>
                            <td class="fw-bold text-secondary"><?= $item['raw']['nim']; ?></td>
                            <td class="fw-semibold" style="color: var(--pnc-darknavy);"><?= $item['raw']['nama_mahasiswa']; ?></td>
                            <td>Semester <?= $item['raw']['semester']; ?></td>
                            <td>Rp <?= number_format($item['raw']['tarif_ukt_nominal'], 0, ',', '.'); ?></td>
                            <td class="text-primary fw-bold">Rp <?= number_format($item['obj']->hitungTagihanSemester(), 0, ',', '.'); ?></td>
                            <td><span class="badge-spesifikasi" style="background-color: #FEFCBF; color: #B7791F;"><?= $item['obj']->tampilkanSpesifikasiAkademik(); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>