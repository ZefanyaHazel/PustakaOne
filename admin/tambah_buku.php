<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
?>

<main>
    <div class="title">
        <h2>Data Buku</h2>
    </div>
    <div class="box-content">
        <form id="book_form" action="upload_buku.php" method="post" enctype="multipart/form-data">
            <div class="box-content">
                <a href="buku.php" class="back-btn">
                    < Kembali</a>
                        <h4>Tambah Buku</h4>
                        <input type="hidden" name="id_user" value="">

                        <div class="form-input">
                            <label for="image">Cover Buku</label>
                            <input type="file" name="image" id="uploadFoto" accept="image/*" onchange="previewImage(event)" required>
                        </div>
                        <img id="preview" src="" style="max-width: 100px; max-height: 150px;">

                        <div class="form-input">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" required>
                        </div>
                        <div class="form-input">
                            <label for="penulis">Penulis</label>
                            <input type="text" name="penulis" required>
                        </div>
                        <div class="form-input">
                            <label>Kategori</label>
                            <div class="dropdown-container">
                                <input type="text" id="dropdownInput" name="kategori" placeholder="Cari kategori..." required>
                                <div class="dropdown-list" id="dropdownList">
                                    <?php
                                    $q = mysqli_query($koneksi, "SELECT * FROM kategori_buku");

                                    while ($row = mysqli_fetch_array($q)) { ?>
                                        <div class="dropdown-item" data-value="<?= $row["id_kategori"] ?>"><?= $row["nama_kategori"] ?></div>

                                    <?php
                                    }
                                    ?>
                                </div>
                                <div id="error-message" class="error-message" style="display: none;">Kategori tidak valid!</div>
                            </div>
                        </div>
                        <div class="form-input">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" required>
                        </div>
                        <div class="form-input">
                            <label for="sinopsis">Sinopsis</label>
                            <textarea type="text" name="sinopsis" required></textarea>
                        </div>
                        <div class="form-input">
                            <label for="tahunTerbit">Tahun Terbit</label>
                            <input type="number" name="tahunTerbit" min="1" max="2100" placeholder="Contoh: 2022" required>
                        </div>

                        <button type="submit" name="tambahBuku" class="submit">Tambah</button>
            </div>
        </form>
    </div>
</main>
</div>
<?php include("footer.php") ?>