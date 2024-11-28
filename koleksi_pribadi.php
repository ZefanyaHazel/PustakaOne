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
$result = mysqli_query($koneksi, "SELECT * FROM koleksi_pribadi
JOIN buku ON `koleksi_pribadi`.`buku_id` = `buku`.`id_buku`
JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
WHERE user_id = '$id' AND (judul LIKE '%$search%' OR penulis LIKE '%$search%')
");

?>
<main>
    <div class="title">
        <h2>Koleksi Buku Favoritku</h2>
    </div>
    <div class="box-content">
        <div class="books">
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
                        <a href="detail_buku.php?n=<?php echo $row["judul"]; ?>" class="book-link">
                            <img src="img/<?= $row["img"] ?>" alt="Cover Buku">
                            <div class="card-content">
                                <div class="desc">
                                    <h3 class="book-title"><?= $row["judul"]; ?></h3>
                                    <p class="author"><?= $row["penulis"] ?></p>
                                    <span class="rate">
                                        <i class="fa-solid fa-star"></i> <?= $rating; ?>
                                    </span>
                                </div>

                            </div>
                        </a>
                    </div>
            <?php
                }
            } else {
                echo "<span style='text-align:center;';>Belum ada buku yang kamu koleksi</span>";
            }
            ?>
        </div>
    </div>
</main>
<?php include("footer.php") ?>