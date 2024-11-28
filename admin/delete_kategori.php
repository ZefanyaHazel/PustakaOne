<?php 

include("../inc/koneksi.php");

$id = $_GET["id"];
if (hapus_kategori($id) > 0) {
    echo "<script>alert('Data berhasil dihapus!')
    document.location.href = 'kategori_buku.php'</script>";
}

?>