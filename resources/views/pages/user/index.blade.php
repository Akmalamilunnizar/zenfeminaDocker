@extends('layout.app')
@section('user', 'active')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="pagetitle">
                <h1>Data Pengguna</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">User</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                    <style>
              #newUser {
                color: white;
                  }
                     </style>
                        <div>
                            <button class="btn btn-primary" id="newUser" name="newUser">New User</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="users-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>username</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>options</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.user_modal')
@endsection

@include('components.user_js')
