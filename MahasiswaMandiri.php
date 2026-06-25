<?php
// File: MahasiswaMandiri.php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    protected $golonganUkt;
    protected $namaWali;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWali) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // =========================================================================
    // OVERRIDING METHOD TAHAP 5
    // =========================================================================
    public function hitungTagihanSemester() {
        // Tarif UKT Nominal + Rp 100.000 (biaya operasional kemahasiswaan/praktikum flat)
        return $this->tarifUktNominal + 100000;
    }

    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Mandiri | Golongan UKT: " . $this->golonganUkt . " | Nama Wali: " . $this->namaWali;
    }

    public static function getByNimMandiri($pdo, $nim) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}