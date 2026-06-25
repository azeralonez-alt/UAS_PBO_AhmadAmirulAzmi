<?php
// File: Mahasiswa.php

abstract class Mahasiswa {
    // Properti/Atribut Terenkapsulasi (protected)
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;

    // Constructor Induk
    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // Metode Abstrak (Wajib di-overriding oleh kelas anak)
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();
}