<?php
include 'header.php';
if (isset($_GET['id'])) {
    deleteNomor();
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $nomor_hp = viewNomor($user_id);
} else {
    echo "User ID tidak ditemukan!";
    exit;
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $paket = viewPaket($user_id);
} else {
    echo "User ID tidak ditemukan!";
    exit;
}
?>

<body>
    <a href="tambah_nomor.php?user_id=<?php echo $user_id; ?>">Tambah Nomor</a>
    <a href="pulsa.php?user_id=<?php echo $user_id; ?>">Detail</a>
    <a href="index.php">Kembali</a>
    <table border=1 cellspacing=0 cellpadding=10>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor HP</th>
                <th>Provider</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count(viewNomor($user_id)) > 0) { ?>
                <?php $no = 1;
                foreach (viewNomor($user_id) as $nomor): ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $nomor['nomor']; ?></td>
                        <td><?php echo $nomor['provider']; ?></td>
                        <td><a href="nomor.php?user_id=<?php echo $user_id; ?>&id=<?php echo $nomor['id']; ?>"
                                onclick="return confirm('Yakin ingin menghapus paket ini?')">Hapus</a> |
                            <a href="edit_nomor.php?user_id=<?php echo $user_id; ?>&id=<?php echo $nomor['id']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="7" style="text-align: center;">TIDAK ADA DATA</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
<?php
include 'footer.php';
?>