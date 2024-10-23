<?php
include 'header.php';
getEdit();
updateUser();
?>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo getEdit()['id']; ?>">

        <label for="nama">Nama:</label>
        <input type="text" name="nama" placeholder="Masukkan nama kamu" value="<?php echo getEdit()['nama']; ?>">
        
        <button type="submit">Edit</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
<?php 
include 'footer.php';
?>