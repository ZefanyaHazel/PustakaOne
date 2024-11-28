<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: ../index.php");
    exit;
}


// Tentukan jumlah data yang akan ditampilkan per halaman
$limit = 10;

// Ambil halaman yang sedang aktif (default halaman 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Ambil kata kunci pencarian jika ada

// Query untuk menghitung total data (dengan pencarian jika ada)
if ($search) {
    $total_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku 
    JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
    JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
    WHERE judul LIKE '%$search%'
    OR nama_kategori LIKE '%$search%'
    OR penulis LIKE '%$search%'
    OR tahun_terbit LIKE '%$search%'
    ");
} else {
    $total_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM buku");
}
$total_data = mysqli_fetch_assoc($total_result)['total'];

// Hitung total halaman
$total_page = ceil($total_data / $limit);

// Query untuk mengambil data sesuai limit dan pencarian
if ($search) {
    $result = "SELECT * FROM buku 
    JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
    JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
    WHERE judul LIKE '%$search%'
    OR nama_kategori LIKE '%$search%'
    OR penulis LIKE '%$search%'
    OR tahun_terbit LIKE '%$search%'
    ORDER BY tahun_terbit DESC
    LIMIT $start, $limit";
    $query = mysqli_query($koneksi, $result);
} else {
    $result = "SELECT * FROM buku 
    JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
    JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
    ORDER BY tahun_terbit DESC
    LIMIT $start, $limit";
    $query = mysqli_query($koneksi, $result);
}

?>


<main>
    <div class="title">
        <h2>Data Buku</h2>
    </div>
    <div class="box-content">
        <div class="button-tambah">
            <button type="button"><a href="tambah_buku.php">Tambah Buku</a></button>
        </div>
        <form action="import_buku.php" method="POST" enctype="multipart/form-data" class="import-book">
            <input type="file" name="file" required>
            <button type="submit" name="import">Import Buku</button>
        </form>
        <form action="" method="get" class="form-search">
            <div class="form-group">
                <input type="text" name="search" placeholder="Cari Buku" value="<?= $search; ?>">
                <button type="submit" class="search"><i class="fa-solid fa-search"></i></button>
            </div>
        </form>

        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori Buku</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = $start + 1;

                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["judul"]; ?></td>
                        <td><?php echo $row["nama_kategori"]; ?></td>
                        <td><?php echo $row["penulis"]; ?></td>
                        <td><?php echo $row["tahun_terbit"]; ?></td>
                        <td class="act-btn">
                            <a href="edit_buku.php?id_buku=<?php echo $row["id_buku"]; ?>" class="edit-btn">detail</a>
                            <a href="delete_buku.php?id_buku=<?php echo $row["id_buku"]; ?>" class="delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <?php
        // Pagination Links
        echo "<div class='pagination'>";

        // Tentukan batas pagination yang ditampilkan
        $pagination_range = 1; // Jumlah halaman sebelum dan sesudah halaman aktif

        // Tombol Previous
        if ($page > 1) {
            $prev_page = $page - 1;
            echo "<a href='?page=$prev_page&search=$search'><<</a> ";
        }

        // Link ke halaman pertama jika halaman aktif lebih dari range
        if ($page - $pagination_range > 1) {
            echo "<a href='?page=1&search=$search'>1</a> ";
            if ($page - $pagination_range > 2) {
                echo "... ";
            }
        }

        // Tampilkan halaman di sekitar halaman aktif
        for ($i = max(1, $page - $pagination_range); $i <= min($page + $pagination_range, $total_page); $i++) {
            if ($i == $page) {
                echo "<strong>$i</strong> "; // Halaman aktif
            } else {
                echo "<a href='?page=$i&search=$search'>$i</a> ";
            }
        }

        if ($page < $total_page) {
            $next_page = $page + 1;
            echo "<a href='?page=$next_page&search=$search'>>></a> ";
        }
        // Link ke halaman terakhir jika halaman aktif kurang dari total_page - range
        if ($page + $pagination_range < $total_page) {
            if ($page + $pagination_range < $total_page - 1) {
                echo "... ";
            }
            echo "<a href='?page=$total_page&search=$search'>Last</a> ";
        }

        // Tombol Next

        echo "</div>";

        ?>
    </div>
</main>
</div>
<?php include("footer.php") ?>