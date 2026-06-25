<?php
// File: MahasiswaBidikmisi.php
require_once 'Mahasiswa.php';
require_once 'koneksi/database.php'; // <--- MEMBERIKAN AKSES KONEKSI DATABASE

class MahasiswaBidikmisi extends Mahasiswa {
    protected $nomorKipKuliah;
    protected $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // Overriding Method (Tahap 5)
    public function hitungTagihanSemester() {
        // Logika Bisnis Bidikmisi: Gratis (0)
        return 0;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Bidikmisi | No KIP-K: " . $this->nomorKipKuliah . " | Dana Saku/Bulan: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    // Method Query SELECT-WHERE (Tahap 4) yang mengambil koneksi dari class Database
    public static function getByNimBidikmisi($nim) {
        $pdo = Database::getConnection(); // <--- Menggunakan akses database langsung
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}