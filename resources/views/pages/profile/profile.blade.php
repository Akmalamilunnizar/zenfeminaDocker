@extends('layout.app')
@section('profile', 'active')

@section('content')
    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Profile</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard" id="profile">
        <!-- <h1>hallo </h1> -->
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="avatar avatar-2xl">
                                <img src="assets/static/images/faces/2.jpg" alt="Avatar">
                            </div>

                            <h3 class="mt-3">{{$user->email}}</h3>
                            <p class="text-small">Admin</p>
                        </div>
                    </div>
                </div>
            </div>
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
                                <input type="text" class="form-control" id="email" value="{{ old('email', $user->email) }}" name="email"> </div>
                            <div class="form-group">
                                <label for="birthDate" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthDate" value="{{ old('birthDate', $user->birthDate) }}" name="birthDate"> </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


