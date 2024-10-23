<?php 
include 'header.php';
deleteUser();

if (isset($_GET['id'])) {
    deletePaket();
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $paketData = viewPaket($user_id);
} else {
    echo "User ID tidak ditemukan!";
    exit;
}
?>
<body>
<a href="tambah_paket.php?user_id=<?php echo $user_id; ?>">Tambah Paket</a>
<a href="index.php">Kembali</a> 
    <table border=1 cellspacing=0 cellpadding=10>
        <thead>
            <tr>
                <th>No.</th>
                <th>Provider</th>
                <th>Nama Paket</th>
                <th>Masa Aktif</th>
                <th>Harga</th>
                <th>Waktu Beli</th>
                <th>Waktu Habis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
    if($paketData && is_array($paketData) && count($paketData) > 0) { 
        $no = 1; 
        foreach($paketData as $paket) : 
    ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $paket['provider']; ?></td>
                <td><?php echo $paket['nama_paket']; ?></td>
                <td><?php echo $paket['masa']; ?></td>
                <td>Rp<?php echo number_format($paket['harga']); ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($paket['waktu_beli'])); ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($paket['waktu_abis'])); ?></td>
                <td><a href="pulsa.php?user_id=<?php echo $user_id; ?>" onclick="return confirm('Yakin ingin menghapus paket ini?')">Hapus</a> |
                    <a href="edit_paket.php?user_id=<?php echo $user_id; ?>&id=<?php echo $paket['id']; ?>">Edit</a></td> 
            </tr>
        <?php $no++; endforeach; ?>
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