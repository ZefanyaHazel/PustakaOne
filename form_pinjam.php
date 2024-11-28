<?php
include 'inc/koneksi.php'; // File konfigurasi koneksi database

global $koneksi;

$user_id = $_POST["nama"];
$buku_id = $_POST["buku"];
$durasi = $_POST["durasi"];
$status = "dipinjam";

$q = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE user_id = $user_id AND buku_id = $buku_id AND status_peminjaman = '$status'");
if (mysqli_fetch_array($q)) {
    echo "<script>alert('User masih meminjam buku yang sama!')</script>";
    return false;
}
mysqli_query($koneksi, "INSERT INTO peminjaman VALUES(NULL, '$user_id', '$buku_id', NOW(), DATE_ADD(NOW(), INTERVAL $durasi DAY), '$status')");

return true;
