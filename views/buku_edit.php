<?php

$id = $_GET['id'];
//select * from buku where id='$id' adalah mengambil semua data dari tabel buku dengan id='$id'
$ambil = mysqli_query($koneksi, "SELECT * FROM buku WHERE id ='$id'") or die("SQL Edit error");
$data = mysqli_fetch_array($ambil);

if ($_POST) {
    $id = $_POST['id'];
    $lokerbuku = $_POST['loker_buku'];
    $noRak = $_POST['noRak'];
    $noLaci = $_POST['noLaci'];
    $noBoks = $_POST['noBoks'];
    $judulbuku = $_POST['judul_buku'];
    $napengarang = $_POST['napengarang'];
    $tahunterbit = $_POST['tahun'] . "_" . $_POST['bulan'] . "_" . $_POST['tanggal'];
    $penerbit = $_POST['penerbit'];
    $penerima = $_POST['penerima'];
    $status = $_POST['status'];
    $ket = $_POST['ket'];

    $file_upload = $_FILES['gambar_buku'];

    // Handle file upload
    if ($file_upload['name'] != "") {
        $gambar_buku = $file_upload['name'];
        $upload_dir = "uploads/";
        $upload_file = $upload_dir . basename($gambar_buku);

        // Move uploaded file to the uploads folder
        if (move_uploaded_file($file_upload['tmp_name'], $upload_file)) {
            // Update database with new image
            $sql = "UPDATE buku SET loker_buku='$lokerbuku', no_rak='$noRak', no_laci='$noLaci', no_boks='$noBoks', judul_buku='$judulbuku',
            nama_pengarang='$napengarang', tahun_terbit='$tahunterbit', penerima='$penerima', penerbit='$penerbit', status='$status', keterangan='$ket', gambar_buku='$gambar_buku' WHERE id ='$id'";
        } else {
            die("Failed to upload image");
        }
    } else {
        // Update database without changing image
        $sql = "UPDATE buku SET loker_buku='$lokerbuku', no_rak='$noRak', no_laci='$noLaci', no_boks='$noBoks', judul_buku='$judulbuku',
        nama_pengarang='$napengarang', tahun_terbit='$tahunterbit', penerima='$penerima', penerbit='$penerbit', status='$status', keterangan='$ket' WHERE id ='$id'";
    }

    // Execute the query
    $query = mysqli_query($koneksi, $sql) or die("SQL Edit Error");

    if ($query) {
        echo "<script>
            swal({
                title: 'Success!',
                text: 'Data Buku berhasil diubah.',
                icon: 'success',
                button: 'OK'
            }).then(function() {
                window.location.assign('?page=buku&actions=tampil');
            });
        </script>";
    } else {
        echo "<script>
            swal({
                title: 'Error!',
                text: 'Edit Data Gagal.',
                icon: 'error',
                button: 'OK'
            });
        </script>";
    }
}
?>

<style>
     /* CSS untuk memposisikan tombol di tengah */
     .swal-footer {
        text-align: center;
    }
    .swal-button-container {
        display: inline-block;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Form Update Data Buku</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <div class="form-group">
                            <label for="loker_buku" class="col-sm-3 control-label">Loker Buku</label>
                            <div class="col-sm-2 col-xs-9">
                                <select name="loker_buku" class="form-control">
                                    <option value="Buku Pemrograman" <?= ($data['loker_buku'] == "Buku Pemrograman") ? "selected" : "" ?>>Buku Pemrograman</option>
                                    <option value="Buku Dongeng/Cerita Rakyat" <?= ($data['loker_buku'] == "Buku Dongeng/Cerita Rakyat") ? "selected" : "" ?>>Buku Dongeng/Cerita Rakyat</option>
                                    <option value="Buku Teknologi" <?= ($data['loker_buku'] == "Buku Teknologi") ? "selected" : "" ?>>Buku Teknologi</option>
                                    <option value="Buku Novel" <?= ($data['loker_buku'] == "Buku Novel") ? "selected" : "" ?>>Buku Novel</option>
                                    <option value="Buku Pembelajaran" <?= ($data['loker_buku'] == "Buku Pembelajaran") ? "selected" : "" ?>>Buku Pembelajaran</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="noRak" class="col-sm-3 control-label">Nomor Rak</label>
                            <div class="col-sm-9">
                                <input type="text" name="noRak" value="<?= $data['no_rak'] ?>" class="form-control" id="inputEmail3" placeholder="Nomor Rak/Lemari">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="noLaci" class="col-sm-3 control-label">Nomor Tingkat/Laci</label>
                            <div class="col-sm-9">
                                <input type="text" name="noLaci" value="<?= $data['no_laci'] ?>" class="form-control" id="inputEmail3" placeholder="Nomor Tingkat/Laci">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="noBoks" class="col-sm-3 control-label">Nomor Boks</label>
                            <div class="col-sm-9">
                                <input type="text" name="noBoks" value="<?= $data['no_boks'] ?>" class="form-control" id="inputEmail3" placeholder="Nomor Boks">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="judul_buku" class="col-sm-3 control-label">Judul Buku</label>
                            <div class="col-sm-9">
                                <input type="text" name="judul_buku" value="<?= $data['judul_buku'] ?>" class="form-control" id="inputEmail3" placeholder="Judul Buku">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="napengarang" class="col-sm-3 control-label">Nama Pengarang</label>
                            <div class="col-sm-9">
                                <input type="text" name="napengarang" value="<?= $data['nama_pengarang'] ?>" class="form-control" id="inputEmail3" placeholder="Nama Pengarang">
                            </div>
                        </div>
                        <!--untuk tanggal terbit form tahun-bulan-tanggal-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tahun Terbit</label>
                            <!--untuk tahun-->
                            <div class="col-sm-2 col-xs-9">
                                <select name="tahun" class="form-control">
                                    <?php for ($i = 2030; $i > 1980; $i--) { ?>
                                        <option value="<?= $i ?>" <?= substr($data['tahun_terbit'], 0, 4) == $i ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!--untuk bulan-->
                            <div class="col-sm-2 col-xs-9">
                                <select name="bulan" class="form-control">
                                    <?php
                                    $bulan =  array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                    for ($j = 1; $j <= 12; $j++) { ?>
                                        <option value="<?= $j ?>" <?= intval(substr($data['tahun_terbit'], 5, 2)) == $j ? 'selected' : '' ?>><?= $bulan[$j] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!--untuk tanggal-->
                            <div class="col-sm-2 col-xs-9">
                                <select name="tanggal" class="form-control">
                                    <?php for ($k = 1; $k <= 31; $k++) { ?>
                                        <option value="<?= $k ?>" <?= intval(substr($data['tahun_terbit'], 8, 2)) == $k ? 'selected' : '' ?>><?= $k ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!--end tanggal terbit-->
                        <div class="form-group">
                            <label for="penerbit" class="col-sm-3 control-label">Penerbit Buku</label>
                            <div class="col-sm-9">
                                <input type="text" name="penerbit" value="<?= $data['penerbit'] ?>" class="form-control" id="inputPassword3" placeholder="Penerbit Buku">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penerima" class="col-sm-3 control-label">Penerima Buku</label>
                            <div class="col-sm-9">
                                <input type="text" name="penerima" value="<?= $data['penerima'] ?>" class="form-control" id="inputPassword3" placeholder="Penerima Buku">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status Buku</label>
                            <div class="col-sm-9">
                                <select name="status" class="form-control">
                                    <option value="Ada" <?= ($data['status'] == "Ada") ? "selected" : "" ?>>Ada</option>
                                    <option value="Dipinjam" <?= ($data['status'] == "Dipinjam") ? "selected" : "" ?>>Dipinjam</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="col-sm-3 control-label">Keterangan Buku</label>
                            <div class="col-sm-9">
                                <textarea name="ket" class="form-control" id="inputPassword3" placeholder="Keterangan"><?= $data['keterangan'] ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambar_buku" class="col-sm-3 control-label">Gambar Buku</label>
                            <div class="col-sm-9">
                                <input type="file" name="gambar_buku" class="form-control" id="gambar_buku">
                                <?php if (!empty($data['gambar_buku'])): ?>
                                    <img src="uploads/<?= $data['gambar_buku'] ?>" width="100px" height="100px" class="rounded mt-2">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-edit"></span> Update Data Buku
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <a href="?page=buku&actions=tampil" class="btn btn-danger btn-sm">
                        Kembali Ke Data Buku
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>