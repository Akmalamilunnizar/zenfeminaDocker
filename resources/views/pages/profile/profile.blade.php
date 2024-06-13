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
                <div class="card-body">
                    <form action="#" method="get">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="username" value="{{ old('username', $user->username) }}" name="username">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" value="{{ old('email', $user->email) }}" name="email">
                        </div>
                        <div class="form-group">
                            <label for="birthDate" class="form-label">Birthday</label>
                            <input type="date" class="form-control" id="birthDate" value="{{ old('birthDate', $user->birthDate) }}" name="birthDate">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                    <a href="{{ route('profile.password.form') }}" class="btn btn-secondary mt-3">Update Password</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
