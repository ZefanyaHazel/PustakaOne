<?php
require '../inc/koneksi.php';

// Cek apakah form sudah di-submit dan file diunggah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editBuku'])) {
    $id_buku = $_POST["id_buku"];
    $judul = $_POST["judul"];
    $kategori = $_POST["kategori"];
    $penulis = $_POST["penulis"];
    $penerbit = $_POST["penerbit"];
    $sinopsis = $_POST["sinopsis"];
    $tahunTerbit = $_POST["tahunTerbit"];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../img/";
        $img = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $img;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi file gambar
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Pindahkan file ke folder tujuan
            $oldImageQuery = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
            $result = mysqli_query($koneksi, $oldImageQuery);
            if ($row = mysqli_fetch_assoc($result)) {
                $old_image = $row['img'];
                if (file_exists("img/" . $old_image)) {
                    unlink("img/" . $old_image); // Hapus gambar lama
                }
            }
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Simpan path gambar ke database
                $tambah_buku = mysqli_query($koneksi, "UPDATE buku SET img = '$img', judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', sinopsis = '$sinopsis', tahun_terbit = '$tahunTerbit' WHERE id_buku = '$id_buku'");
                if ($tambah_buku) {
                    mysqli_query($koneksi, "UPDATE kategoribuku_relasi SET kategori_id = '$kategori' WHERE buku_id = '$id_buku'");
                }
            } else {
                echo "<script>alert('Terjadi kesalahan saat mengunggah file')</script>";
            }
        } else {
            echo "<script>alert('File bukan gambar')</script>";
        }
    } else {
        $tambah_buku = mysqli_query($koneksi, "UPDATE buku SET judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', sinopsis = '$sinopsis', tahun_terbit = '$tahunTerbit' WHERE id_buku = '$id_buku'");
        if ($tambah_buku) {
            mysqli_query($koneksi, "UPDATE kategoribuku_relasi SET kategori_id = '$kategori' WHERE buku_id = '$id_buku'");
        }
    }
    echo "<script>alert('Buku telah berhasil diubah!')</script>";
    echo "<script>document.location = 'edit_buku.php?id_buku=$id_buku'</script>";
    return false;
}
