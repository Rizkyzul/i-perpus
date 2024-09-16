<?php



//membuat query delete
$sql = "DELETE FROM peminjaman WHERE id ='" . $_GET['id'] . "'";
$query = mysqli_query($koneksi, $sql) or die("SQL Hapus Error");


if($query){
    //redirect ke halaman index.php
    //dan status success
    echo "<script>window.location.href = '?page=pemijaman&actions=tampil&status=success'</script>";
} else {
    //redirect ke halaman index.php
    //dan status error
    echo "<script>window.location.href = ?page=peminjaman&actions=tampil&status=error'</script>";
}