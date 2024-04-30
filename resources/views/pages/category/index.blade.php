@extends('layout.app')
@section('category', 'active')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="pagetitle">
                <h1>Daftar Kategori</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Category</li>
                    </ol>
                </nav>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <button class="btn btn-primary" id="newCategory" name="newCategory">New Category</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover"  id="categories-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.category_modal')
@endsection

@include('components.category_js')

