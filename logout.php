<?php
session_start();
session_unset();
session_destroy();
setcookie('id','', time() -3600); //untuk hapus cookie baca dokumentasi
setcookie('key','', time() -3600);  //untuk hapus cookie baca dokumentasi
header("Location: login.php");
exit;
?>