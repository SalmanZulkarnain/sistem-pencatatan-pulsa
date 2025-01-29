<?php

require_once '../config.php';

function connect_db()
{
    $db = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    return $db;
}

function readAllNomor()
{
    $sql = connect_db()->query("SELECT nomor_hp.*, users.nama FROM nomor_hp LEFT JOIN users ON nomor_hp.user_id = users.id");

    $data = array();
    while ($row = $sql->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addNomor()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_POST['user_id'];
        $nomor = $_POST['nomor'];
        $provider = $_POST['provider'];

        if (!empty($user_id) && !empty($nomor) && !empty($provider)) {
            $sql = connect_db()->query("INSERT INTO nomor_hp (user_id, nomor, provider) VALUES ('$user_id', '$nomor', '$provider')");

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

function getUser() {
    $sql = connect_db()->query("SELECT id, nama FROM users");
    $data = [];

    while ($row = $sql->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function getNomor()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];

        $pesan = '';

        if (!empty($id)) {
            $sql = connect_db()->query("SELECT * FROM nomor_hp WHERE id = '$id'");

            if ($sql == TRUE) {
                return $sql->fetch_assoc();
            } else {
                $pesan = "Gagal mengambil data";
            }

        }
        return $pesan;
    }
}

function updateNomor()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $nomor = $_POST['nomor'];
        $provider = $_POST['provider'];

        if (!empty($user_id) && !empty($nomor) && !empty($provider) && !empty($id)) {

            $sql = connect_db()->query("UPDATE nomor_hp SET user_id = '$user_id', nomor = '$nomor', provider = '$provider' WHERE id = '$id'");

            if ($sql == TRUE) {
                header('Location: index.php');
                exit;
            } else {
                header('Location: edit.php?pesan="Gagal mengupdate data"');
                exit;
            }
        }
    }
}

function deleteNomor()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = connect_db()->query("DELETE FROM nomor_hp WHERE id = '$id'");

        if ($sql == TRUE) {
            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php?&pesan="Gagal menghapus data"');
            exit;
        }
    }
}