@extends('layout.app')
@section('education', 'active');

@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="pagetitle">
                <h1>Edit Education</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Education</li>
                        <li class="breadcrumb-item">Edit Education</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('educations.update', $education->id) }}" enctype="multipart/form-data" method="post">
                        @method('PUT')
                        @include('pages.education.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
