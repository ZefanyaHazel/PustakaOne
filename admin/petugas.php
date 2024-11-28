<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
$result = mysqli_query($koneksi, "SELECT * FROM user WHERE level='petugas'");

?>

<main>
    <div class="title">
        <h2>Data Petugas</h2>
    </div>
    <div class="box-content">
        <div class="button-tambah">
            <button type="button"><a href="tambah_petugas.php">Tambah Petugas</a></button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["nama_lengkap"]; ?></td>
                        <td class="act-btn">
                            <a href="edit_petugas.php?id=<?php echo $row["id_user"]; ?>" class="edit-btn">Edit</a>
                            <a href="delete_petugas.php?id=<?php echo $row["id_user"]; ?>" class="delete-btn">Delete</a>
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