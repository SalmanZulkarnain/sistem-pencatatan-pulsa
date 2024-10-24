<?php 
include '../header.php';
addNomor();
$users = getUser();
?>
<body>
<form method="POST">

    <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            <option value="">Pilih User</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id']; ?>" <?php echo $user['id'] ? 'selected' : ''; ?>><?= $user['nama']; ?></option>
            <?php endforeach; ?>
        </select> 
    <label for="nomor">Nomor HP:</label>
    <input type="text" name="nomor" id="nomor"><br>

    <label for="provider">Provider:</label>
    <input type="text" name="provider" id="provider"><br>

    <button type="submit" name="submit">Tambah Nomor</button>
    <a href="index.php">Kembali</a>
</form>
</body>
<?php 
include '../header.php';
?>