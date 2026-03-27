<?php
session_start();

if ($_SESSION["level"] != "user") {
    header("location: login.php");
    exit;
}
$id = $_SESSION["id"];
include("header.php");

if (isset($search) || $search == NULL) {
    if (isset($_GET["n"])) {
        $nama = $_GET["n"];
    } else {
        echo "<script>document.location.href = 'dashboard.php?s=$search'</script>";
        return false;
    }
}

$q = mysqli_query($koneksi, "SELECT * FROM buku
JOIN kategoribuku_relasi ON kategoribuku_relasi.`buku_id` = buku.`id_buku`
JOIN kategori_buku ON kategoribuku_relasi.`kategori_id` = kategori_buku.`id_kategori`
WHERE judul = '$nama'");
$row = mysqli_fetch_array($q);
$id_buku = $row["id_buku"];

$q2 = mysqli_query($koneksi, "SELECT * FROM ulasan_buku
JOIN buku ON ulasan_buku.`buku_id` = buku.`id_buku`
JOIN user ON ulasan_buku.`user_id` = user.`id_user`
WHERE buku_id = '$id_buku'
");

$q3 = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE user_id = '$id' AND buku_id = $id_buku AND status_peminjaman = 'dikembalikan'");

$q4 = mysqli_query($koneksi, "SELECT AVG(rating) AS avg_rating FROM ulasan_buku WHERE buku_id = '$id_buku'");
$row4 = mysqli_fetch_assoc($q4);

$q5 = mysqli_query($koneksi, "SELECT COUNT(*) AS total_rating FROM ulasan_buku WHERE buku_id = '$id_buku'");
$row5 = mysqli_fetch_assoc($q5);

if (isset($_POST["submit"])) {
    $id_user = $id;
    $id_buku = $id_buku;
    $rating = $_POST["rating"];
    $ulasan = $_POST["review"];
    $q = mysqli_query($koneksi, "INSERT INTO ulasan_buku VALUES(NULL, '$id_user', '$id_buku', '$ulasan', '$rating')");
    echo "<script>document.location.href = 'detail_buku.php?n=$nama'</script>";
    return false;
}
if (isset($_POST["edit"])) {
    $id_user = $id;
    $id_buku = $id_buku;
    $ulasan = $_POST["review"];
    $rating = $_POST["rating"];
    $q = mysqli_query($koneksi, "UPDATE ulasan_buku SET ulasan = '$ulasan', rating = '$rating' WHERE user_id = '$id' AND buku_id = '$id_buku'");
    if ($q) {
        echo "<script>document.location.href = 'detail_buku.php?n=$nama'</script>";
        return false;
    }
}

?>

<main>
    <div class="book-detail">
        <h3><span><?php echo $row["judul"]; ?></span></h3>
    </div>
    <div class="box-book-detail">
        <?php
        $q6 = mysqli_query($koneksi, "SELECT * FROM koleksi_pribadi WHERE user_id = '$id' AND buku_id = '$id_buku'");
        if (mysqli_num_rows($q6) > 0) { ?>
            <div style="text-align: end;">
                <a href="hapus_favorit.php?buku=<?= $id_buku; ?>&us=<?= $id; ?>" class="del-fav">
                    <i class="fa-regular fa-trash-can"></i>
                    <span>Hapus dari Favorit</span>
                </a>
            </div>
        <?php } else { ?>

            <div style="text-align: end;">
                <a href="tambah_favorit.php?buku=<?= $id_buku; ?>&us=<?= $id; ?>" class="add-fav">
                    <i class="fa-regular fa-star"></i>
                    <span class="add-text">Tambah Favorit</span>
                </a>
            </div>
        <?php } ?>
        <div class="detail-info">
            <div class="book-info">
                <img src="img/<?= $row["img"] ?>" alt="" class="book-img">
                <div class="info-group">
                    <span><b>Judul : </b><?php echo $row["judul"] ?></span>
                    <span><b>Penulis : </b><?php echo $row["penulis"] ?></span>
                    <span><b>Penerbit : </b><?php echo $row["penerbit"] ?></span>
                    <span><b>Kategori : </b><?php echo $row["nama_kategori"] ?></span>
                    <span><b>Tahun Terbit : </b><?php echo $row["tahun_terbit"] ?></span>
                </div>
            </div>
            <div class="avg-rating">
                <?php
                if (mysqli_num_rows($q2) > 0) {
                ?>
                    <div class="rating-value">
                        <i class="fa-regular fa-star"></i>
                        <span><?php echo number_format($row4["avg_rating"], 1); ?></span>
                    </div>
                    <span><?php echo $row5["total_rating"]; ?> review(s)</span>
                <?php

                } else { ?>
                    <div class="rating-value">
                        <i class="fa-regular fa-star"></i>
                        <span>?</span>
                    </div>
                    <span>Belum ada Ulasan</span>
                <?php } ?>

            </div>
        </div>
        <div class="sinopsis">
            <span><b>Sinopsis : </b><?php echo $row["sinopsis"] ?></span>
        </div>
        <span class="borrow-btn" onclick="openModal()">Pinjam</span>
        <div class="modal" id="myModal">
            <div class="modal-content">
                <button type="button" class="close-btn" onclick="closeModal()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <h2>Pilih Durasi</h2>
                <form action="form_pinjam.php" method="POST">
                    <div class="radio-group">
                        <input type="hidden" name="id_user" value="<?= $id;  ?>">
                        <input type="hidden" name="id_buku" value="<?= $row["id_buku"];  ?>">
                        <label>
                            <input type="radio" name="durasi" value="7" required> Seminggu
                        </label>
                        <label>
                            <input type="radio" name="durasi" value="14" required> 2 Minggu
                        </label>
                        <label>
                            <input type="radio" name="durasi" value="30" required> Sebulan
                        </label>
                    </div>
                    <button type="submit" class="submit">Pinjam</button>
                </form>
            </div>
        </div>
    </div>

    <div class="box-content">
        <div class="box-review">
            <?php if (mysqli_num_rows($q3) > 0) {
                $q7 = mysqli_query($koneksi, "SELECT * FROM ulasan_buku WHERE user_id = '$id' AND buku_id = '$id_buku'");
                $row7 = mysqli_fetch_assoc($q7);
                if (mysqli_num_rows($q7) > 0) { ?>
                    <div class="title-review">
                        <h3>Your Review</h3>
                        <p>Ulasan Anda telah terkirim dan dapat diperbarui kapan saja.</p>
                    </div>
                    <form id="review-form" method="POST">
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" <?= $row7["rating"] == 5 ? 'checked' : ''; ?> /><label for="star5"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" <?= $row7["rating"] == 4 ? 'checked' : ''; ?> /><label for="star4"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" <?= $row7["rating"] == 3 ? 'checked' : ''; ?> /><label for="star3"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" <?= $row7["rating"] == 2 ? 'checked' : ''; ?> /><label for="star2"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1" <?= $row7["rating"] == 1 ? 'checked' : ''; ?> /><label for="star1"><i class="fa-solid fa-star"></i></label>
                        </div>

                        <textarea id="review-text" name="review" rows="5" cols="40" placeholder="Tulis Pendapatmu" required><?= $row7["ulasan"]; ?></textarea>

                        <button type="submit" id="submit-button" name="edit" disabled>Edit</button>
                    </form>
                <?php } else {
                ?>
                    <div class="title-review">
                        <h3>Rate this book</h3>
                        <p>Beri tahu orang lain pendapatmu tentang buku ini.</p>
                    </div>
                    <form id="review-form" method="POST">
                        <div class="rating">
                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2"><i class="fa-solid fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1"><i class="fa-solid fa-star"></i></label>
                        </div>

                        <textarea name="review" rows="5" cols="40" placeholder="Tulis Pendapatmu" required></textarea>

                        <button type="submit" name="submit">Kirim</button>
                    </form>

            <?php }
            } ?>
            <div class="title-review">
                <h3>Rating & Review</h3>
                <p>Rating dan ulasan mereka yang telah membaca buku ini. </p>
            </div>
            <div class="review">
                <?php if (mysqli_num_rows($q2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($q2)) {
                        $rating = $row2["rating"];
                        $ulasan = $row2["ulasan"];
                        $nama_lengkap = $row2["nama_lengkap"];
                        $rating_persen = ($rating / 5) * 100;
                ?>
                        <div class="review-content">
                            <div class="stars-outer">
                                <div class="stars-inner" style="width: <?= $rating_persen; ?>%;">★★★★★</div>
                                <div class="stars-empty">★★★★★</div>
                            </div>
                            <div class="ulasan">
                                <p><?= $ulasan; ?></p>
                            </div>
                            <span class="oleh">oleh <i><?= $nama_lengkap; ?></i></span>
                        </div>
                    <?php
                    }
                } else { ?>
                    <div class="empty-review">
                        <span>Belum ada Ulasan</span>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
</main>
</div>
<script>
    function openModal() {
        document.getElementById('myModal').style.display = 'flex';
    }

    // Menutup modal
    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }
</script>
<?php include("footer.php") ?>