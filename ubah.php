<?php
session_start();
//kalau tidak ada session login maka lempar kembali ke halaman login/ kembalikan user ke halaman login
if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
//cek apakah tombol php pernah dipencet atau belum
require 'functions.php';

$id =$_GET["id"];

//fungsi ini untuk menampilkan seluruh isi dari data mahasiswa tersebut
$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


if (isset($_POST["submit"])){

    //CEK APAKAH DATA BERHASIL DI UBAH
    if (ubah($_POST)>0){
        echo "
        <script> 
        alert('data berhasil ubah');
        document.location.href = 'index.php';
        </script>
        ";
    }
    else {echo  "
        <script> 
        alert('data gagal ubah');
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
    <title>update Data Mahasiswa</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form  method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs["id"];?>">
        <input type="hidden" name="gambarLama" value="<?= $mhs["Gambar"];?>">
    <ul>
        <li>
        <label for="NIM">NIM :</label>
        <input type="text" name="NIM" id="NIM"  value="<?= $mhs["NIM"];?>">
        </li>
        <li>
        <label for="Nama">Nama :</label>
        <input type="text" name="Nama" id="Nama"  value="<?= $mhs["Nama"];?>">
        </li>
        <li>
        <label for="Email">Email :</label>
        <input type="text" name="Email" id="Email"   value="<?= $mhs["Email"];?>" >
        </li>
        <li>
        <label for="Jurusan">Jurusan :</label>
        <input type="text" name="Jurusan" id="Jurusan"  value="<?= $mhs["Jurusan"];?>">
        </li>
        <li>
        <label for="Gambar">Gambar :</label> <br>
        <img src="img/<?=$mhs['Gambar'];?>" alt="" width="40"> <br>
        <input type="file" name="Gambar" id="Gambar">
        </li>
        <li>
            <button type="submit" name="submit">Update Data </button>
        </li>
    </ul>
    </form>
</body>
</html>