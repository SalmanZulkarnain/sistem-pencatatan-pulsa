<?php 
include '../header.php';
deleteUser();
?>
<body>
    <a href="tambah.php">Tambah User</a>
    <a href="../nomor/index.php">Nomor</a>  
    <table border=1 cellspacing=0 cellpadding=10>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count(viewUser()) >= 0) : ?>
                <?php $no = 1; foreach(viewUser() as $user) : ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $user['nama']; ?></td>
                <td><a href="index.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a> |
                    <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a> 
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