@extends('admin.layouts.main')

@section('title','User')

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / User /</span> Create</h4>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Add Users </h5>
                    <div class="card-body">
                        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class=" row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> name</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                        id="name"
                                        value="{{ old('name') }}" />
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> email</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="email"
                                        id="email"
                                        value="{{ old('email') }}" />
                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="gender" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> gender</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="gender"
                                        id="gender"
                                        value="{{ old('gender') }}" />
                                    @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="role" class="form-label">
                                        <span class="text-danger">*</span> <span class="text-capitalize">Role</span>
                                    </label>
                                    <select class="form-control" name="role" id="role">
                                        <option value="">Select a Role</option>
                                        <option value="admin" @selected(old('role', $user->role ?? '') == 'admin')>Admin</option>
                                        <option value="user" @selected(old('role', $user->role ?? '') == 'user')>User</option>
                                    </select>
                                    @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <!-- <div class="col-md-6">
                                    <label for="role" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> role</span></label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="role"
                                        id="role"
                                        value="{{ old('role') }}" />
                                    @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> -->

                            </div>


                            <div class="mb-3">
                                <label for="image" class="form-label"><span class="text-danger">*</span><span class="text-capitalize"> image</span></label>
                                <input
                                    type="file"
                                    class="form-control"
                                    name="image"
                                    id="image"
                                    value="{{ old('image') }}" />
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button
                                type="submit"
                                class="btn btn-primary">
                                Add User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection