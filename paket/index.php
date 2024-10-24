<?php
include '../header.php';
deletePaket();
?>

<body>
    <a href="tambah.php">Tambah Paket</a>
    <a href="../nomor/index.php">Nomor</a>
    <a href="../nomor/index.php">Kembali</a>
    <table border=1 cellspacing=0 cellpadding=10>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nomor</th>
                <th>Nama Paket</th>
                <th>Masa Aktif</th>
                <th>Harga</th>
                <th>Waktu Beli</th>
                <th>Waktu Habis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count(readAllPaket()) >= 0) : ?>
            <?php $no = 1; foreach(readAllPaket() as $paket) : ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $paket['nomor']; ?></td>
                        <td><?php echo $paket['nama_paket']; ?></td>
                        <td><?php echo $paket['masa']; ?></td>
                        <td>Rp<?php echo number_format($paket['harga']); ?></td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($paket['waktu_beli'])); ?></td>
                        <td><?php echo date('d-m-Y H:i:s', strtotime($paket['waktu_abis'])); ?></td>
                        <td><a href="edit.php?id=<?php echo $paket['id']; ?>">Edit</a> | 
                            <a href="index.php?id=<?php echo $paket['id']; ?>" onclick="return confirm('Yakin ingin menghapus paket ini?')">Hapus</a> 

                            
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