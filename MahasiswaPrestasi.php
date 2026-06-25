<?php
// File: MahasiswaPrestasi.php
require_once 'Mahasiswa.php'; // Menghubungkan ke file kelas induk

class MahasiswaPrestasi extends Mahasiswa {
    // Properti tambahan spesifik
    protected $namaInstansiBeasiswa;
    protected $minimalIpkSyarat;

    // Constructor untuk inisialisasi properti induk dan anak
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal, $namaInstansiBeasiswa, $minimalIpkSyarat) {
        parent::__construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal);
        $this->namaInstansiBeasiswa = $namaInstansiBeasiswa;
        $this->minimalIpkSyarat = $minimalIpkSyarat;
    }

    // Implementasi abstract method hitungTagihanSemester
    public function hitungTagihanSemester() {
        // Contoh logika bisnis: Mendapatkan potongan tagihan sebesar 50%
        return $this->tarifUktNominal * 0.5;
    }

    // Implementasi abstract method tampilkanSpesifikasiAkademik
    public function tampilkanSpesifikasiAkademik() {
        return "Jenis Pembiayaan: Prestasi | Beasiswa: " . $this->namaInstansiBeasiswa . " | Syarat Minimal IPK: " . $this->minimalIpkSyarat;
    }

    // Method berisi query SELECT-WHERE spesifik kategori Prestasi
    public static function getByNimPrestasi($pdo, $nim) {
        $sql = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi' AND nim = :nim";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}