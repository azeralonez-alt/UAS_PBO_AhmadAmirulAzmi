<?php
// File: MahasiswaMandiri.php
require_once 'Mahasiswa.php';
require_once 'koneksi/database.php'; // <--- MEMBERIKAN AKSES KONEKSI DATABASE

class MahasiswaMandiri extends Mahasiswa {
    protected $golonganUkt;
    protected $namaWali;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // Overriding Method (Tahap 5)
    public function hitungTagihanSemester() {
        // Logika Bisnis Mandiri: tarifUktNominal + 100000
        return $this->tarifUktNominal + 100000;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Mandiri | Golongan UKT: " . $this->golonganUkt . " | Nama Wali: " . $this->namaWali;
    }

    // Method Query SELECT-WHERE (Tahap 4) yang mengambil koneksi dari class Database
    public static function getByNimMandiri($nim) {
        $pdo = Database::getConnection(); // <--- Menggunakan akses database langsung
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}