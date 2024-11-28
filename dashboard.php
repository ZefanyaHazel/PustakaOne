<?php
session_start();

if ($_SESSION["level"] != "user") {
    header("location: login.php");
    exit;
}
$id = $_SESSION["id"];
include("header.php");
$q = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user = '$id'");
$row2 = mysqli_fetch_array($q);


$result = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%$search%'");

?>
<main>
    <div class="title">
        <h2>Hallo, <span><?php echo $row2["nama_lengkap"]; ?></span></h2>
    </div>

    <div class="title">
        <?php
        if (isset($search)) {
            echo "<h3>Hasil Pencarian dari $search</h3>";
        } else {
            echo "<h3>Koleksi Lengkap Perpustakaan</h3>";
        } ?>
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
                echo "<span style='text-align:center;';>Buku yang kamu cari tidak ada:(</span>";
            }
            ?>
        </div>
    </div>
</main>
<?php include("footer.php") ?>