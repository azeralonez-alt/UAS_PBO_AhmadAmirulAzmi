<?php
// File: MahasiswaBidikmisi.php
require_once 'Mahasiswa.php'; // Menghubungkan ke file kelas induk

class MahasiswaBidikmisi extends Mahasiswa {
    // Properti tambahan spesifik
    protected $nomorKipKuliah;
    protected $danaSakuSubsidi;

    // Constructor untuk inisialisasi properti induk dan anak
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // Implementasi abstract method hitungTagihanSemester
    public function hitungTagihanSemester() {
        return 0; // Kategori Bidikmisi dibebaskan biaya UKT (Rp 0)
    }

    // Implementasi abstract method tampilkanSpesifikasiAkademik
    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Bidikmisi | No KIP-K: " . $this->nomorKipKuliah . " | Dana Saku/Bulan: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    // Method berisi query SELECT-WHERE spesifik kategori Bidikmisi
    public static function getByNimBidikmisi($pdo, $nim) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}