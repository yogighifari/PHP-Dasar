<?php
$conn = mysqli_connect("localhost","root","","phpdasar");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
    
        $rows[] = $row;
    }
return $rows;
}

function tambah($data){
global $conn;
    $NIM = htmlspecialchars($data["NIM"]) ;
    $Nama = htmlspecialchars($data["Nama"]);
    $Jurusan = htmlspecialchars($data["Jurusan"]);
    $Email = htmlspecialchars($data["Email"]);
//jalankan fungsi upload gambar
$Gambar = upload();
if (!$Gambar){
    return false;
} 

    
    //query insert data
    $query = "INSERT INTO mahasiswa
            VALUES
            ('',' $Nama','$NIM',' $Email','$Jurusan','$Gambar')";
    mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function upload(){    
    $namaFile = $_FILES["Gambar"]['name'];
    $ukuranFile = $_FILES["Gambar"]["size"];
    $errorFile =$_FILES["Gambar"]["error"];
    $tmpName = $_FILES["Gambar"]["tmp_name"];

    if ($errorFile === 4)
    {    echo "
        <script> 
        alert('Upload Gambar !');
        </script>
        ";
    return false;}
$ekstensiGambarValid =['jpg', 'jpeg','png'];
$ekstensiGambar = explode('.', $namaFile); // fungsi explode yaitu untuk memecah string
$ekstensiGambar = strtolower(end($ekstensiGambar)); //fungsi end untuk mengambil bentuk file yg paling akhir contoh yogi.yogi.jpg, tolower untuk membuat string menjadi huruf kecil
if (!in_array($ekstensiGambar,$ekstensiGambarValid)) // buat mencek ada ga sebuah string di dalam array, parameter adakah jarum di dalam jerami, fungsi akan menghasilkkan true jika ada false jika tidak ada 
{      echo "
    <script> 
    alert('yang anda upload bukan Gambar !');
    </script>
    ";
return false;}   
if($ukuranFile >1000000)
{      echo "
    <script> 
    alert('UKURAN GAMBAR TERLALU BESAR !');
    </script>
    ";
return false;}

//generate nama gambar baru meminimalisir adanya kesamaan nama gambar dari user yang menyebabkan file user sebelumnya tertimpa
$namaFileBaru = uniqid();
$namaFileBaru.= '.';
$namaFileBaru.= $ekstensiGambar;

//LOLOS PENGECEKAN GAMBAR SIAP DI UPLOAD
move_uploaded_file($tmpName, 'img/'. $namaFileBaru); // fungsi untuk menyimpan isi dari file sementara
return $namaFileBaru;
}

function hapus($id){

    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
} 

function ubah($data){
    global $conn;
        $id = $data["id"];
        $NIM = htmlspecialchars($data["NIM"]) ;
        $Nama = htmlspecialchars($data["Nama"]);
        $Jurusan = htmlspecialchars($data["Jurusan"]);
        $Email = htmlspecialchars($data["Email"]);
        {$gambarLama =  htmlspecialchars($data["Gambar"]);}

        //cek apakah user pilih gambar baru atau tidak
        if($_FILES['Gambar']['error'] === 4)
            {$Gambar = $gambarLama;}
        else
            {$Gambar = upload();}
        //query update data
        $query = "UPDATE mahasiswa SET 
                NIM = '$NIM',
                Nama = '$Nama',
                Jurusan = '$Jurusan',
                Gambar = '$Gambar',
                Email = '$Email'
                WHERE id = $id
                ";
        mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
    }


    function search($keyword){

        $query = "SELECT * FROM mahasiswa WHERE 
        Nama LIKE '%$keyword%' OR
        NIM LIKE  '%$keyword%' OR
        Email LIKE '%$keyword%' OR
        Jurusan LIKE '%$keyword%'
        "; 
        
    return query($query);
    }
    

    function registrasi($data) {
        global $conn;
            $username = strtolower(stripslashes($data["username"]));
            $password = mysqli_real_escape_string($conn, $data["password"]);
            $password2 = mysqli_real_escape_string($conn, $data["password2"]);
      //username sudah ada atau belum

      $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
      if(mysqli_fetch_assoc($result)){
        echo "
        <script>
        alert('USERNAME SUDAH TERDAFTAR');
        </script>
        "; 
        return false;
       }     
      //cek confirm password
        if ( $password !== $password2 ){
        echo "
        <script>
        alert('Password Tidak Sesuai');
        </script>
        ";   
        return false;
    } 
       // enkripsi password atau menggunakan md5 tetapi tidak direkomendasikan karena md5 bisa di track melalui chrome
       $password = password_hash($password, PASSWORD_DEFAULT);
      mysqli_query($conn, "INSERT INTO users VALUES
      ('', '$username', '$password')");
      return mysqli_affected_rows($conn);
}
 
?>