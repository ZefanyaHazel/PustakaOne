<?php
session_start();
include("inc/koneksi.php");

if (isset($_SESSION["level"])) {
    header("location: index.php");
    exit;
}
if (isset($_POST["register"])) {
    if (register_user($_POST) > 0) {
        echo "<script>
        alert('Berhasil registrasi!');
        document.location.href = 'login.php'
        </script>";
    } else {
        echo mysqli_error($koneksi);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/main.js"></script>
    <title>Perpustakaan</title>
</head>
<div class="register">
    <form action="" method="post">

        <div class="back">
            <a href="index.php">
                < Back to Home</a>
        </div>
        <div class="box-content">
            <h1>Register</h1>

            <div class="register-input">
                <input type="text" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>" required>
                <label for="username">Username</label>
            </div>
            <div class="register-input">
                <input type="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <div class="register-input">
                <input type="email" class="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="register-input">
                <input type="text" name="namaLengkap" value="<?php echo isset($_POST["namaLengkap"]) ? $_POST["namaLengkap"] : ''; ?>" required>
                <label for="namaLengkap">Nama Lengkap</label>
            </div>
            <div class="register-input">
                <textarea type="text" name="alamat" required><?php echo isset($_POST["alamat"]) ? $_POST["alamat"] : ''; ?></textarea>
                <label for="alamat">Alamat</label>
            </div>
            <div class="register-input">
                <select name="level" required>
                    <option value=""></option>
                    <option value="admin" <?php echo (isset($_POST["level"]) && $_POST["level"] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    <option value="user" <?php echo (isset($_POST["level"]) && $_POST["level"] == 'user') ? 'selected' : ''; ?>>User</option>
                </select>
                <label for="alamat">level</label>
            </div>

            <button type="submit" name="register">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </form>
</div>