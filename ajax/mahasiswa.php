<?php
//sleep(1);
//usleep(10000);
require '../functions.php';
$keyword = $_GET["keyword"]; // menangkap data keyword


$query = "SELECT * FROM mahasiswa WHERE 
Nama LIKE '%$keyword%' OR
NIM LIKE  '%$keyword%' OR
Email LIKE '%$keyword%' OR
Jurusan LIKE '%$keyword%'
";

$mahasiswa = query($query);
?>
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
    <td>
        <img src="img/<?= $row["Gambar"]; ?>" width="50" alt="">
    </td>

    <td><?= $row["NIM"]; ?></td>
    <td><?= $row["Nama"]; ?></td>
    <td><?= $row["Email"]; ?></td>
    <td><?= $row["Jurusan"]; ?></td>

</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>