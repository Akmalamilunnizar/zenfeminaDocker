@extends('layout.app')
@section('user', 'active');
@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @include('pages.user.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
