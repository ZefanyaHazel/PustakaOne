<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}

$q = mysqli_query($koneksi, "SELECT * FROM peminjaman
    JOIN user ON `peminjaman`.`user_id` = `user`.`id_user`
    JOIN buku ON `peminjaman`.`buku_id` = `buku`.`id_buku` ORDER BY tanggal_peminjaman DESC
");

if (isset($_GET["con"])) {
    $id_peminjaman = $_GET["con"];

    $q = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman = '$id_peminjaman'");
    $result = mysqli_fetch_array($q);
    if ($result["tanggal_pengembalian"] != NULL) {
        echo "<script>alert('Data telah dikonfirmasi!'); document.location.href = 'peminjaman.php';</script>";
        return false;
    }
    mysqli_query($koneksi, "UPDATE peminjaman SET tanggal_pengembalian = NOW(), status_peminjaman = 'tidak aktif' WHERE id_peminjaman = '$id_peminjaman'");
    header("location: peminjaman.php");
}

?>

<main>
    <div class="title">
        <h2>Data Peminjaman Buku</h2>
    </div>
    <div class="box-content">
        <div class="button-tambah">
            <button type="button"><a href="tambah_peminjaman.php">Tambah Peminjam</a></button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_assoc($q)) {
                    if ($row["tanggal_pengembalian"] == NULL) {
                        $tgl_kembali = "Dalam peminjaman";
                    } else {
                        $tgl_kembali = $row["tanggal_pengembalian"];
                    }
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["nama_lengkap"]; ?></td>
                        <td><?php echo $row["judul"]; ?></td>
                        <td><?php echo $row["tanggal_peminjaman"]; ?></td>
                        <td><?php echo $tgl_kembali; ?></td>
                        <td>
                            <a href="?con=<?php echo $row["id_peminjaman"]; ?>">Konfirmasi</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
</div>
<?php include("footer.php") ?>