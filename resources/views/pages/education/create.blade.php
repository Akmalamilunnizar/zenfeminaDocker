@extends('layout.app')
@section('uploadEducation', 'active')
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
                    <form action="{{ route('educations.store') }}" id="uploadForm" enctype="multipart/form-data" method="post">
                        @include('pages.education.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (e){
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '/educations/store',
                enctype: 'multipart/form-data',
                data: formData,
                processData: false,  // Jangan memproses data secara default
                contentType: false,
                success(res) {
                    Swal.fire({
                        icon: 'success',
                        text: res.meta.message,
                        timer: 1500,
                    });
                    window.location.href = '{{ route('educations.index') }}';
                },
                error(err) {
                    if(err.status == 422) {
                        displayFormErrors(err.responseJSON.data);
                        console.log(formData);
                        return;
                    }

                    Swal.fire({
                        icon: 'error',
                        text: 'Terdapat masalah saat melakukan aksi',
                        timer: 1500,
                    });
                }
            });
        });
    </script>
@endpush
