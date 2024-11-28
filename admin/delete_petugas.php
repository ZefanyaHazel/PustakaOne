<?php 
include("../inc/koneksi.php");
$id = $_GET["id"];

if (hapus_user($id) > 0) {
    echo "<script>alert('Data berhasil dihapus!')
    document.location.href = 'petugas.php'</script>";
}


?>