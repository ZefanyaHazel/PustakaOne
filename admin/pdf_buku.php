<?php
// Koneksi ke database
include("../inc/koneksi.php");
// Mengambil data yang disaring
$q = mysqli_query($koneksi, "SELECT * FROM buku
JOIN kategoribuku_relasi ON `kategoribuku_relasi`.`buku_id` = `buku`.`id_buku`
JOIN kategori_buku ON `kategoribuku_relasi`.`kategori_id` = `kategori_buku`.`id_kategori`
 ORDER BY tahun_terbit DESC");

// Inklusi pustaka FPDF
require('../fpdf/fpdf.php');

// Membuat objek PDF
$pdf = new FPDF();
$pdf->AddPage();

// Membuat judul laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Data Buku', 0, 1, 'C');

// Menambahkan sedikit ruang
$pdf->Ln(10);

// Membuat header tabel
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(5, 10, 'No', 1);
$pdf->Cell(80, 10, 'Judul', 1);
$pdf->Cell(20, 10, 'Kategori', 1);
$pdf->Cell(20, 10, 'Penulis', 1);
$pdf->Cell(40, 10, 'Penerbit', 1);
$pdf->Cell(20, 10, 'Release', 1);
$pdf->Ln();

// Mengisi data ke tabel
$pdf->SetFont('Arial', '', 6);
$no = 1;

if (mysqli_num_rows($q) > 0) {
    while ($row = mysqli_fetch_assoc($q)) {
        $pdf->Cell(5, 10, $no++, 1);
        $pdf->Cell(80, 10, $row['judul'], 1);
        $pdf->Cell(20, 10, $row['nama_kategori'], 1);
        $pdf->Cell(20, 10, $row['penulis'], 1);
        $pdf->Cell(40, 10, $row['penerbit'], 1);
        $pdf->Cell(20, 10, $row['tahun_terbit'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'Tidak ada data ditemukan', 1, 1, 'C');
}

// Output file PDF ke browser
$pdf->Output('D', 'laporan_buku ' . date('d-m-Y') . '.pdf');
?>
