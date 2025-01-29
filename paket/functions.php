<?php

require_once '../config.php';

function connect_db()
{
    $db = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    return $db;
}

function readAllPaket()
{
        $sql = connect_db()->query("SELECT paket.*, nomor_hp.nomor FROM paket LEFT JOIN nomor_hp ON paket.nomor_id = nomor_hp.id ORDER BY paket.waktu_beli DESC");

        if ($sql) {
            $data = array();
            while ($row = $sql->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "Gagal mengambil data nomor";
        }
}

function addPaket()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomor_id = $_POST['nomor_id'];
        $nama_paket = $_POST['nama_paket'];
        $masa = $_POST['masa'];
        $waktu_beli = $_POST['waktu_beli'];
        $waktu_abis = $_POST['waktu_abis'];
        $harga = $_POST['harga'];

        if (!empty($nomor_id) && !empty($nama_paket) && !empty($masa) && !empty($waktu_beli) && !empty($waktu_abis) && !empty($harga)) {
            $sql = connect_db()->query("INSERT INTO paket (nomor_id, nama_paket, masa, waktu_beli, waktu_abis, harga) VALUES ('$nomor_id', '$nama_paket', '$masa', '$waktu_beli', '$waktu_abis', '$harga')");

            if ($sql == TRUE) {
                header('Location: index.php');
                exit;
            } else {
                header('Location: tambah.php?&pesan="Gagal menambahkan data paket"');
                exit;
            }
        } else {
            header('Location: tambah.php?&pesan="Data tidak lengkap"');
            exit;
        }
    }
}

function getPaket()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];

        $pesan = '';

        if (!empty($id)) {
            $sql = connect_db()->query("SELECT * FROM paket WHERE id = '$id'");

            if ($sql == TRUE) {
                return $sql->fetch_assoc();
            } else {
                $pesan = "Gagal mengambil data";
            }

        }
        return $pesan;
    }
}
function getNomor() {
    $sql = connect_db()->query("SELECT id, nomor FROM nomor_hp");
    $data = [];

    while ($row = $sql->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function updatePaket()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nomor_id = $_POST['nomor_id'];
        $nama_paket = $_POST['nama_paket'];
        $masa = $_POST['masa'];
        $waktu_beli = $_POST['waktu_beli'];
        $waktu_abis = $_POST['waktu_abis'];
        $harga = $_POST['harga'];

        if (!empty($nomor_id) && !empty($nama_paket) && !empty($masa) && !empty($waktu_beli) && !empty($waktu_abis) && !empty($harga)) {
            $sql = connect_db()->query("UPDATE paket SET nomor_id = '$nomor_id', nama_paket = '$nama_paket', masa = '$masa', waktu_beli = '$waktu_beli', waktu_abis = '$waktu_abis', harga = '$harga' WHERE id = '$id'");

            if ($sql == TRUE) {
                header('Location: index.php');
                exit;
            } else {
                header('Location: tambah.php?&pesan="Gagal menambahkan data paket"');
                exit;
            }
        } else {
            header('Location: tambah.php?&pesan="Data tidak lengkap"');
            exit;
        }
    }
}

function deletePaket()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = connect_db()->query("DELETE FROM paket WHERE id = '$id'");

        if ($sql == TRUE) {
            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php?&pesan="Gagal menghapus data"');
            exit;
        }
    }
}