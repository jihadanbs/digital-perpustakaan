<?= $this->include('user/layouts/script') ?>
<style>
    .custom-alert {
        font-size: 12px;
    }
</style>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="/" class="d-block auth-logo" target="_blank">
                                        <img src="<?= base_url('assets/img/binmas.png') ?>" alt="" height="28"> <span class="logo-txt">Polsek Kayu Aro</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Reset Password ?</h5>
                                        <p class="text-muted mt-2">Silahkan Isi Data Dibawah !</p>
                                    </div>
                                    <?php $session = \Config\Services::session(); ?>
                                    <?php if (session()->getFlashdata('pesan')) : ?>
                                        <div class="alert alert-success alert-border-left alert-dismissible fade show custom-alert" role="alert">
                                            <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                            <?= session()->getFlashdata('pesan') ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (session()->getFlashdata('success')) : ?>
                                        <div class="alert alert-success alert-border-left alert-dismissible fade show custom-alert" role="alert">
                                            <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                            <?= session()->getFlashdata('success') ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (session()->getFlashdata('gagal')) : ?>
                                        <div class="alert alert-danger alert-border-left alert-dismissible fade show custom-alert" role="alert">
                                            <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                            <?= session()->getFlashdata('gagal') ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>

                                    <form action="" method="POST" class="mt-4 pt-2">
                                        <?= csrf_field() ?>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Password</label>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan kata sandi" value="<?= old('password') ?>" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                            <?php if (isset(session()->getFlashdata('validation')['password'])) : ?>
                                                <div class="text-danger">
                                                    <?= session()->getFlashdata('validation')['password'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex align-items-start">
                                                <div class="flex-grow-1">
                                                    <label class="form-label">Konfirmasi Password</label>
                                                </div>
                                            </div>

                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" id="konfirmasi_password" name="konfirmasi_password" class="form-control" placeholder="Masukkan kata sandi" value="<?= old('konfirmasi_password') ?>" aria-label="konfirmasi_password" aria-describedby="konfirmasi-password-addon">
                                                <button class="btn btn-light shadow-none ms-0" type="button" id="konfirmasi-password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                            <?php if (isset(session()->getFlashdata('validation')['konfirmasi_password'])) : ?>
                                                <div class="text-danger">
                                                    <?= session()->getFlashdata('validation')['konfirmasi_password'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="row mb-4"></div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Submit</button>
                                        </div>
                                    </form>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Lupa Password ? <a href="/authentication/lupaPassword" class="text-primary fw-semibold">Klik disini</a> </p>
                                    </div>
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())
                                        </script> Polsek Kayu Aro . Dibuat Dengan <i class="mdi mdi-heart text-danger"></i> Oleh Reissa Giana Azaria</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <?= $this->include('user/layouts/animasiAuth') ?>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <?= $this->include('user/layouts/script2') ?>

</body>

</html>