<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpus_usk";

$koneksi = mysqli_connect($host, $user, $pass, $db);

function register_user($data)
{
    global $koneksi;

    $username = $data["username"];
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $email = $data["email"];
    $namaLengkap = $data["namaLengkap"];
    $alamat = $data["alamat"];
    $level = $data["level"];

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username telah tersedia!')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_BCRYPT);
    mysqli_query($koneksi, "INSERT INTO user VALUES(NULL, '$username', '$password', '$email', '$namaLengkap', '$alamat', '$level')");

    return true;
}

function tambah_user($data)
{
    global $koneksi;
    $username = $data["username"];
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $email = $data["email"];
    $namaLengkap = $data["namaLengkap"];
    $alamat = $data["alamat"];
    if ($_SESSION["level_user"] == "user") {
        $level = "user";
    } else {
        $level = "petugas";
    }
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username telah tersedia!')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_BCRYPT);
    mysqli_query($koneksi, "INSERT INTO user VALUES(NULL, '$username', '$password', '$email', '$namaLengkap', '$alamat', '$level')");

    return true;
}
function ubah_user($data)
{
    global $koneksi;

    $id = $data["id_user"];
    $username = $data["username"];
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $email = $data["email"];
    $namaLengkap = $data["namaLengkap"];
    $alamat = $data["alamat"];

    if ($_SESSION["level_user"] == "user") {
        $level = "user";
    } else {
        $level = "petugas";
    }

    $q = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'");
    $user_old = mysqli_fetch_assoc($q);

    $result = mysqli_query($koneksi, "SELECT username FROM user WHERE username='$username'");

    if (mysqli_fetch_assoc($result)) {
        if ($user_old["username"] != $username) {
            echo "<script>alert('Gagal');</script>";
            return false;
        }
    }

    $password = password_hash($password, PASSWORD_BCRYPT);
    mysqli_query($koneksi, "UPDATE user SET username = '$username', password = '$password', email =  '$email', nama_lengkap = '$namaLengkap', alamat = '$alamat', level = '$level' WHERE id_user = '$id' ");

    return mysqli_affected_rows($koneksi);
}
function hapus_user($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id'");

    return true;
}

function tambah_kategori($data)
{
    global $koneksi;

    $namaKategori = $data["namaKategori"];

    $result = mysqli_query($koneksi, "SELECT nama_kategori FROM kategori_buku WHERE nama_kategori='$namaKategori'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Nama kategori telah tersedia!')</script>";
        return false;
    }
    mysqli_query($koneksi, "INSERT INTO kategori_buku VALUES(NULL, '$namaKategori')");

    return true;
}
function ubah_kategori($data)
{
    global $koneksi;

    $id = $data["id_kategori"];
    $nama_kategori = $data["nama_kategori"];
    mysqli_query($koneksi, "UPDATE kategori_buku SET nama_kategori='$nama_kategori' WHERE id_kategori = '$id'");

    return true;
}
function hapus_kategori($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM kategori_buku WHERE id_kategori = '$id'");
    return mysqli_affected_rows($koneksi);
}
function tambah_buku($data)
{
    global $koneksi;

    $id_user = $data["id_user"];
    $judul = $data["judul"];
    $kategori = $data["kategori"];
    $penulis = $data["penulis"];
    $penerbit = $data["penerbit"];
    $tahunTerbit = $data["tahunTerbit"];
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file gambar
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Simpan path gambar ke database
            $tambah_buku = mysqli_query($koneksi, "INSERT INTO buku VALUES (NULL, '$target_file' '$judul', '$penulis', '$penerbit', '$tahunTerbit')");
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
    return true;
}
function edit_buku($data)
{
    global $koneksi;

    $id_buku = $data["id_buku"];
    $judul = $data["judul"];
    $penulis = $data["penulis"];
    $kategori = $data["kategori"];
    $penerbit = $data["penerbit"];
    $tahun_terbit = $data["tahunTerbit"];

    $q = mysqli_query($koneksi, "UPDATE buku SET judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit' WHERE id_buku = '$id_buku'");
    if ($q) {
        mysqli_query($koneksi, "UPDATE kategoribuku_relasi SET kategori_id = '$kategori' WHERE buku_id = '$id_buku'");
    }
    return true;
}
function hapus_buku($id)
{
    global $koneksi;

    mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = '$id'");
    return true;
}
function tambah_relasi($data)
{
    global $koneksi;

    $judul = $data["judul"];
    $kategori = implode(",", $data["kategori"]);

    mysqli_query($koneksi, "INSERT INTO kategoribuku_relasi VALUES(NULL, '$judul', '$kategori')");

    return true;
}
function tambah_peminjaman($data)
{
    global $koneksi;

    $user_id = $data["nama"];
    $buku_id = $data["buku"];
    $durasi = $data["durasi"];
    $status = "dipinjam";

    $q = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE user_id = $user_id AND buku_id = $buku_id AND status_peminjaman = '$status'");
    if (mysqli_fetch_array($q)) {
        echo "<script>alert('User masih meminjam buku yang sama!')</script>";
        return false;
    }
    mysqli_query($koneksi, "INSERT INTO peminjaman VALUES(NULL, '$user_id', '$buku_id', NOW(), DATE_ADD(NOW(), INTERVAL $durasi DAY), '$status')");

    return true;
}
