<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM kategori_buku");

?>

<main>
    <div class="title">
        <h2>Data Kategori Buku</h2>
    </div>
    <div class="box-content">
        <div class="button-tambah">
            <button type="button"><a href="tambah_kategori.php">Tambah Kategori</a></button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
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
                        <td><?php echo $row["nama_kategori"]; ?></td>
                        <td class="act-btn">
                            <a href="edit_kategori.php?id=<?php echo $row["id_kategori"]; ?>" class="edit-btn">Edit</a>
                            <a href="delete_kategori.php?id=<?php echo $row["id_kategori"]; ?>" class="delete-btn">Delete</a>
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