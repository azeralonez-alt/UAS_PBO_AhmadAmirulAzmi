<?php
// File: MahasiswaBidikmisi.php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    protected $nomorKipKuliah;
    protected $danaSakuSubsidi;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $nomorKipKuliah, $danaSakuSubsidi) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->nomorKipKuliah = $nomorKipKuliah;
        $this->danaSakuSubsidi = $danaSakuSubsidi;
    }

    // =========================================================================
    // OVERRIDING METHOD TAHAP 5
    // =========================================================================
    public function hitungTagihanSemester() {
        // Digratiskan penuh dari tagihan karena skema KIP-Kuliah
        return 0;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Bidikmisi | No KIP-K: " . $this->nomorKipKuliah . " | Dana Saku/Bulan: Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.');
    }

    public static function getByNimBidikmisi($pdo, $nim) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}