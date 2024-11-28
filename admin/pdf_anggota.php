<?php
// Koneksi ke database
include("../inc/koneksi.php");
// Mengambil data yang disaring
$q = mysqli_query($koneksi, "SELECT * FROM user WHERE level='user'");

// Inklusi pustaka FPDF
require('../fpdf/fpdf.php');

// Membuat objek PDF
$pdf = new FPDF();
$pdf->AddPage();

// Membuat judul laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Anggota', 0, 1, 'C');

// Menambahkan sedikit ruang
$pdf->Ln(10);

// Membuat header tabel
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(5, 10, 'No', 1);
$pdf->Cell(30, 10, 'Username', 1);
$pdf->Cell(40, 10, 'Email', 1);
$pdf->Cell(40, 10, 'Nama Lengkap', 1);
$pdf->Cell(80, 10, 'Alamat', 1);
$pdf->Ln();

// Mengisi data ke tabel
$pdf->SetFont('Arial', '', 6);
$no = 1;

if (mysqli_num_rows($q) > 0) {
    while ($row = mysqli_fetch_assoc($q)) {
        $pdf->Cell(5, 10, $no++, 1);
        $pdf->Cell(30, 10, $row['username'], 1);
        $pdf->Cell(40, 10, $row['email'], 1);
        $pdf->Cell(40, 10, $row['nama_lengkap'], 1);
        $pdf->Cell(80, 10, $row['alamat'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'Tidak ada data ditemukan', 1, 1, 'C');
}

// Output file PDF ke browser
$pdf->Output('D', 'laporan_anggota ' . date('d-m-Y') . '.pdf');
?>
