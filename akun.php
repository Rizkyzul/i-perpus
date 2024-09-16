<div class="container">
    <div class="navbar-header-">
        <?php if (isset($_SESSION['username'])) { ?>
            <p align="right" style="color: white">Anda masuk sebagai <strong><?= $_SESSION['username'] ?></strong> | <?= $_SESSION['ket'] ?></p>
        <?php  } else {
        } ?>

    </div>
</div>