<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
if (isset($_POST["tambahKategori"])) {
    if (tambah_kategori($_POST) > 0) {
        echo "<script>alert('Kategori buku berhasil ditambahkan!');
        document.location.href = 'kategori_buku.php';</script>";
    } else {
        mysqli_error($koneksi);
    }
}

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
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text" name="namaKategori" required>
                        </div>

                        <button type="submit" name="tambahKategori" class="submit">Tambah</button>
            </div>
        </form>
    </div>
</main>
</div>
<?php include("footer.php") ?>