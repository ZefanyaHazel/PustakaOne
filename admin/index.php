<?php
session_start();

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: ../login.php");
    exit;
}

include("header.php");

?>

<main>
    <div class="title">
        <h2>Selamat Datang, <?php echo $_SESSION["level"] ?>!</h2>
    </div>
</main>
</div>
<?php include("footer.php") ?>