<?php
require '../inc/koneksi.php';

// Cek apakah form sudah di-submit dan file diunggah
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $id_user = $_POST["id_user"];
    $judul = mysqli_real_escape_string($koneksi, $_POST["judul"]);
    $kategori = $_POST["kategori"];
    $penulis = mysqli_real_escape_string($koneksi, $_POST["penulis"]);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST["penerbit"]);
    $sinopsis = mysqli_real_escape_string($koneksi, $_POST["sinopsis"]);
    $tahunTerbit = $_POST["tahunTerbit"];
    $target_dir = "../img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file gambar
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Simpan path gambar ke database
            $tambah_buku = mysqli_query($koneksi, "INSERT INTO buku VALUES (NULL, '$target_file', '$judul', '$penulis', '$penerbit', '$sinopsis', '$tahunTerbit')");
            if ($tambah_buku) {
                $id_buku = mysqli_insert_id($koneksi);
                mysqli_query($koneksi, "INSERT INTO kategoribuku_relasi VALUES(NULL,'$id_buku', '$kategori')");
                if ($id_user != NULL) {
                    mysqli_query($koneksi, "INSERT INTO koleksi_pribadi VALUES(NULL,'$id_user', '$id_buku')");
                }
            }
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah file')</script>";
        }
    } else {
        echo "<script>alert('File bukan gambar')</script>";
    }
    echo "<script>alert('Buku telah berhasil ditambahkan!')</script>";
    echo "<script>document.location = 'buku.php'</script>";
    return false;
}
