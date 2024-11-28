<?php
session_start();
include("inc/koneksi.php");

if ($_SESSION["level"] != "user") {
    echo "<script>
    document.location.href = 'login.php'</script>";
    return false;
}


$id_user = $_GET["us"];
$id_buku = $_GET["buku"];

$q2 = mysqli_query($koneksi, "SELECT judul FROM buku WHERE id_buku = '$id_buku'");
$row = mysqli_fetch_assoc($q2);
$judul = $row["judul"];

$q = mysqli_query($koneksi, "DELETE FROM koleksi_pribadi WHERE user_id = '$id_user' AND buku_id = '$id_buku'");

if ($q) {
    echo "<script>
        document.location.href = 'detail_buku.php?n=$judul'</script >";
}
