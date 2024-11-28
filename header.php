<?php
include('inc/koneksi.php');

if (isset($_POST["submit"])) {
    $keyword = $_POST["keyword"];
    echo "<script>document.location.href = '?s=$keyword'</script>";
}
if (isset($_GET["s"]) && !empty(trim($_GET["s"]))) {
    $search = $_GET["s"];
} else {
    $search = NULL;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <title>Portal Perpustakaan</title>
</head>

<body>
    <div class="container">
        <div class="left" id="sidebar">
            <nav>
                <div class="title">
                    <a href="#">PerpusNet.</a>
                </div>
                <div class="nav-items">
                    <ul>
                        <a href="dashboard.php">
                            <li>Home</li>
                            <a href="koleksi_pribadi.php">
                                <li>Favorit</li>
                            </a>
                            <a href="riwayat_pinjaman.php">
                                <li>Riwayat Peminjaman</li>
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
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" name="keyword" placeholder="Cari Buku" value="<?= isset($search) ? $search : '' ?>">
                            <button type="submit" name="submit" class="search"><i class="fa-solid fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </nav>