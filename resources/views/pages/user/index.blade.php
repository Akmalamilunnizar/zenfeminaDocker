@extends('layout.app')
@section('user', 'active')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div>
                <h3>Daftar pengguna</h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <a href="{{route('users.create')}}" class="btn btn-primary">New User</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="users-table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>username</th>
                                <th>Email</th>
                                <th>Age</th>
                                <th>options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->age}}</td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button  type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#users-table').DataTable();
    </script>
@endpush
