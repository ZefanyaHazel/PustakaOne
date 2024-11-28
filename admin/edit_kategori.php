<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
$id = $_GET["id"];
if (isset($_POST["editKategori"])) {
    if (ubah_kategori($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah!')
        document.location.href = 'kategori_buku.php'</script>";
    }
}
$q = mysqli_query($koneksi, "SELECT * FROM kategori_buku WHERE id_kategori = '$id'");
$row = mysqli_fetch_array($q);

?>

<main>
    <div class="title">
        <h2>Data Kategori Buku</h2>
    </div>
    <div class="box-content">
        <form action="" method="post">
            <div class="box-content">
                <a href="kategori_buku.php" class="back-btn">
                    < Kembali</a>
                        <h4>Tambah Kategori Buku</h4>
                        <div class="form-input">
                            <input type="hidden" name="id_kategori" value="<?= $row["id_kategori"] ?>" required>
                        </div>
                        <div class="form-input">
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text" name="nama_kategori" value="<?= $row["nama_kategori"] ?>" required>
                        </div>

                        <button type="submit" name="editKategori" class="submit">Ubah</button>
            </div>
        </form>
    </div>
</main>
</div>
<?php include("footer.php") ?>