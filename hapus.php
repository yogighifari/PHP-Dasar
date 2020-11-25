<?php
session_start();
//kalau tidak ada session login maka lempar kembali ke halaman login/ kembalikan user ke halaman login
if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

if (hapus($id)>0){
    echo "
    <script> 
    alert('data berhasil diHAPUS');
    document.location.href = 'index.php';
    </script>
    ";
}
else {echo  "
    <script> 
    alert('data GAGAL DIHAPUS');
    document.location.href = 'index.php';
    </script>
    ";
}

?>