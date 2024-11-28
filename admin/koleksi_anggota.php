<?php
session_start();
include("header.php");
if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
$q = mysqli_query($koneksi, "SELECT user_id, COUNT(*) AS total_records FROM koleksi_pribadi GROUP BY user_id");

?>

<main>
    <div class="title">
        <h2>Koleksi Buku Anggota</h2>
    </div>
    <div class="box-content">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pengoleksi</th>
                    <th>Jumlah Buku</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                if (mysqli_num_rows($q) > 0) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        $user_id = $row["user_id"];
                        $q2 = mysqli_query($koneksi, "SELECT nama_lengkap FROM user WHERE id_user = '$user_id'");
                        $row2 = mysqli_fetch_array($q2);
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row2["nama_lengkap"]; ?></td>
                            <td><?php echo $row["total_records"]; ?> buku</td>
                        </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
</div>
<?php include("footer.php") ?>