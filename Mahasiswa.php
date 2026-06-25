<?php

// Membuat abstract class bernama Mahasiswa
abstract class Mahasiswa {
    
    // Properti/Atribut Terenkapsulasi (protected)
    // Dipetakan dari kolom database Tahap 1
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal; // CamelCase sesuai instruksi soal, memetakan tarif_ukt_nominal dari DB

    // Constructor untuk memetakan nilai dari database secara pas saat objek dibuat
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // Metode Abstrak (Tanpa Isi/Body)
    // Wajib diimplementasikan oleh setiap class anak (Mandiri, Bidikmisi, Prestasi)
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();
}