<?= $this->extend('auth/template'); ?>
<?= $this->section('content'); ?>

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <h1>
                            <a href="<?= base_url('login'); ?>">
                                UNIQUE
                            </a>
                        </h1>
                    </div>
                    <div class="login-form">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4"><?= lang('Auth.loginTitle') ?></h1>
                        </div>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <form class="user" action="<?= route_to('login') ?>" method="post">
                            <?= csrf_field() ?>
                            <?php if ($config->validFields === ['email']) : ?>
                                <div class="form-group">
                                    <input type="email" class="au-input au-input--full <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <input type="text" class="au-input au-input--full <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="password" name="password" class="au-input au-input--full <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>
                            <hr>
                            <?php if ($config->allowRemembering) : ?>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                        <?= lang('Auth.rememberMe') ?>
                                    </label>
                                </div>
                            <?php endif; ?>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-user btn-block"><?= lang('Auth.loginAction') ?></button>
                            <hr>
                            <?php
                            $this->google = new \Google_Client();;
                            $this->google->setClientId('935030474584-ppg52lsgm2b3vmloph8okrbbdmu278b6.apps.googleusercontent.com');
                            $this->google->setClientSecret('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');
                            $this->google->setRedirectUri(base_url('authgoogle'));
                            $this->google->addScope('email');
                            $this->google->addScope('profile');
                            $logingoogle = $this->google->createAuthUrl();
                            ?>
                            <center>
                                <a href="<?= $logingoogle; ?>" class="btn btn-success btn-user btn-block">Login Google</a>
                            </center>
                        </form>
                        <hr>
                        <div class="text-center">
                            <?php if ($config->activeResetter) : ?>
                                <a class="small" href="<?= route_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="register-link">
                            <h3>
                                <?php if ($config->allowRegistration) : ?>
                                    <a class="small" href="<?= route_to('register') ?>"><?= lang('Auth.needAnAccount') ?> Register</a>
                                <?php endif; ?>
                            </h3>
                        </div>
                        <!-- <div class="register-link">
                            <p>
                                Don't you have account?
                                <a href="#">Sign Up Here</a>
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('gagal')) : ?>
    <?php
    $flash = session()->getFlashdata('gagal');
    $pesan = $flash['pesan'];
    $value = $flash['value'];
    ?>
    <script type="text/javascript">
        var pesan = '<?= $pesan ?>';
        var value = '<?= $value ?>';
        let timerInterval
        Swal.fire({
            icon: 'error',
            title: pesan,
            html: value,
            timer: 5000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                timerInterval = setInterval(() => 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {}
        })
    </script>
<?php endif; ?>

<?= $this->endSection(); ?>