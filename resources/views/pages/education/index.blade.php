@extends('layout.app')
@section('education', 'active')

@section('content')
    <div class="pagetitle">
        <h1>Educations</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Education</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard" id="article">
        <div class="search-bar-custom col-sm-6" >
            <form class="search-form-custom d-flex align-items-center" method="POST" action="#">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search education.." style="margin-bottom: 30px">
            </form>
        </div>

        <div class="row article" id="articles">

        </div>
    </section>
@endsection

@include('components.education_js')

