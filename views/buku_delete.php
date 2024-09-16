

<?php

$id = $_GET['id'];
$ambil = mysqli_query($koneksi, "SELECT * FROM buku WHERE id ='$id'") or die("SQL Edit error");
$data = mysqli_fetch_array($ambil);


//membuat query delete
$sql = "DELETE FROM buku WHERE id ='" . $_GET['id'] . "'";
unlink("uploads/" . $data['gambar_buku']);
$query = mysqli_query($koneksi, $sql) or die("SQL Hapus Error");


if($query){
    //redirect ke halaman index.php
    //dan status success
    echo "<script>window.location.href = '?page=buku&actions=tampil&status=success'</script>";
} else {
    //redirect ke halaman index.php
    //dan status error
    echo "<script>window.location.href = ?page=buku&actions=tampil&status=error'</script>";
}