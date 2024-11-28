<?php
include('../inc/koneksi.php');


$search = isset($_GET['search']) ? $_GET['search'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Portal Perpustakaan</title>
</head>

<body>
    <div class="container">
        <div class="left" id="sidebar">
            <nav>
                <div class="title">
                    <a href="#">E-Library.</a>
                </div>
                <div class="nav-items admin">
                    <ul>
                        <a href="index.php">
                            <li>Home</li>
                        </a>
                        <a href="buku.php">
                            <li>Buku</li>
                        </a>
                        <a href="peminjaman.php">
                            <li>Peminjaman</li>
                        </a>
                        <a href="kategori_buku.php">
                            <li>Kategori Buku</li>
                        </a>
                        <a href="anggota.php">
                            <li>Anggota</li>
                        </a>
                        <?php if ($_SESSION["level"] == "admin") { ?>
                            <a href="petugas.php">
                                <li>Petugas</li>
                            </a>
                        <?php } ?>

                        <a href="laporan.php">
                            <li>Laporan</li>
                        </a>
                        <a href="logout.php">
                            <li>Logout</li>
                        </a>
                </div>
            </nav>
        </div>
        <div class="right">
            <nav>
                <div class="top-nav">
                    <button id="sidebarToggle" class="sidebar-toggle"><i class="fa-solid fa-bars"></i></button>
                </div>
            </nav>