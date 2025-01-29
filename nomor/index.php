<?php
include '../header.php';
if (isset($_GET['id'])) {
    deleteNomor();
}
?>

<body>
    <a href="tambah.php">Tambah</a>
    <a href="../paket/index.php">Paket</a>
    <a href="../user/index.php">Kembali</a>
    <table border=1 cellspacing=0 cellpadding=10>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Nomor HP</th>
                <th>Provider</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count(readAllNomor()) >= 0) : ?>
                <?php $no = 1; foreach(readAllNomor() as $nomor_hp) : ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $nomor_hp['nama']; ?></td>
                <td><?php echo $nomor_hp['nomor']; ?></td>
                <td><?php echo $nomor_hp['provider']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $nomor_hp['id']; ?>">Edit</a> |
                    <a href="index.php?id=<?php echo $nomor_hp['id']; ?>" onclick="return confirm('Yakin ingin menghapus pemasok ini?')">Hapus</a> 
                </td>
            </tr>
                <?php $no++; endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
<?php
include '../footer.php';
?>