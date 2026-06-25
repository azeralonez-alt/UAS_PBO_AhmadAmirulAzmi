<?php
// File: koneksi/database.php

class Database {
    private static $host = "localhost";
    private static $username = "root"; // Sesuaikan dengan username MySQL-mu (default: root)
    private static $password = "";     // Sesuaikan dengan password MySQL-mu (default: kosong)
    private static $db_name = "DB_UAS_PBO_TI1D_AhmadAmirulAzmi";
    private static $conn = null;

    // Method Static untuk mengambil koneksi PDO
    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name, 
                    self::$username, 
                    self::$password
                );
                // Set error mode ke exception untuk mempermudah debugging
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Koneksi Database Gagal: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}