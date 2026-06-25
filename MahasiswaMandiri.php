<?php
// File: MahasiswaMandiri.php
require_once 'Mahasiswa.php'; // Menghubungkan ke file kelas induk

class MahasiswaMandiri extends Mahasiswa {
    // Properti tambahan spesifik
    protected $golonganUkt;
    protected $namaWali;

    // Constructor untuk inisialisasi properti induk dan anak
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $golonganUkt, $namaWali) {
        // Melempar atribut global ke constructor kelas induk
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->golonganUkt = $golonganUkt;
        $this->namaWali = $namaWali;
    }

    // Implementasi abstract method hitungTagihanSemester
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal; // Membayar full sesuai nominal UKT awal
    }

    // Implementasi abstract method tampilkanSpesifikasiAkademik
    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Mandiri | Golongan UKT: " . $this->golonganUkt . " | Nama Wali: " . $this->namaWali;
    }

    // Method berisi query SELECT-WHERE spesifik kategori Mandiri
    public static function getByNimMandiri($pdo, $nim) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}