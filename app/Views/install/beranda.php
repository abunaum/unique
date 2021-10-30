<?= $this->extend('install/template'); ?>
<?= $this->section('content'); ?>

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <h1>
                            <a href="<?= base_url('login'); ?>">
                                UNIQUE Installer
                            </a>
                        </h1>
                    </div>
                    <div class="login-form">
                        <center>
                            <form action="<?= base_url('cekdb') ?>" method="get">
                                <?php
                                if (session('koneksi_info')) {
                                    echo session('koneksi_status');
                                    echo '<br>';
                                    echo session('koneksi_info');
                                }
                                ?>
                                <div class="mb-3">
                                    <label for="dbname" class="form-label">Nama DB</label>
                                    <input type="text" class="form-control" id="dbname" name="dbname" placeholder="unique_db">
                                </div>
                                <div class="mb-3">
                                    <label for="userdb" class="form-label">User DB</label>
                                    <input type="text" class="form-control" id="userdb" name="userdb" placeholder="unique_db">
                                </div>
                                <div class="mb-3">
                                    <label for="passworddb" class="form-label">Password DB</label>
                                    <input type="password" class="form-control" id="passworddb" name="passworddb">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Cek</button>
                            </form>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>