@extends('admin.layouts.main')

@section('title', 'User-index')

@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / User /</span> Index</h4>

    <div class="row">
        <div class="col">
            <a
                name=""
                id=""
                class="btn btn-primary my-2"
                href="{{ route('admin.user.create') }}"
                role="button"> + Add User</a>

            <div class="card mb-4">
                <h5 class="card-header">Users</h5>
                <div class="card-body">
                    <div
                        class="table-responsive">
                        <table
                            class="table">
                            <thead>
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="">
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <img src="{{ asset('storage/'. $user->profile_img) }}" alt="" width="80px" height="70px">
                                    </td>
                                    <td>{{ $user->role  }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a
                                                name=""
                                                id=""
                                                class="btn btn-primary btn-sm"
                                                href="{{ route('admin.user.edit',$user->id) }}"
                                                role="button">Edit</a>


                                            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">Delete</button>
                                            </form>
                                        </div>
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
</div>
@endsection