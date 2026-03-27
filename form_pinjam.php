<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $current_url = $_SERVER['REQUEST_URI'];

    // cek apakah sudah ada "/" di akhir
    if (substr($current_url, -1) !== '/') {
        header("Location: " . $current_url . "/");
        exit;
    }
}

include 'inc/koneksi.php'; // File konfigurasi koneksi database

global $koneksi;

$user_id = $_POST["id_user"];
$buku_id = $_POST["id_buku"];
$durasi = $_POST["durasi"];
$status = "pending";

$q = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE user_id = '$user_id' AND buku_id = '$buku_id' AND status_peminjaman = '$status'");
$result = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku = '$buku_id'");
$row = mysqli_fetch_assoc($result);
$judul_buku = $row["judul"];

if (mysqli_fetch_array($q)) {
    echo "<script>alert('User masih meminjam buku yang sama!')</script>";
    echo "<script>document.location.href = 'detail_buku.php?n=$judul_buku'</script>";
    return false;
} else {
    mysqli_query($koneksi, "INSERT INTO peminjaman VALUES(NULL, '$user_id', '$buku_id', NULL, '$durasi', NULL, '$status', NOW())");
    echo "<script>alert('Peminjaman berhasil dibuat!')</script>";
    echo "<script>document.location.href = 'detail_buku.php?n=$judul_buku'</script>";
}

return true;
