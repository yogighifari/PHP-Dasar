<?php
session_start();
//kalau tidak ada session login maka lempar kembali ke halaman login/ kembalikan user ke halaman login
if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
//cek apakah tombol php pernah dipencet atau belum
require 'functions.php';
if (isset($_POST["submit"]))

//cek apakah data berhasil ditambahkan atau tidak
{
    if (tambah($_POST)>0){
        echo "
        <script> 
        alert('data berhasil ditambahkan');
        document.location.href = 'index.php';
        </script>
        ";
    }
    else {echo  "
        <script> 
        alert('data GAGAL ditambahkan');
        document.location.href = 'index.php';
        </script>
        ";
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data"> <!--enctype adalah fungsi untuk jalur file-->
    <ul>
        <li>
        <label for="NIM">NIM :</label>
        <input type="text" name="NIM" id="NIM"
        required>
        </li>
        <li>
        <label for="Nama">Nama :</label>
        <input type="text" name="Nama" id="Nama" required>
        </li>
        <li>
        <label for="Email">Email :</label>
        <input type="text" name="Email" id="Email" required>
        </li>
        <li>
        <label for="Jurusan">Jurusan :</label>
        <input type="text" name="Jurusan" id="Jurusan" required>
        </li>
        <li>
        <label for="Gambar">Gambar :</label>
        <input type="file" name="Gambar" id="Gambar">
        </li>
        <li>
            <button type="submit" name="submit">Tambah Data </button>
        </li>
    </ul>
    </form>
</body>
</html>