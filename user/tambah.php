<?php 
include '../header.php';
addUser();
?>
<body>
    <h2>Tambah User</h2>
    <form method="POST">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama" placeholder="Masukkan nama kamu">
        
        <button type="submit">Tambah</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
<?php 
include '../footer.php';
?>