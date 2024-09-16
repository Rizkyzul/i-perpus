<?php session_start();
//Aktifkan session

require 'config/koneksi.php'; ?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>Sistem Infromasi Perpustakaan Jendela Ilmu</title>
    <link rel="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!--<link href="Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
    <link href="Assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="Assets/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="style/index_admin.css">
</head>

<body>

    <!-- Spinner HTML -->
    <div class="spinner-overlay" id="spinner">
        <div class="spinner"></div>
    </div>


    <?php
    require 'akun.php';
    ?>

    <?php
    require 'menu.php';
    ?>

    <?php
    require 'content_admin.php';
    ?>

    <?php
    require 'footer.php';
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="Assets/js/jquery.js" type="text/javascript"></script>
    <script src="Assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="Assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="Assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(window).on('load', function() {
            $('#spinner').fadeOut('slow');
        });

        $(function() {
            $('#deskripsi').dataTable();
        });
    </script>

</body>

</html>