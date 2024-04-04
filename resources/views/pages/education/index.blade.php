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

        <div class="row" id="articles">

        </div>
    </section>
@endsection

@push('script')
    <script>

        $(document).ready(function (){
            loadData();
        })

        let educations;
        function loadData(){
            $.get('{{route('educations.education')}}', function (data){
                educations = data.educations;
                processData(educations);
            })
        }

        function processData(educations){
            educations.forEach(education => {
                //ambil elemen article nya
                const article = document.getElementById('articles');

                //buat div yg paling luar
                const card = document.createElement('div');
                card.className = 'card col-lg-3 col-md-6 col-sm-12';
                card.style.padding = '0px';
                card.style.marginRight = '20px';
                card.style.marginLeft = '10px';

                //membuat elemen gambar
                const img = document.createElement('img');
                img.src = 'assets/educations/' + education.image;
                img.alt = '...';
                img.style.padding = '0';
                img.style.borderRadius = '8px 8px 0px 0px';

                //card body
                const cardBody = document.createElement('div');
                cardBody.className = 'card-body';

                //title
                const title = document.createElement('h5');
                title.className = 'card-title';
                title.textContent = education.title;

                //description
                const description = document.createElement('p');
                description.className = 'card-text';
                description.textContent = education.content;

                // Membuat elemen div untuk tombol
                const buttonContainer = document.createElement('div');
                buttonContainer.style.textAlign = 'right';
                buttonContainer.style.marginBottom = '20px';
                buttonContainer.style.marginRight = '23px';

                // Membuat tombol edit
                const editButton = document.createElement('button');
                editButton.type = 'button';
                editButton.className = 'btn-edit';
                editButton.style.borderColor = '#4154f1';
                editButton.style.backgroundColor = '#4154f1';
                editButton.style.color = 'white';
                editButton.style.fontSize = '14px';
                editButton.style.borderRadius = '5px';
                editButton.style.padding = '4px 8px';
                editButton.style.marginRight = '5px'
                editButton.id = 'btn-edit';
                editButton.name = 'btn-edit';
                editButton.innerHTML = '<i class="bi bi-pencil-fill"></i>';

                // Membuat tombol delete
                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'btn-delete';
                deleteButton.style.borderColor = '#FC2A46';
                deleteButton.style.backgroundColor = '#FC2A46';
                deleteButton.style.color = 'white';
                deleteButton.style.fontSize = '14px';
                deleteButton.style.borderRadius = '5px';
                deleteButton.style.padding = '4px 8px';
                deleteButton.id = 'deleteArticle';
                deleteButton.name = 'deleteArticle';
                deleteButton.dataset.bsToggle = 'modal';
                deleteButton.dataset.bsTarget = '#basicModal3';
                deleteButton.innerHTML = '<i class="bi bi-trash"></i>';

                // Menambahkan elemen tombol ke dalam div buttonContainer
                buttonContainer.appendChild(editButton);
                buttonContainer.appendChild(deleteButton);

                card.appendChild(img);
                card.appendChild(cardBody);
                cardBody.appendChild(title);
                cardBody.appendChild(description);
                card.appendChild(buttonContainer);
                article.appendChild(card);
            });
        }


        $(document).on('keyup', function (e){
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url:"{{route('educations.search')}}",
                method:'GET',
                data:{search_string:search_string},
                success:function (res){
                    let educations = res.educations;

                    $('#articles').empty();
                    processData(educations);
                }
            })
        })

    </script>
@endpush

