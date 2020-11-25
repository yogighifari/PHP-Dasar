<?php
session_start();
//kalau tidak ada session login maka lempar kembali ke halaman login/ kembalikan user ke halaman login
if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';

/**
 //PAGENATION 
//configurasi pagination
$jmlDataPerHal = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa")); // count digunakan untuk menghitung ada berapa element didalam array assoc
//$jumlahHal = round($jumlahData / $jmlDataPerHal); // fungsi round untuk membulatkan ke desimal terdekat
//$jumlahHal = floor($jumlahData / $jmlDataPerHal); // fungsi floor untuk membulatkan ke bawah
$jumlahHal = ceil($jumlahData / $jmlDataPerHal); // fungsi ceil untuk membulatkan ke atas
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1; // operator ternary, ? apabila kondisi true : kondisi false ;
//untuk parsing data pada setiap halaman
$awalData = ($jmlDataPerHal * $halamanAktif)-$jmlDataPerHal;
// mengambil data dari tabel mahasiswa didatabase
$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData,$jmlDataPerHal"); // 1 adalah mulai dari data ke berapa dari database, param 2 berapa data yang ingin ditampilkan
*/

$mahasiswa = query("SELECT * FROM mahasiswa");
if (isset($_POST['search']))
{
    $mahasiswa = search($_POST['keyword']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        .loader{
            width: 21px;
            position: absolute;
            top: 173px;
            z-index: -1;
            right: 400px;
            display: none;
        }

        @media print{
            .logout{
                display: none;
            }
        }
    </style>
    <script src="js/jquery-3.5.1.min.js"></script>
<script src="js/isi.js"></script>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <a href="logout.php" class="logout">LOG OUT</a> | <a href="cetak.php" target="_blank">Print</a>
<br><br>

<a href="tambah.php">Tambah Data Mahasiswa</a>
<br><br><br>

<form action="" method="post">
<input type="text" name="keyword" size="50" autofocus 
placeholder="masukan keyword pencarian" autocomplete="off" id="keyword">
<button type="submit" name="search" id="tombol-cari">Search</button>
<img src="img/source.gif" class="loader">

</form>

<?php
/** 
<!-- PAGENATION HARUS DI OPTIMASI DISESUAIKAN DENGAN SEARCH -->
<?php if($halamanAktif > 1): ?>
<a href="?halaman=<?= $halamanAktif - 1;?>">&lt;</a> 
<!--lt dalah lebih kecil -->
<?php endif; ?>
<?php for($i = 1; $i<= $jumlahHal; $i++) : ?>
    <?php if($i == $halamanAktif) : ?>

<a href="?halaman=<?= $i; ?> " style="font-weight: bold; color: red;"> <?= $i; ?> </a>
<?php else : ?>
    <a href="?halaman=<?= $i; ?> "> <?= $i; ?> </a>    

<?php endif; ?>

<?php endfor;?>
<?php if($halamanAktif < $jumlahHal): ?>
<a href="?halaman=<?= $halamanAktif +1;?>">&gt;</a>
<!--gt adalah lebih besar -->
<?php endif; ?>
*/
?>

<div id="container">
<br><br>
<table border="" cellpadding="5" cellspacing="0">
    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jurusan</th>
    </tr>

<?php $i=1; ?>
<?php foreach ($mahasiswa as $row) : ?>
<tr>
    <td><?= $i; ?></td>
    <td>
        <a href="ubah.php?id=<?= $row["id"];?>">Ubah</a> | 
        <a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('Anda akan menghapus data ini ?');">Hapus</a>
    </td>
    <td><img src="img/<?= $row["Gambar"]; ?>" width="50" alt=""></td>
    <td><?= $row["NIM"]; ?></td>
    <td><?= $row["Nama"]; ?></td>
    <td><?= $row["Email"]; ?></td>
    <td><?= $row["Jurusan"]; ?></td>

</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>
</div>


</body>
</html>