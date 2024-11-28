<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: index.php");
    exit;
}
if (isset($_POST["tambahPeminjam"])) {
    if (tambah_peminjaman($_POST) > 0) {
        echo "<script>alert('User berhasil Meminjam Buku!');
        document.location.href = 'peminjaman.php';</script>";
    } else {
        mysqli_error($koneksi);
    }
}

?>

<main>
    <div class="title">
        <h2>Data Peminjam Buku</h2>
    </div>
    <div class="box-content">
        <form action="" method="post">
            <div class="box-content">
                <a href="peminjaman.php" class="back-btn">
                    < Kembali</a>
                        <h4>Tambah Peminjam Buku</h4>
                        <div class="form-input">
                            <label for="nama">Nama Peminjam</label>
                            <select name="nama" id="select" required>
                                <option value="">--PILIH USER--</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM user WHERE level='user'");
                                while ($result = mysqli_fetch_assoc($q)) { ?>
                                    <option value="<?= $result["id_user"] ?>"><?php echo $result["nama_lengkap"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-input">
                            <label for="buku">Pilihan Buku</label>
                            <select name="buku" id="select" required>
                                <option value="">--PILIH JUDUL--</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($result = mysqli_fetch_assoc($q)) { ?>
                                    <option value="<?= $result["id_buku"] ?>"><?php echo $result["judul"]; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-radio">
                            <label>Durasi Peminjaman:</label>
                            <div class="radio-group">
                                <div class="radio-input">
                                    <input type="radio" id="seminggu" name="durasi" value="7" required>
                                    <label for="seminggu">Seminggu</label><br>
                                </div>
                                <div class="radio-input">
                                    <input type="radio" id="dua_minggu" name="durasi" value="14">
                                    <label for="dua_minggu">2 Minggu</label><br>
                                </div>
                                <div class="radio-input">
                                    <input type="radio" id="sebulan" name="durasi" value="30">
                                    <label for="sebulan">Sebulan</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" name="tambahPeminjam" class="submit">Tambah</button>
            </div>
        </form>
    </div>
</main>
</div>
<?php include("footer.php") ?>