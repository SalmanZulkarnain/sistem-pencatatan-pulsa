<?php
include '../header.php';
updatePaket();
$nomors = getNomor();
?>
<body>
    <h2>Edit Paket</h2>
    <form method="POST">    
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <label for="nomor_id">Nomor:</label>
        <select name="nomor_id" id="nomor_id">
            <option value="">Pilih Nomor</option>
            <?php foreach ($nomors as $nomor): ?>
                <option value="<?= $nomor['id']; ?>" <?php echo $nomor['id'] ? 'selected' : ''; ?>><?= $nomor['nomor']; ?></option>
            <?php endforeach; ?>
        </select> 

        <label for="nama_paket">Nama Paket:</label>
        <input type="text" name="nama_paket" id="nama_paket" value="<?php echo getPaket()['nama_paket'] ?>"><br>

        <label for="masa">Masa Berlaku (hari):</label>
        <input type="number" name="masa" id="masa" value="<?php echo getPaket()['masa'] ?>"><br>

        <label for="waktu_beli">Waktu Beli:</label>
        <input type="datetime-local" name="waktu_beli" id="waktu_beli" value="<?php echo getPaket()['waktu_beli'] ?>"><br>

        <label for="waktu_abis">Waktu Habis:</label>
        <input type="datetime-local" name="waktu_abis" id="waktu_abis" value="<?php echo getPaket()['waktu_abis'] ?>"><br>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" id="harga" value="<?php echo getPaket()['harga'] ?>"><br>

        .
        <button type="submit">Edit Paket</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
<?php 
include '../footer.php';
?>