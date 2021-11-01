<?= $this->extend('install/template'); ?>
<?= $this->section('content'); ?>

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <h1>
                            <a href="<?= base_url(); ?>">
                                UNIQUE Installer
                            </a>
                        </h1>
                    </div>
                    <div class="login-form">
                        <center>
                            <center>
                                <a href="<?= $logingoogle; ?>" class="btn btn-success btn-user btn-block">Tambah User Via Google</a>
                            </center>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>