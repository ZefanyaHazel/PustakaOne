<?php 
include ("../inc/koneksi.php");
$id_buku = $_GET["id_buku"];

if (hapus_buku($id_buku) > 0) {
    echo "<script>alert('Data berhasil dihapus!')
    document.location.href= 'buku.php'
    </script>";
}
?>