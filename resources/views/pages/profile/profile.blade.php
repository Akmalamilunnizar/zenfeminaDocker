@extends('layout.app')

@section('profile', 'active')

@section('content')
<div class="pagetitle">
    <h1>Profile</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        </ol>
    </nav>
</div>

<section class="section dashboard" id="profile">
    <div class="row">
        @include('partials.profile_details')
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item" style="background-color: #ffffff">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Detail Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Ubah Password</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <form action="{{ route('profiles.update', $user->id) }}" method="post" class="mt-3">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" value="{{ old('username', $user->username) }}" name="username">
                                    @error('username')
                                    <div class="invaid-feedback">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" value="{{ old('email', $user->email) }}" name="email">
                                    @error('email')
                                    <div class="invaid-feedback">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-4">
                                    <label for="birthDate" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="birthDate" value="{{ old('birthDate', $user->birthDate) }}" name="birthDate">
                                    @error('birthDate')
                                    <div class="invaid-feedback">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group" style="text-align: right">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form class="needs-validation" method="POST" action="{{ route('profiles.updatePassword', $user->id) }}" novalidate>
                                @method('PUT')
                                @csrf

                                <div class="mb-3">
                                    <label for="password" class="form-label">Masukkan password baru</label>
                                    <div class="password-input-container input-group mb-0">
                                        <input type="password" name="password" class="form-control" id="password">
                                        <span class="input-group-text" id="toggleContainer" style="cursor: pointer"><i id="togglePassword" class="toggle-password bi bi-eye-fill"></i></span>
                                    </div>
                                    @error('password')
                                        <div class="invaid-feedback">
                                            <small class="text-danger">{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>


                                <label for="password_confirmation" class="form-label">Ulangi Password</label>
                                <div class="password-input-container input-group mb-4">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                                    <span class="input-group-text" id="toggleContainer2" style="cursor:pointer;"><i id="togglePassword2" class="toggle-password bi bi-eye-fill"></i></span>
                                    @error('password_confirmation')
                                    <div class="invaid-feedback">
                                        <small class="text-danger">{{ $message }}</small>
                                    </div>
                                    @enderror
                                </div>

                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-primary" style="font-size: 14px; margin-bottom: 10px;" id="changePassword" name="changePassword" >Simpan</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('script')
    <script>
        const passwordInput = document.getElementById('password');
        const toggleContainer = document.getElementById('toggleContainer');
        const toggleButton = document.getElementById('togglePassword');

        toggleContainer.addEventListener('click', function () {
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

        const passwordInput2 = document.getElementById('password_confirmation');
        const toggleContainer2 = document.getElementById('toggleContainer2');
        const toggleButton2 = document.getElementById('togglePassword2');

        toggleContainer2.addEventListener('click', function () {
            if (passwordInput2.type === 'password') {
                passwordInput2.type = 'text';
                toggleButton2.classList.remove('bi-eye-fill');
                toggleButton2.classList.add('bi-eye-slash-fill');
            } else {
                passwordInput2.type = 'password';
                toggleButton2.classList.remove('bi-eye-slash-fill');
                toggleButton2.classList.add('bi-eye-fill');
            }
        });
    </script>
@endpush
