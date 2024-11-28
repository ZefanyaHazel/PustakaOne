<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "user") {
    header("location: login.php");
    exit;
}
if (isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
}
$result = mysqli_query($koneksi, "SELECT * FROM peminjaman
JOIN buku ON `peminjaman`.`buku_id` = `buku`.`id_buku`
JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
WHERE user_id = '$id' AND status_peminjaman = 'aktif'
");
$result = mysqli_query($koneksi, "SELECT * FROM buku ");
?>
<main>
    <div class="title">
        <h2>Pinjaman Buku</h2>
    </div>
    <div class="box-content">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Status Peminjaman</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["judul"]; ?></td>
                        <td><?php echo $row["nama_kategori"]; ?></td>
                        <td><?php echo $row["tanggal_peminjaman"]; ?></td>
                        <td><?php echo $row["status_peminjaman"]; ?></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
<?php include("footer.php") ?>