<?php
// File: MahasiswaPrestasi.php
require_once 'Mahasiswa.php';
require_once 'koneksi/database.php'; // <--- MEMBERIKAN AKSES KONEKSI DATABASE

class MahasiswaPrestasi extends Mahasiswa {
    protected $namaInstansiBeasiswa;
    protected $minimalIpkSyarat;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Overriding Method (Tahap 5)
    public function hitungTagihanSemester() {
        // Logika Bisnis Prestasi: tarifUktNominal * 0.25 (Diskon 75%)
        return $this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Prestasi | Beasiswa: " . $this->namaInstansiBeasiswa . " | Syarat Minimal IPK: " . $this->minimalIpkSyarat;
    }

    // Method Query SELECT-WHERE (Tahap 4) yang mengambil koneksi dari class Database
    public static function getByNimPrestasi($nim) {
        $pdo = Database::getConnection(); // <--- Menggunakan akses database langsung
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}