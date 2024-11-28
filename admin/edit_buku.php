<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}

$id = $_GET["id_buku"];
$q = mysqli_query($koneksi, "SELECT * FROM buku
JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
WHERE id_buku = '$id'
 ORDER BY tahun_terbit DESC");
$row = mysqli_fetch_assoc($q);
?>

<main>
    <div class="title">
        <h2>Data Buku</h2>
    </div>
    <div class="box-content">
        <form action="edit_info_buku.php" id="book_form" method="post" enctype="multipart/form-data">
            <div class="box-content">
                <a href="buku.php" class="back-btn">
                    < Kembali</a>
                        <h4>Edit Buku</h4>
                        <input type="hidden" name="id_buku" value="<?= $row["id_buku"] ?>">
                        <div class="form-input">
                            <img id="preview" src="<?php echo isset($row["img"]) ? '../img/' . $row["img"] : '' ?>" style="width: 100px; height: 150px; object-fit:cover;">
                        </div>

                        <div class="form-input">
                            <label for="image">Cover Buku</label>
                            <input type="file" name="image" accept="image/*" onchange="previewImage(event)">
                        </div>

                        <div class="form-input">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" value="<?= $row["judul"] ?>" required>
                        </div>
                        <div class="form-input">
                            <label for="penulis">Penulis</label>
                            <input type="text" name="penulis" value="<?= $row["penulis"] ?>" required>
                        </div>
                        <div class="form-input">
                            <label>Kategori</label>
                            <div class="dropdown-container">
                                <input type="text" id="dropdownInput" name="kategori" value="<?= $row["nama_kategori"] ?>" placeholder="Cari kategori..." required>
                                <div class="dropdown-list" id="dropdownList">
                                    <?php
                                    $q = mysqli_query($koneksi, "SELECT * FROM kategori_buku");

                                    while ($row2 = mysqli_fetch_array($q)) { ?>
                                        <div class="dropdown-item" data-value="<?= $row2["id_kategori"] ?>"><?= $row2["nama_kategori"] ?></div>

                                    <?php
                                    }
                                    ?>
                                </div>
                                <div id="error-message" class="error-message" style="display: none;">Kategori tidak valid!</div>
                            </div>
                        </div>
                        <div class="form-input">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" value="<?= $row["penerbit"] ?>" required>
                        </div>
                        <div class="form-input">
                            <label for="sinopsis">Sinopsis</label>
                            <textarea type="text" name="sinopsis" required><?= $row["sinopsis"] ?></textarea>
                        </div>
                        <div class="form-input">
                            <label for="tahunTerbit">Tahun Terbit</label>
                            <input type="number" name="tahunTerbit" value="<?= $row["tahun_terbit"] ?>" required>
                        </div>

                        <button type="submit" name="editBuku" class="submit">Edit</button>
            </div>
        </form>
    </div>
</main>
</div>
<script>


</script>
<?php include("footer.php") ?>