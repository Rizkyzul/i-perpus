<!-- SweetAlert CDN -->
 <head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
<link rel="stylesheet" href="style/menu.css">
</head>

<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?page=utama" style="padding: auto;"><b>CARUMBAN E-PERPUS</b></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="<?= (!isset($_GET['page']) || $_GET['page'] == 'utama') ? 'active' : '' ?>"><a href="?page=utama">Beranda</a></li>

                    <?php if (isset($_SESSION['level']) && $_SESSION['level'] == 1) { ?>
                        <li class="dropdown <?= (isset($_GET['page']) && $_GET['page'] == 'buku') ? 'active' : '' ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Data <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'buku' && isset($_GET['actions']) && $_GET['actions'] == 'tampil') ? 'active' : '' ?>"><a href="?page=buku&actions=tampil">Daftar Buku</a></li>
                                <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'peminjaman' && isset($_GET['actions']) && $_GET['actions'] == 'tampil') ? 'active' : '' ?>"><a href="?page=peminjaman&actions=tampil">Peminjaman</a></li>
                            </ul>
                        </li>
                        <li class="dropdown <?= (isset($_GET['page']) && $_GET['page'] == 'report') ? 'active' : '' ?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'buku' && isset($_GET['actions']) && $_GET['actions'] == 'report') ? 'active' : '' ?>"><a href="?page=buku&actions=report">Laporan Daftar Buku</a></li>
                                <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'peminjaman' && isset($_GET['actions']) && $_GET['actions'] == 'report') ? 'active' : '' ?>"><a href="?page=peminjaman&actions=report">Laporan Pinjaman</a></li>
                            </ul>
                        </li>
                        <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'user') ? 'active' : '' ?>"><a href="?page=user&actions=tampil">User</a></li>
                    <?php } ?>
                    <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'about') ? 'active' : '' ?>"><a href="?page=about&actions=tampil">Tentang Kami</a></li>
                    <li class="<?= (isset($_GET['page']) && $_GET['page'] == 'kontak') ? 'active' : '' ?>"><a href="?page=kontak&actions=tampil">Kontak</a></li>

                    <?php if (isset($_SESSION['username'])) { ?>
                        <li><a href="#" onclick="confirmLogout()">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Script untuk konfirmasi logout -->
    <script>
        function confirmLogout() {
            swal({
                title: "Apakah Anda yakin ingin logout?",
                text: "Anda akan keluar dari sesi ini.",
                icon: "warning",
                buttons: {
                    cancel: "Batal",
                    confirm: {
                        text: "Logout!",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                },
                dangerMode: true
            }).then((willLogout) => {
                if (willLogout) {
                    window.location.href = 'logout.php';
                }
            });
        }
    </script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>