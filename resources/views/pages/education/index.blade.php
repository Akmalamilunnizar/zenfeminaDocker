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
        <div class="row">

            @php($i = 1)
            @foreach($educations as $education)
                @if($i > $length || $education === null)
                    @break
                @endif

                    <div class="card col-lg-3 col-md-6 col-sm-12" id="articles" style="padding: 0px; margin-right: 20px; margin-left: 10px">
                        <img src="assets/educations/{{ $education->image }}" class="card-img-top" alt="..." style="padding: 0 0 0 0" >
                        <div class="card-body">
                            <h5 class="card-title">{{$education->title}}</h5>
                            <p class="card-text">{{substr($education->content, 0, 50)}}</p>
                        </div>
                        <div style="text-align: right; margin-bottom: 20px; margin-right: 23px;" >
                            <button type="button" class="btn-edit" style="border-color: #4154f1; background-color: #4154f1; color: white; font-size: 14px; border-radius: 5px; padding: 4px 8px;" id="btn-edit" name="btn-edit">
                                <a href="/editArticle?id={{$education->id}}" style="color: white">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </button>
                            <button type="button" class="btn-delete" style="border-color: #FC2A46; background-color: #FC2A46; color: white; font-size: 14px; border-radius: 5px; padding: 4px 8px;" id="deleteArticle" name="deleteArticle" data-bs-toggle="modal" data-bs-target="#basicModal3"  >
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                    </div>
                @php($i++)
            @endforeach
        </div>
    </section>
@endsection

@push('script')
    <script>




        $(document).on('keyup', function (e){
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url:"{{route('educations.search')}}",
                method:'GET',
                data:{search_string:search_string},
                success:function (res){
                    console.log('succes');
                    // if(res.status === 'nothing'){
                    //     $('#articles').html('<p>Nothing found</p>')
                    // }
                }
            })
        })

    </script>
@endpush

