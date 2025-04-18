@extends('admin.layouts.main')

@section('title','Product Subcategory')

@section('main-content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Product /</span> Subcategory</h4>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#productSubcategory">
            Add subcategory
        </button>

        <!-- Modal -->
        <div class="modal fade" id="productSubcategory" tabindex="-1" aria-labelledby="productSubcategoryLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('admin.product-subcategory.store') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productSubcategoryLabel">Add Subcategory</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="category_id" class="form-select" aria-describedby="categoryHelpId">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <small id="categoryHelpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Subcategory</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    aria-describedby="nameHelpId" />
                                @error('name')
                                <small id="nameHelpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Product Subcategory</h5>
                    <div class="card-body">
                        <div
                            class="table-responsive">
                            <table
                                class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Subcategory</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $subcategory )
                                    <tr class="">
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ $subcategory->category->category_name }}</td>

                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSubcategory{{ $subcategory->id }}">
                                                Edit
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="editSubcategory{{ $subcategory->id }}" tabindex="-1" aria-labelledby="editSubcategory{{ $subcategory->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.product-subcategory.update',$subcategory->id) }}" method="post" enctype="multipart/form-data">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editSubcategory{{ $subcategory->id }}Label">Edit Subcategory</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label">Subcategory</label>
                                                                    <input
                                                                        type="name"
                                                                        class="form-control"
                                                                        name="name"
                                                                        id=""
                                                                        aria-describedby="nameHelpId"
                                                                        value="{{ $subcategory->subcategory_name }}" />
                                                                    @error('name')
                                                                    <small id="nameHelpId" class="form-text text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>



                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update Subcategory</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('admin.product-subcategory.delete',$subcategory->id) }}" onclick="return confirm('Are you sure you want to delete this subcategory? This action cannot be undone.')" method="post" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger">
                                                    Delete
                                                </button>
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
    </div>
</div>
@endsection