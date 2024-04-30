@extends('layout.app')
@section('uploadEducation', 'active');
@section('content')
    <div class="row">
        <div class="col-md-11">
            <div class="pagetitle">
                <h1>Upload Education</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Upload Education</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('educations.store') }}" enctype="multipart/form-data" method="post">
                        @include('pages.education.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
