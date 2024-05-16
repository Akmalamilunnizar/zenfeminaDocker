
@extends('layout.auth')

@push('styles')
    <link rel="stylesheet" href="{{ asset('resources/sass/app.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/sass/pages/auth.css') }}">
@endpush

@section('content')
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                <div class="auth-logo">
    <a href="index.html">
        <img src="{{ asset('assets/static/images/logo/logo_zenfemina2.svg') }}" alt="Logo" class="logo-kiri-atas" style="width: 180px; height: auto;">
    </a>
</div>

                    <h1 class="auth-title">Sign In</h1>
                    <p class="auth-subtitle mb-5">Silakan masuk dengan menggunakan email dan password yang Anda daftarkan</p>

                    <form action="/store" method="post" id="loginForm">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl " id="email" placeholder="Email" name="email" value="{{old('email')}}"style="padding-left: 20px; border-radius: 12px;">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group position-relative has-icon-right mb-4">
                            <input type="password"  class="form-control form-control-xl @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password" value="{{old('password')}}"style="padding-left: 20px; border-radius: 12px;">
                            <div class="invalid-feedback"></div>

                            <div class="form-control-icon toggle-password has-icon-right"style="margin-right: 44px; top: 25px; bottom: 1px ">
                                <i class="bi bi-eye"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" style="border-radius: 12px;">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p><a class="font-bold" href="/verifikasi">Forgot password?</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="position: relative;">

                </div>
            </div>
        </div>

<script>
// Toggle password visibility
document.querySelector('.toggle-password').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
});

document.getElementById('loginForm').addEventListener('submit', function (e){
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/store',
        data: $(this).serialize(),
        success(res) {
            if(res.status == 'success') {
                window.location.href = res.redirect;
            } else {
                const input = $(`#password`);
                input.addClass('is-invalid');
                input.next().html(res.password);
            }
        },
        error(err) {
            if(err.status == 422) {
                displayFormErrors(err.responseJSON.data);
            }
        }
    });
});

</script>


@endsection
