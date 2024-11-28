<?php
// Include library PHPSpreadsheet
require '../vendor/autoload.php';
require '../inc/koneksi.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['import'])) {
    $file_mimes = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = IOFactory::createReader('Csv');
        } elseif ('xls' == $extension) {
            $reader = IOFactory::createReader('Xls');
        } else {
            $reader = IOFactory::createReader('Xlsx');
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        // Looping data dari Excel dan insert ke database
        for ($i = 1; $i < count($sheetData); $i++) {
            $judul = $sheetData[$i][0]; // Sesuaikan dengan kolom di file Excel
            $penulis = $sheetData[$i][1]; // Sesuaikan dengan kolom di file Excel
            $penerbit = $sheetData[$i][2]; // Sesuaikan dengan kolom di file Excel
            $tahun_terbit_raw = $sheetData[$i][3];
            if (!empty($tahun_terbit_raw) && strtotime($tahun_terbit_raw) !== false) {
                $tahun_terbit = date('Y-m-d', strtotime($tahun_terbit_raw));
            } else {
                $tahun_terbit = null;
            }
            $kategori = $sheetData[$i][4]; // Sesuaikan dengan kolom di file Excel

            $sql = mysqli_query($koneksi, "SELECT * FROM kategori_buku WHERE nama_kategori = '$kategori'");
            $row = mysqli_fetch_assoc($sql);

            if ($row) {
                $result = mysqli_query($koneksi, "INSERT INTO buku VALUES(NULL, '$judul', '$penulis', '$penerbit', '$tahun_terbit')");

                if ($result) {
                    $id_buku = mysqli_insert_id($koneksi);
                    $id_kategori = $row["id_kategori"];

                    mysqli_query($koneksi, "INSERT INTO kategoribuku_relasi VALUES(NULL,'$id_buku', '$id_kategori')");
                }
            }
        }
        echo "<script>alert('Buku berhasil diimport!')</script>";
        echo "<script>document.location = 'buku.php'</script>";
        return false;
    } else {
        echo "<script>alert('Format file tidak didukung!')</script>";
        echo "<script>document.location = 'buku.php'</script>";
        return false;
    }
}
