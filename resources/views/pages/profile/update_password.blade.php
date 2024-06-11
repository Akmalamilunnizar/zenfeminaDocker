@extends('layout.app')

@section('profile', 'active')

@section('content')
<div class="pagetitle">
    <h1>Update Password</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile.index') }}">Profile</a></li>
            <li class="breadcrumb-item active">Update Password</li>
        </ol>
    </nav>
</div>

<section class="section dashboard" id="profile">
    <div class="row">
        @include('partials.profile_details')
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative mb-4" style="position: relative;">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control form-control-sm" id="password" name="password" required style="padding-right: 2.5rem; width: 100%; height: calc(1.5em + .75rem + 2px);">
                            <div class="form-control-icon toggle-password" style="position: absolute; right: 0.75rem; top: 75%; transform: translateY(-50%); cursor: pointer;">
                                <i class="bi bi-eye" id="togglePasswordIcon1" style="font-size: 1.50rem;"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative mb-4" style="position: relative;">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" required style="padding-right: 2.5rem; width: 100%; height: calc(1.5em + .75rem + 2px);">
                            <div class="form-control-icon toggle-password" style="position: absolute; right: 0.75rem; top: 75%; transform: translateY(-50%); cursor: pointer;">
                                <i class="bi bi-eye" id="togglePasswordIcon2" style="font-size: 1.50rem;"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(item => {
        item.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });
</script>
@endsection
