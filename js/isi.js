/** CARA MENGGUNAKAN AJAX
 * 
//ambil element yang dibutuhkan, menggunakan teknik DOM(Detail objeck model)

var keyword = document.getElementById('keyword'); //cara baca js tolong carikan saya element yang punya id keyword
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

// tombolCari.addEventListener('click' , function() {alert('BERHASIL');});
keyword.addEventListener('keyup', function(){

    var xhr = new XMLHttpRequest();

//buat object ajax
//cek kesiapan ajax,sudah bisa digunakan apa belum
xhr.onreadystatechange = function() {
    if(xhr.readyState == 4 && xhr.status == 200) //4 artinya sumber sudah ready, status 200 artinya sudah oke
    {
container.innerHTML = xhr.responseText;
    }
}
xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true); //param 1 method nya apa, pram 2 sumber dari mana, param 3 mau sincronus atau asincronus
xhr.send();
}); 

*/

//MEMBUAT LIVE SEARCH MENGGUNAKAN JQUERY
// $ = jQuery
$(document).ready(function() //pada saat document ready, lakukan ini semua
{
//HILANGKAN TOMBOL CARI
$('#tombol-cari').hide();

//buat event ketika keyword ditulis #keyword
$('#keyword').on('keyup', function() // jquery tolong carikan saya element kyword lalu on ketika di keyup, ketika di keypup lakukan fungsi berikut ini
{
    $('.loader').show();

   /* //ajax menggunakan load
    $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
    // jquery tolong carikan saya element container lalu load/ubah isinya dengan data yang di ambil dari sumber, lalu kriimkan data keyword nya, lalu di isi dengan apapun yang di isi oleh usernya. val adalah value 
    */

    //ajax dengan cara get persis dengan load
// jquery lakukan get, ke ajax mahsiswa.php.ambil data, setelah data di ambil lalu lakukan sesuatu, sambil mengirimkan data hasil
$.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function(data){
    $('#container').html(data);
    $('.loader').hide();
});

});

});