<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
if (isset($_POST["tambahBuku"])) {
    if (tambah_buku($_POST) > 0) {
        echo "<script>alert('Buku berhasil ditambah!');
        document.location.href = 'koleksi_anggota.php';</script>";
    } else {
        mysqli_error($koneksi);
    }
}
?>

<main>
    <div class="title">
        <h2>Koleksi Buku Anggota</h2>
    </div>
    <div class="box-content">
        <form action="" method="post">
            <div class="box-content">
                <a href="buku.php" class="back-btn">
                    < Kembali</a>
                        <h4>Tambah Koleksi</h4>

                        <div class="form-input">
                            <label for="id_user">Nama Pengoleksi</label>
                            <select name="id_user" required>
                                <option value="">-- Pilih Nama --</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM user WHERE level = 'user'");

                                while ($row = mysqli_fetch_array($q)) { ?>
                                    <option value="<?= $row["id_user"] ?>"><?= $row["nama_lengkap"] ?></option>

                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <h4>Informasi Buku</h4>

                        <div class="form-input">
                            <label for="judul">Judul</label>
                            <input type="text" name="judul" required>
                        </div>
                        <div class="form-input">
                            <label for="penulis">Penulis</label>
                            <input type="text" name="penulis" required>
                        </div>
                        <div class="form-input">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php
                                $q = mysqli_query($koneksi, "SELECT * FROM kategori_buku");

                                while ($row = mysqli_fetch_array($q)) { ?>
                                    <option value="<?= $row["id_kategori"] ?>"><?= $row["nama_kategori"] ?></option>

                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-input">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" required>
                        </div>
                        <div class="form-input">
                            <label for="tahunTerbit">Tahun Terbit</label>
                            <input type="date" name="tahunTerbit" required>
                        </div>

                        <button type="submit" name="tambahBuku" class="submit">Tambah</button>
            </div>
        </form>
    </div>
</main>
</div>
<?php include("footer.php") ?>