@extends('layout.auth')

@push('styles')
    <link rel="stylesheet" href="{{ asset('resources/sass/app.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/sass/pages/auth.css') }}">
@endpush

@section('content')


<link href="/assetsWeb/css/style.css" rel="stylesheet">
<title>Page: Verifikasi-email</title>
</head>

<body style="overflow: hidden;"> <!-- Atur overflow ke hidden -->

<main style="height: 100vh; overflow-y: auto;"> <!-- Atur tinggi menjadi 100vh -->
    <div class="container">

        <section
            class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="pt-4 pb-2">
                                    <h5 class="text-center pb-0 fs-4"
                                        style="padding: 0px; margin-bottom: 10px; font-weight: 600">
                                        Atur ulang kata sandi
                                    </h5>
                                    <p
                                        style="font-size: 13px; color: #899bbd; padding: 0px 10px; text-align: center; margin-bottom: 20px">
                                        Masukkan e-mail yang terdaftar, kami akan mengirimkan kode verifikasi untuk
                                        atur ulang kata sandi.
                                    </p>
                                </div>

                                <?php if (isset($params['error'])) { ?>
                                <div class="row">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $params['error'] ?>
                                    </div>
                                </div>
                                <?php } ?>


                                <form class="row g-3 needs-validation" method="post" action="/verificationEmail"
                                    novalidate>

                                    <div class="col-12" style="margin-top: 0px; margin-bottom: 20px;">
                                        <label for="email" class="form-label"
                                            style="font-size: 14px; margin-left: 5px; margin-top: 30px">Masukkan
                                            Email</label>
                                        <input type="email" name="email" class="form-control" id="email" required>
                                        <div class="invalid-feedback">Masukkan email yang valid!</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit" id="manual"
                                            name="manual" style="font-size: 14px; padding: 6px">Kirim kode
                                            verifikasi</button>
                                    </div>
                                </form>

                                <form method="post" action="/verificationEmail">
                                    <div class="text-center mt-5 text-lg fs-4">
                                        <p><a href="{{ route('login') }}" id="back" class="font-bold"
                                                style="font-size: 0.7em; position: relative; bottom: 20px">Back to
                                                login</a></p>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->

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
