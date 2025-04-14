@extends('admin.layouts.main')

@section('title', 'Carousel-index')

@section('main-content')
<div class="content-wrapper">

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Carousel</h4>

        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <h5 class="card-header">Carousel</h5>

                    <!-- Button trigger modal -->
                    <div class="m-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarousel">
                            Add Carousel
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="addCarousel" tabindex="-1" aria-labelledby="addCarouselLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('admin.carousel.store')}}" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addCarouselLabel">Add Carousel</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Image</label>
                                            <input
                                                type="file"
                                                class="form-control"
                                                name="image"
                                                id="image"
                                                aria-describedby="imageHelpId" />
                                            @error('image')
                                            <small id="imageHelpId" class="form-text text-danger">{{ $message }}</small>
                                            @enderror

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add Carousel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div
                            class="table-responsive">
                            <table
                                class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">SN</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carousels as $carousel )
                                    <tr class="">
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>
                                            <img src="{{ asset('storage/carousels/'. $carousel-> image) }}" width="auto" height="200px" alt="">
                                        </td>
                                        <td>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editcarousel{{$carousel->id}}">
                                                Edit
                                            </button>


                                            <form action="{{ route('admin.carousel.delete',$carousel->id) }}" class="d-inline-block" method="POST" onsubmit="return confirm('Are you sure?');">
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
                                    <!-- Modal -->
                                    <div class="modal fade" id="editcarousel{{$carousel->id}}" tabindex="-1" aria-labelledby="editcarousel{{$carousel->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.carousel.update', $carousel->id) }}" method="post" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editcarousel{{$carousel->id}}Label">Edit Carousel</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Current Image</label>
                                                            <img src="{{ asset('storage/carousels/' . $carousel->image) }}" width="auto" height="200px" alt="">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Image</label>
                                                            <input
                                                                type="file"
                                                                class="form-control"
                                                                name="image"
                                                                id="image" />
                                                            @error('image')
                                                            <small id="imageHelpId" class="form-text text-danger">{{ $message }}</small>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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