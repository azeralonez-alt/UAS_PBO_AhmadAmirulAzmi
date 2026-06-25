<?php
// File: Mahasiswa.php

abstract class Mahasiswa {
    protected $id_mahasiswa;
    protected $nama_mahasiswa;
    protected $nim;
    protected $semester;
    protected $tarifUktNominal;

    public function __construct($id_mahasiswa, $nama_mahasiswa, $nim, $semester, $tarifUktNominal) {
        $this->id_mahasiswa = $id_mahasiswa;
        $this->nama_mahasiswa = $nama_mahasiswa;
        $this->nim = $nim;
        $this->semester = $semester;
        $this->tarifUktNominal = $tarifUktNominal;
    }

    // =========================================================================
    //  WAJIB ADA: TAMBAHKAN EMBER/GETTER INI BIAR INDEX.PHP BISA BACA DATANYA
    // =========================================================================
    public function getNim() {
        return $this->nim;
    }

    public function getNamaMahasiswa() {
        return $this->nama_mahasiswa;
    }

    public function getSemester() {
        return $this->semester;
    }

    public function getTarifUktNominal() {
        return $this->tarifUktNominal;
    }

    // Metode Abstrak (sesuai tahap sebelumnya)
    abstract public function hitungTagihanSemester();
    abstract public function tampilkanSpesifikasiAkademik();
}