<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
$q = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_data FROM user WHERE level='user'");
$row = mysqli_fetch_assoc($q);
$jumlah_tabel1 = $row["jumlah_data"];

$q3 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_data FROM buku");
$row3 = mysqli_fetch_assoc($q3);
$jumlah_tabel3 = $row3["jumlah_data"];

$q4 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_data FROM peminjaman WHERE status_peminjaman != 'dikembalikan'");
$row4 = mysqli_fetch_assoc($q4);
$jumlah_tabel4 = $row4["jumlah_data"];

$q5 = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah_data FROM peminjaman WHERE status_peminjaman = 'dikembalikan'");
$row5 = mysqli_fetch_assoc($q5);
$jumlah_tabel5 = $row5["jumlah_data"];
?>

<main>
    <div class="title">
        <h2>Kumpulan Laporan Data Perpustakaan</h2>
    </div>
    <div class="box-content">
        <div class="cards">

            <div class="card">
                <h2><?php echo $jumlah_tabel1 ?></h2>
                <p>Jumlah Anggota</p>
                <a href="laporan_anggota.php">Detail laporan ></a>
            </div>
            <div class="card">
                <h2><?php echo $jumlah_tabel3 ?></h2>
                <p>Jumlah Buku</p>
                <a href="laporan_buku.php">Detail laporan ></a>
            </div>
            <div class="card">
                <h2><?php echo $jumlah_tabel4 ?></h2>
                <p>Jumlah Peminjam</p>
                <a href="laporan_peminjaman.php">Detail laporan ></a>
            </div>
            <div class="card">
                <h2><?php echo $jumlah_tabel5 ?></h2>
                <p>Jumlah Pengembalian</p>
                <a href="laporan_pengembalian.php">Detail laporan ></a>
            </div>
        </div>

    </div>
</main>
</div>
<?php include("footer.php") ?>