<?php

require_once 'config.php';

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

function viewNomor($user_id)
{
    if (!empty($user_id)) {
        $sql = connect_db()->query("SELECT * FROM nomor_hp WHERE user_id = '$user_id'");

        if ($sql) {
            $data = array();
            while ($row = $sql->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "Gagal mengambil data nomor";
        }
    } else {
        return "User ID tidak boleh kosong";
    }
}

function takeProvider($user_id) {
    $db = connect_db();
    $sql = "SELECT id, provider FROM nomor_hp WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function viewPaket($user_id)
{
    if (!empty($user_id)) {
        $sql = connect_db()->query("SELECT paket.*, nomor_hp.provider FROM paket JOIN nomor_hp ON paket.nomor_id = nomor_hp.id WHERE nomor_hp.user_id = '$user_id' ORDER BY paket.waktu_beli DESC");

        if ($sql) {
            $data = array();
            while ($row = $sql->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "Gagal mengambil data nomor";
        }
    } else {
        return "User ID tidak boleh kosong";
    }
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

function addPaket()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db = connect_db();
        
        $user_id = $_POST['user_id'];
        $nomor_id = $_POST['nomor_id'];
        $nama_paket = $_POST['nama_paket'];
        $masa = $_POST['masa'];
        $waktu_beli = $_POST['waktu_beli'];
        $waktu_abis = $_POST['waktu_abis'];
        $harga = $_POST['harga'];

        if (!empty($user_id) && !empty($nomor_id) && !empty($nama_paket) && !empty($masa) && !empty($waktu_beli) && !empty($harga)) {
            $sql = "INSERT INTO paket (nomor_id, nama_paket, masa, waktu_beli, waktu_abis, harga) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt = $db->prepare($sql);
            $stmt->bind_param("isissi", $nomor_id, $nama_paket, $masa, $waktu_beli, $waktu_abis, $harga);
            
            if ($stmt->execute()) {
                header('Location: pulsa.php?user_id=' . $user_id);
                exit;
            } else {
                header('Location: tambah_paket.php?user_id=' . $user_id . '&pesan=Gagal menambahkan data paket');
                exit;
            }
        } else {
            header('Location: tambah_paket.php?user_id=' . $user_id . '&pesan=Data tidak lengkap');
            exit;
        }
    }
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
                header('Location: nomor.php?user_id=' . $user_id);
                exit;
            } else {
                header('Location: tambah_nomor.php?user_id=' . $user_id . '&pesan="Gagal menambahkan data paket"');
                exit;
            }
        } else {
            header('Location: tambah_nomor.php?user_id=' . $user_id . '&pesan="Data tidak lengkap"');
            exit;
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

function getEditPaket()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];

        if (!empty($id)) {
            $sql = connect_db()->query("SELECT * FROM paket WHERE id = '$id'");

            if ($sql == TRUE) {
                return $sql->fetch_assoc();
            } else {
                $pesan = "Gagal mengambil data";
            }
        }
    }
}
function getEditNomor()
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];

        if (!empty($id)) {
            $sql = connect_db()->query("SELECT * FROM nomor_hp WHERE id = '$id'");

            if ($sql == TRUE) {
                return $sql->fetch_assoc();
            }
        }
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

function updatePaket()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $user_id = $_POST['user_id'];
        $nama_paket = $_POST['nama_paket'];
        $masa = $_POST['masa'];
        $waktu_beli = $_POST['waktu_beli'];
        $waktu_abis = $_POST['waktu_abis'];
        $harga = $_POST['harga'];

        if (!empty($user_id) && !empty($nama_paket) && !empty($masa) && !empty($waktu_beli) && !empty($harga) && !empty($id)) {

            $sql = connect_db()->query("UPDATE paket SET user_id = '$user_id', nama_paket = '$nama_paket', masa = '$masa', waktu_beli = '$waktu_beli', waktu_abis = '$waktu_abis', harga = '$harga' WHERE id = '$id'");

            if ($sql == TRUE) {
                header('Location: pulsa.php?user_id=' . $user_id);
                exit;
            } else {
                header('Location: edit_paket.php?user_id=' . $user_id . '&pesan="Gagal mengupdate data user"');
                exit;
            }
        }
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
                header('Location: nomor.php?user_id=' . $user_id);
                exit;
            } else {
                header('Location: edit_nomor.php?user_id=' . $user_id . '&pesan="Gagal mengupdate data user"');
                exit;
            }
        }
    }
}

function deleteUser()
{
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];

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

function deletePaket()
{
    if (isset($_GET['id']) && isset($_GET['user_id'])) {
        $id = $_GET['id'];
        $user_id = $_GET['user_id'];

        $sql = connect_db()->query("DELETE FROM paket WHERE id = '$id'");

        if ($sql == TRUE) {
            header('Location: pulsa.php?user_id=' . $user_id);
            exit;
        } else {
            header('Location: pulsa.php?user_id=' . $user_id . '&pesan="Gagal menghapus data"');
            exit;
        }
    }
}

function deleteNomor()
{
    if (isset($_GET['id']) && isset($_GET['user_id'])) {
        $id = $_GET['id'];
        $user_id = $_GET['user_id'];

        $sql = connect_db()->query("DELETE FROM nomor_hp WHERE id = '$id'");

        if ($sql == TRUE) {
            header('Location: nomor.php?user_id=' . $user_id);
            exit;
        } else {
            header('Location: nomor.php?user_id=' . $user_id . '&pesan="Gagal menghapus data"');
            exit;
        }
    }
}