<?php 
include 'header.php';
addNomor();
?>
<body>
<form action="tambah_nomor.php" method="POST">
    <input type="hidden" name="user_id" value="<?php echo $_GET['user_id']; ?>">
    
    <label for="nomor">Nomor HP:</label>
    <input type="text" name="nomor" id="nomor"><br>

    <label for="provider">Provider:</label>
    <input type="text" name="provider" id="provider"><br>

    <button type="submit" name="submit">Tambah Nomor</button>
    <a href="nomor.php?user_id=<?php echo $_GET['user_id']; ?>">Kembali</a>
</form>
</body>
<?php 
include 'header.php';
?>