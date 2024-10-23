<?php 
include 'header.php';
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $providers = takeProvider($user_id);
} else {
    header('Location: index.php');
    exit;
}
addPaket();
?>
<body>
<form action="tambah_paket.php?user_id=<?php echo $user_id; ?>" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">

    <select name="nomor_id">
        <?php foreach($providers as $provider) : ?>
        <option value="<?php echo $provider['id']; ?>"><?php echo $provider['provider']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="nama_paket">Nama Paket:</label>
    <input type="text" name="nama_paket" id="nama_paket"><br>

    <label for="masa">Masa Berlaku (hari):</label>
    <input type="number" name="masa" id="masa"><br>

    <label for="waktu_beli">Waktu Beli:</label>
    <input type="datetime-local" name="waktu_beli" id="waktu_beli"><br>

    <label for="waktu_abis">Waktu Habis:</label>
    <input type="datetime-local" name="waktu_abis" id="waktu_abis"><br>

    <label for="harga">Harga:</label>
    <input type="number" name="harga" id="harga"><br>

    <button type="submit" name="submit">Tambah Paket</button>
    <a href="pulsa.php?user_id=<?php echo $_GET['user_id']; ?>">Kembali</a>
</form>
</body>
<?php 
include 'header.php';
?>