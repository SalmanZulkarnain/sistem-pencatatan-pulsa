<?php
include '../header.php';
updateNomor();
$users = getUser();
?>
<body>
    <h2>Edit Nomor</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo getNomor()['id']; ?>">

        <label for="user_id">User:</label>
        <select name="user_id" id="user_id">
            <option value="">Pilih User</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id']; ?>" <?php echo $user['id'] ? 'selected' : ''; ?>><?= $user['nama']; ?></option>
            <?php endforeach; ?>
        </select> 

        <label for="nomor">Nomor:</label>
        <input type="text" name="nomor" id="nomor" value="<?php echo getNomor()['nomor']; ?>"><br>

        <label for="provider">Provider:</label>
        <input type="text" name="provider" id="provider" value="<?php echo getNomor()['provider']; ?>"><br>

        <button type="submit">Edit Nomor</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
<?php 
include '../footer.php';
?>