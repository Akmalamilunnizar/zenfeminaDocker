@push('script')
    <script>
        const userTable = $('#users-table').DataTable({
            serverSide: true,
            rendering: true,
            ajax: '{{ route('users.datatables') }}',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false,},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'age', name: 'age'},
                {data: 'action', orderable: false, searchable: false},
            ],
        });


        const userModal = new bootstrap.Modal('#user-modal');
        let editID = 0;

        function fillForm() {
            $.ajax({
                url: `/users/${editID}`,
                success: (res) => fillFormdata(res.data),
            });
        }

        function saveItem() {
            const url = editID != 0 ?
                `/users/${editID}/update` :
                `/users/store`;

            const method = editID != 0 ? 'PUT' : 'POST';

            $.ajax({
                url,
                method,
                data: $('#user-form').serialize(),
                success(res) {
                    userTable.ajax.reload();
                    userModal.hide();


                    Swal.fire({
                        icon: 'success',
                        text: res.meta.message,
                        timer: 1500,
                    });
                },
                error(err) {
                    if(err.status == 422) {
                        displayFormErrors(err.responseJSON.data);
                        return;
                    }

                    Swal.fire({
                        icon: 'error',
                        text: 'Terdapat masalah saat melakukan aksi',
                        timer: 1500,
                    });
                },
            });
        }

        function deleteItem(id) {
            $.ajax({
                url: `/users/${id}`,
                method: 'DELETE',
                success(res) {
                    userTable.ajax.reload();

                    Swal.fire({
                        icon: 'success',
                        text: res.meta.message,
                        timer: 1500,
                    });
                },
                error(err) {
                    Swal.fire({
                        icon: 'error',
                        text: 'Terdapat masalah saat melakukan aksi',
                        timer: 1500,
                    });
                },
            });
        }

        $('#user-modal').on('show.bs.modal', function (event) {
            $('#user-modal-title').text(editID ? 'Edit Data Pengguna' : 'Tambah Data Pengguna');
            if(editID != 0)
                fillForm();
        });

        $('#user-modal').on('hidden.bs.modal', function (event) {
            editID = 0;

            removeFormErrors();
            $('#user-form').trigger('reset');
        });

        $('#user-form').submit(function(e) {
            e.preventDefault();

            removeFormErrors();
            saveItem();
        });

        $('#users-table').on('click', '.btn-edit', function(e) {
            editID = this.dataset.id;
            userModal.show();
        });

        $('#newUser').on('click', function (e) {
            userModal.show();
        });


        $('#users-table').on('click', '.btn-delete', function(e) {
            Swal.fire({
                icon: 'question',
                text: 'Apakah anda yakin?',
                showCancelButton: true,
                cancelButtonText: 'Batal',
            }).then((res) => {
                if(res.isConfirmed)
                    deleteItem(this.dataset.id);
            });
        });
    </script>
@endpush
