<?php
session_start();
include("header.php");

if ($_SESSION["level"] != "admin" && $_SESSION["level"] != "petugas") {
    header("location: login.php");
    exit;
}
// Tentukan jumlah data yang akan ditampilkan per halaman
$limit = 4;

// Ambil halaman yang sedang aktif (default halaman 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Ambil kata kunci pencarian jika ada

// Query untuk menghitung total data (dengan pencarian jika ada)
if ($search) {
    $total_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user 
    WHERE level = 'user' AND
    (username LIKE '%$search%' 
    OR email LIKE '%$search%' 
    OR nama_lengkap LIKE '%$search%')");
} else {
    $total_result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM user WHERE level = 'user'");
}
$total_data = mysqli_fetch_assoc($total_result)['total'];

// Hitung total halaman
$total_page = ceil($total_data / $limit);

// Query untuk mengambil data sesuai limit dan pencarian
if ($search) {
    $result = "SELECT * FROM user
    WHERE level = 'user' AND
    (username LIKE '%$search%' OR
    email LIKE '%$search%' OR
    nama_lengkap LIKE '%$search%')
    LIMIT $start, $limit";
    $query = mysqli_query($koneksi, $result);
} else {
    $result = "SELECT * FROM user
    WHERE level = 'user'
    LIMIT $start, $limit";
    $query = mysqli_query($koneksi, $result);
}

?>

<main>
    <div class="title">
        <h2>Data Anggota</h2>
    </div>
    <div class="box-content">
        <div class="button-tambah">
            <button type="button"><a href="tambah_anggota.php">Tambah Anggota</a></button>
        </div>
        <form action="" method="get" class="form-search">
            <div class="form-group">
                <input type="text" name="search" placeholder="Cari" value="<?= $search; ?>">
                <button type="submit" class="search"><i class="fa-solid fa-search"></i></button>
            </div>
        </form>
        <table class="table">
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
                $i = $start + 1;

                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["nama_lengkap"]; ?></td>
                        <td class="act-btn">
                            <a href="edit_anggota.php?id=<?php echo $row["id_user"]; ?>" class="edit-btn">Edit</a>
                            <a href="delete_anggota.php?id=<?php echo $row["id_user"]; ?>" class="delete-btn">Delete</a>
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