<?php
// Ambil data dari form login
$btn = $_POST['login'];
$user = $_POST['user'];
$pwd = $_POST['pwd'];
$pwd_enkripsi = md5($pwd);

// Baca data ke database dengan label user
include 'config/koneksi.php';
$sql = "SELECT * FROM user WHERE username='$user' AND password='$pwd_enkripsi'";
$query = mysqli_query($koneksi, $sql) or die("SQL Login Error");
$jumlahdata = mysqli_num_rows($query);
if ($jumlahdata > 0) {
    $data = mysqli_fetch_array($query); // Ambil data dan konversi menjadi array
    session_start(); // Aktifkan session wajib
    $_SESSION['username'] = $user;
    $_SESSION['idsesi'] = session_id();
    $_SESSION['level'] = $data['level'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['ket'] = $data['ket'];
    $_SESSION['email'] = $data['email'];
    // Redirect to index.php with success parameter
    header("Location: index.php?success=true");
} else {
    // Redirect to index.php with error parameter
    header("Location: index.php?error=true");
}
