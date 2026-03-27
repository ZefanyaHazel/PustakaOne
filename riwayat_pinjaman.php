<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "user") {
    header("location: login.php");
    exit;
}
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
}
$result = mysqli_query($koneksi, "SELECT * FROM peminjaman
JOIN buku ON `peminjaman`.`buku_id` = `buku`.`id_buku`
JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
WHERE user_id = '$id' AND (judul LIKE '%$search%') ORDER BY FIELD(status_peminjaman, 'pending', 'terlambat', 'selesai') DESC
");

?>
<main>
    <div class="title">
        <h2>Riwayat Peminjaman</h2>
    </div>
    <div class="box-content">
        <div class="horizontal-card">
            <?php
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    $id_buku = $row["id_buku"];
                    $q3 = mysqli_query($koneksi, "SELECT AVG(rating) AS avg_rating FROM ulasan_buku WHERE buku_id = $id_buku");
                    $row3 = mysqli_fetch_assoc($q3);
                    if ($row3["avg_rating"] === null) {
                        $rating = '?';
                    } else {
                        $rating = number_format((float)$row3["avg_rating"], 1);
                    }
            ?>
                    <div class="book-card">
                        <img src="img/<?= $row["img"]  ?>" alt="Cover Buku" class="book-cover">
                        <div class="book-details">
                            <h3 class="book-title"><?php echo $row["judul"]; ?></h3>
                            <p class="book-author">Penulis: Nama Penulis</p>
                            <p class="book-category"><?php echo $row["nama_kategori"]; ?></p>
                            <p class="book-release">Pinjam : <?php echo $row["tanggal_peminjaman"]; ?></p>
                            <p class="book-release">Kembali : <?php echo $row["tanggal_pengembalian"]; ?></p>
                            <?php if ($row["status_peminjaman"] == "pending") { ?>
                                <span class="aktif-button">Belum selesai</span>
                            <?php } else if ($row["status_peminjaman"] == "terlambat") { ?>
                                <span class="late-button">Terlambat</span>
                            <?php } else { ?>
                                <span class="nonaktif-button">Selesai</span>
                            <?php } ?>
                        </div>
                    </div>
            <?php
                }
            } else if (isset($search)) {
                echo "<span style='text-align:center;';>Buku yang kamu cari tidak ada!</span>";
            } else {
                echo "<span style='text-align:center;';>Belum ada buku yang dipinjam!</span>";
            }
            ?>
        </div>
    </div>
</main>
<?php include("footer.php") ?>