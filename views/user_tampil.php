<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

    <style>
        /* CSS untuk memposisikan tombol di tengah */
        .swal-footer {
            text-align: center;
        }

        .swal-button-container {
            display: inline-block;
        }
    </style>

    <?php
    if (!isset($_SESSION['idsesi'])) {
        echo "<script> window.location.assign('../index.php'); </script>";
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="fa fa-user-plus"></span> Data User</h3>
                    </div>
                    <div class="panel-body">
                        <table id="deskripsi" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>User Name</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Nama Pengguna</th>
                                    <!--<th>Tahun Terbit</th>-->
                                    <th>Level</th>
                                    <th>Ket</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //buat sql untuk tampilan data, gunakan kata kunci select
                                $sql = "SELECT * FROM user";
                                $query = mysqli_query($koneksi, $sql) or die("SQL Anda Salah");
                                //Baca hasil query dari databse, gunakan perulangan untuk 
                                //Menampilkan data lebh dari satu. disini akan digunakan
                                //while dan fungdi mysqli_fecth_array
                                //Membuat variabel untuk menampilkan nomor urut
                                $nomor = 0;
                                //Melakukan perulangan u/menampilkan data
                                while ($data = mysqli_fetch_array($query)) {
                                    $nomor++; //Penambahan satu untuk nilai var nomor
                                    $id = $data['username']; // Ambil ID dari data

                                    $data = array_reverse($data);
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $nomor ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['password'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['level'] ?></td>
                                        <td><?= $data['ket'] ?></td>
                                        <td class="text-center">
                                            <a href="?page=user&actions=detail&id=<?= $data['username'] ?>" class="btn btn-info btn-xs">
                                                <span class="fa fa-eye"></span>
                                            </a>
                                            <a href="?page=user&actions=edit&id=<?= $data['username'] ?>" class="btn btn-warning btn-xs">
                                                <span class="fa fa-edit"></span>
                                            </a>     
                                            <a href="javascript:void(0);" onclick="confirmDelete('<?= $data['username'] ?>')" class="btn btn-danger btn-xs">
                                                <span class="fa fa-remove"></span>
                                            </a>

                                        </td>
                                    </tr>
                                    <!--Tutup Perulangan data-->
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <a href="?page=user&actions=tambah" class="btn btn-info btn-sm">
                                            Tambah User
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- Script untuk konfirmasi Delete -->
    <script>
    function confirmDelete(username) {
        swal({
            title: "Apakah Anda yakin ingin menghapus data User ini?",
            text: "Anda tidak akan bisa mengembalikan data ini!",
            icon: "warning",
            buttons: {
                cancel: "Batal",
                confirm: {
                    text: "Ya, Hapus!",
                    value: true,
                    visible: true,
                    className: "btn-danger",
                    closeModal: false // Ini akan mencegah swal ditutup sebelum aksi selesai
                }
            },
            dangerMode: true
        }).then((willDelete) => {
            if (willDelete) {
                // Hanya jika pengguna mengkonfirmasi, kita akan melakukan redirect
                window.location.href = '?page=user&actions=delete&id=' + username;
            } else {
                swal("Penghapusan dibatalkan!", {
                    icon: "info",
                });
            }
        });
    }
    </script>

    
    ?>