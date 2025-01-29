<?php

require_once '../config.php';

function connect_db()
{
    $db = new mysqli(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    return $db;
}

function viewUser()
{
    $sql = connect_db()->query("SELECT * FROM users");

    $data = array();
    while ($row = $sql->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}

function addUser()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama = $_POST['nama'];

        if (!empty($nama)) {
            $sql = connect_db()->query("INSERT INTO users (nama) VALUES ('$nama')");

            if ($sql == TRUE) {
                header('Location: index.php');
                exit;
            } else {
                header('Location: tambah_user.php?pesan="Gagal menambahkan data user"');
                exit;
            }
        }
    }
}

function getEdit()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];

        $pesan = '';

        if (!empty($id)) {
            $sql = connect_db()->query("SELECT * FROM users WHERE id = '$id'");

            if ($sql == TRUE) {
                return $sql->fetch_assoc();
            } else {
                $pesan = "Gagal mengambil data";
            }

        }
        return $pesan;
    }
}

function updateUser()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $nama = $_POST['nama'];

        if (!empty($nama) && !empty($id)) {
            $sql = connect_db()->query("UPDATE users SET nama = '$nama' WHERE id = '$id'");

            if ($sql == TRUE) {
                header('Location: index.php');
                exit;
            } else {
                header('Location: edit_user.php?pesan="Gagal mengupdate data user"');
                exit;
            }
        }
    }
}


function deleteUser()
{
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = connect_db()->query("DELETE FROM users WHERE id = '$id'");

        if ($sql == TRUE) {
            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php?pesan="Gagal menghapus data"');
            exit;
        }
    }
}