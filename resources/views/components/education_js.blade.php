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
            // img.src = 'assets/educations/' + education.image;
            img.setAttribute('data-image', education.image);
            img.src = "{{ Storage::url('') }}" + img.getAttribute('data-image');
            img.alt = '...';
            img.style.padding = '0';
            img.style.borderRadius = '8px 8px 0px 0px';
            img.style.width = '100%';
            img.style.maxHeight = '270px';

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
            editButton.value = education.id;
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
            deleteButton.value = education.id;
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

    function deleteItem(id) {
        $.ajax({
            url: `/educations/${id}`,
            method: 'DELETE',
            success(res) {
                $('#articles').empty();
                processData(res.data);
                // console.log(res.data);

                Swal.fire({
                    icon: 'success',
                    text: res.meta.message,
                    timer: 1500,
                });
            },
            error(err) {
                Swal.fire({
                    icon: 'error',
                    text: err.responseJSON,
                    timer: 1500,
                });
            },
        });
    }

    $('#article').on('click', '#deleteArticle', function(e) {
        Swal.fire({
            icon: 'question',
            text: 'Apakah anda yakin?',
            showCancelButton: true,
            cancelButtonText: 'Batal',
        }).then((res) => {
            if(res.isConfirmed)
                deleteItem($(this).val());
        });
    });

    $('#article').on('click', '#btn-edit', function(e) {
        window.location.href = "{{ route('educations.edit', 'VALUE') }}".replace('VALUE', $(this).val());
    });

    const editButton = document.getElementById('btn-edit');

    // editButton.addEventListener('click', function() {
    //     console.log($(this).val);
    //     // window.location.href = "/route-tujuan";
    // });

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
