<?php
// Mendapatkan username dari parameter GET
$username = $_GET['id'];

// Query untuk menghapus data user berdasarkan username
$sql = "DELETE FROM user WHERE username = '$username'";

// Eksekusi query
$query = mysqli_query($koneksi, $sql) or die("SQL Hapus error: " . mysqli_error($koneksi));

// Cek apakah query berhasil dijalankan
if ($query) {
    // Redirect ke halaman tampil dengan status sukses
    echo "<script>window.location.href = '?page=user&actions=tampil&status=success';</script>";
} else {
    // Redirect ke halaman tampil dengan status gagal
    echo "<script>window.location.href = '?page=user&actions=tampil&status=error';</script>";
}
?>