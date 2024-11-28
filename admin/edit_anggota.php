<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}

$id = $_GET["id"];
$result = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
$row = mysqli_fetch_array($result);

if (isset($_POST["submit"])) {
    $_SESSION["level_user"] = "user";
    if (ubah_user($_POST) > 0) {
        echo "<script>alert('Data Berhasil diubah!');
        document.location.href = 'anggota.php';</script>";
    } else {
        mysqli_error($koneksi);
    }
}

?>

<main>
    <div class="title">
        <h2>Data Petugas</h2>
    </div>
    <div class="box-content">
        <form action="" method="post">
            <div class="box-content">
                <a href="anggota.php" class="back-btn">
                    < Kembali</a>
                        <h4>Ubah Petugas</h4>
                        <input type="hidden" name="id_user" value="<?= $row["id_user"];  ?>">
                        <div class="form-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?= $row["username"]; ?>" required>
                        </div>
                        <div class="form-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Password Barumu" required>
                        </div>
                        <div class="form-input">
                            <label for="email">Email</label>
                            <input type="email" class="email" name="email" value="<?= $row["email"]; ?>" required>
                        </div>
                        <div class="form-input">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" name="namaLengkap" value="<?= $row["nama_lengkap"]; ?>" required>
                        </div>
                        <div class="form-input">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" name="alamat" required></textarea>
                        </div>

                        <button type="submit" name="submit" class="submit">Ubah</button>
            </div>
        </form>
    </div>
</main>
</div>
<?php include("footer.php") ?>