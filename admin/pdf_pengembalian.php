<?php
// Koneksi ke database
include("../inc/koneksi.php");
// Mengambil data yang disaring
$q = mysqli_query($koneksi, "SELECT * FROM peminjaman, buku, user WHERE user_id = id_user AND buku_id = id_buku AND status_peminjaman = 'dikembalikan' ORDER BY tanggal_pengembalian DESC");

// Inklusi pustaka FPDF
require('../fpdf/fpdf.php');

// Membuat objek PDF
$pdf = new FPDF();
$pdf->AddPage();

// Membuat judul laporan
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Laporan Data Pengembalian Buku', 0, 1, 'C');

// Menambahkan sedikit ruang
$pdf->Ln(10);

// Membuat header tabel
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(5, 10, 'No', 1);
$pdf->Cell(30, 10, 'Nama', 1);
$pdf->Cell(80, 10, 'Judul', 1);
$pdf->Cell(40, 10, 'Tanggal Peminjaman', 1);
$pdf->Cell(40, 10, 'Tanggal Pengembalian', 1);
$pdf->Ln();

// Mengisi data ke tabel
$pdf->SetFont('Arial', '', 6);
$no = 1;

if (mysqli_num_rows($q) > 0) {
    while ($row = mysqli_fetch_assoc($q)) {
        $pdf->Cell(5, 10, $no++, 1);
        $pdf->Cell(30, 10, $row['nama_lengkap'], 1);
        $pdf->Cell(80, 10, $row['judul'], 1);
        $pdf->Cell(40, 10, $row['tanggal_peminjaman'], 1);
        $pdf->Cell(40, 10, $row['tanggal_pengembalian'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'Tidak ada data ditemukan', 1, 1, 'C');
}

// Output file PDF ke browser
$pdf->Output('D', 'laporan_pengembalian_buku ' . date('d-m-Y') . '.pdf');
?>
