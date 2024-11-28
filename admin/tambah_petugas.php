<?php
session_start();

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
include("header.php");

if (isset($_POST["petugas"])) {
    $_SESSION["level_user"] = "petugas";
    if (tambah_user($_POST) > 0) {
        echo "<script>alert('Data Berhasil ditambah');
        document.location.href = 'petugas.php';</script>";
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
                <a href="petugas.php" class="back-btn">
                    < Kembali</a>
                        <h4>Tambah Petugas</h4>

                        <div class="form-input">
                            <label for="username">Username</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="form-input">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="form-input">
                            <label for="email">Email</label>
                            <input type="email" class="email" name="email" placeholder=" " required>
                        </div>
                        <div class="form-input">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" name="namaLengkap" required>
                        </div>
                        <div class="form-input">
                            <label for="alamat">Alamat</label>
                            <textarea type="text" name="alamat" required></textarea>
                        </div>

                        <button type="submit" name="petugas" class="submit">Tambah</button>
            </div>
        </form>
    </div>
</main>
</div>
<?php include("footer.php") ?>