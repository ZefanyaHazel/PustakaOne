<?php
session_start();
include("inc/koneksi.php");

if (isset($_SESSION["level"])) {
    header("location: index.php");
    exit;
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row["password"])) {
            if ($row["level"] === "admin") {
                $_SESSION["level"] = $row["level"];
                $_SESSION["id"] = $row["id_user"];
                header("location: admin/index.php");
                exit;
            } else if ($row["level"] === "user") {
                $_SESSION["level"] = $row["level"];
                $_SESSION["id"] = $row["id_user"];
                header("location: dashboard.php");
                exit;
            } else {
                $_SESSION["level"] = $row["level"];
                $_SESSION["id"] = $row["id_user"];
                header("location: admin/index.php");
                exit;
            }
        }
    }
    $error = true;
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

<body>
    <div class="login">

        <form action="" method="post">
            <div class="back">
                <a href="index.php">
                    < Back to Home</a>
            </div>
            <div class="box-content">
                <h1>Login</h1>
                <?php if (isset($error)) { ?>
                    <div class="error">
                        <p>Username atau Password salah!</p>
                    </div>
                <?php } ?>
                <div class="login-input">
                    <input type="text" name="username" required>
                    <label for="username">Username</label>
                </div>
                <div class="login-input">
                    <input type="password" name="password" required>
                    <label for="password">Password</label>
                </div>
                <button type="submit" name="submit">Login</button>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>