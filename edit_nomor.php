<?php
include 'header.php';
updateNomor();
$get_nomor = getEditNomor();
?>
<body>
    <h2>Edit Nomor</h2>
    <form method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <label for="nomor">Nama Paket:</label>
        <input type="text" name="nomor" id="nomor" value="<?php echo $get_nomor['nomor']; ?>"><br>

        <label for="provider">Provider:</label>
        <input type="text" name="provider" id="provider" value="<?php echo $get_nomor['provider']; ?>"><br>

        <button type="submit">Edit Nomor</button>
        <a href="nomor.php?user_id=<?php echo $user_id; ?>">Kembali</a>
    </form>
</body>
<?php 
include 'footer.php';
?>