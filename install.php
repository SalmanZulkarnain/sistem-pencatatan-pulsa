<?php 

require_once 'config.php';

$db = new mysqli(HOSTNAME, USERNAME, PASSWORD);

// 1. cek koneksi
if ($db->connect_error) {
    echo "Gagal konek";
}

// 2. buat database
$sql_buat_db = "CREATE DATABASE IF NOT EXISTS db_pencatatan_pulsa";
$eksekusi_buat_db = $db->query($sql_buat_db);

if(!$eksekusi_buat_db) {
    echo "Buat db pencatatan pulsa gagal" . '<br>';
}

// 3. masuk db pencatatan pulsa
$sql_masuk_db = "USE db_pencatatan_pulsa";
$db->query($sql_masuk_db);

// 4. Tabel users (untuk data user)
$table_users = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL
);";
$db->query($table_users);

// 5. Tabel nomor_hp (untuk menyimpan nomor-nomor HP per user)
$table_nomor = "CREATE TABLE nomor_hp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nomor VARCHAR(15) NOT NULL,
    provider VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);";
$db->query($table_nomor);

// 6. Tabel paket (untuk transaksi per nomor)
$table_paket = "CREATE TABLE paket (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomor_id INT,
    nama_paket VARCHAR(100) NOT NULL,
    masa INT NOT NULL,
    waktu_beli DATETIME NOT NULL,
    waktu_abis DATETIME,
    harga INT NOT NULL,
    FOREIGN KEY (nomor_id) REFERENCES nomor_hp(id) 
);";
$db->query($table_paket);

// $db->query('DROP DATABASE db_pencatatan_pulsa');

$db->close();

