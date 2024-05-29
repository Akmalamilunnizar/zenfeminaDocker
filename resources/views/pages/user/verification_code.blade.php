

<!-- Template Main CSS File -->
<link href="/assetsWeb/css/style.css" rel="stylesheet">
<title>Page: Verifikasi-kode</title>
</head>

<body>

<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <p style="font-size: 22px; text-align: center; margin-bottom: 5px">Masukkan kode verifikasi</p>
                                    <p style="font-size: 13px; color: #899bbd; text-align: center; margin-left: 15px; margin-right: 15px;">
                                        Kode verifikasi telah dikirim melalui e-mail ke email yang terdaftar
                                    </p>
                                </div>

                                <?php if(isset($params['error'])) { ?>
                                    <div class="row">
                                        <div class="alert alert-danger" role="alert">
                                            <?= $params['error'] ?>
                                        </div>
                                    </div>
                                <?php } ?>

                                <form class="row g-3 needs-validation" method="post" action="/verificationCode" novalidate>
                                    <div>
                                        <input type="text" name="code" class="custom-input" id="code" required>
                                        <input type="hidden" name="verification_id" id="verification_id" value="<?= $id; ?>">
                                        <div class="invalid-feedback" style="text-align: center">Please enter your code!</div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" id="manual" name="manual" style="font-size: 14px; padding: 6px" >Lanjutkan</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');

        toggleButton.addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.classList.remove('bi-eye-fill');
                toggleButton.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                toggleButton.classList.remove('bi-eye-slash-fill');
                toggleButton.classList.add('bi-eye-fill');
            }
        });
    });

</script>
