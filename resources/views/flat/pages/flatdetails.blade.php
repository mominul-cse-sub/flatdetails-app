@extends('flat.layouts.flatLayout')

@section('content')

    <head>
        @vite(['resources/sass/flatdetails.scss', 'resources/js/app.js'])
    </head>
    <div class="container">
        <div class="row">
            <div class="col-md-8 leftcontent">
                <div class="card">
                    <div class="card-header">
                        Flat Details
                    </div>
                    <div class="card-body">
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Flat Id:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->flat_id }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Flat Name:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->flat_name }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Total Square Feet:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->sft }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Bed Room:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->bed_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Dining Room:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->dining_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Drawing Room:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->drawing_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Bath Room:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->bath_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Kitchen Room:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->kitchen_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Store Room:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->store_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Belkuni:
                                </div>
                                <div class="col-8">
                                    {{ $flatdetails->belkuni }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 rightcontent">
                <div class="card mb-3">
                    <div class="card-header">
                        Action
                    </div>
                    <div class="card-body">
                        @if ($flatdetails->status == 1)
                            <a class="btn btn-primary" href="{{ route('inactive', $flatlocation->id) }}">Inactive</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('active', $flatlocation->id) }}">Active</a>
                        @endif
                        @method('DELETE')
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmModal{{ $flatlocation->id }}">Delete
                            <i class="bi bi-trash"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="confirmModal{{ $flatlocation->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body text-start">
                                        Are you sure?
                                    </div>
                                    <div class="modal-footer d-flex justify-content-start">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <form class="text-center" action="{{ route('destroy', $flatlocation->id) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        Upload Image
                    </div>
                    <div class="card-body">
                        @if ($images->count() >= config('variables.FLAT_MAX_IMAGES'))
                            <div>Maximum {{ config('variables.FLAT_MAX_IMAGES') }} images are allowed for a flat. Please
                                delete exiting images before upload any
                                image.</div>
                        @else
                            <form method="post" onsubmit="return handleBasicForm('fileUploader')"
                                action="{{ route('imageupload', $flatlocation->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <input type="file" name="file" required multiple class="form-control">
                                    <!-- Error -->
                                    @if ($errors->has('file'))
                                        <div class='text-danger mt-2'>
                                            * {{ $errors->first('file') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="fileUploader" class="btn btn-primary">
                                            Submit
                                            <div class="spinner-border spinner-border-sm" role="status"> </div>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Images
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($images as $image)
                                <div class="col-md-4">
                                    <div class="col-md-12">
                                        <div class="image-container">
                                            <img src="{{ str_replace('uploads/', 'uploads/200X200-', $image->imagepath) }}"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal{{ $image->id }}"
                                                class="w-100">
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $image->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                {{ $image->name }}</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-0">
                                                            <img src="{{ $image->imagepath }}" class="w-100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="buttons">
                                                <button class="btn btn-primary preview" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $image->id }}">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger delete"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteImage{{ $image->id }}"><i
                                                        class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="confirmDeleteImage{{ $image->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body text-start">
                                                Are you sure want to delete this image?
                                            </div>
                                            <div class="modal-footer d-flex justify-content-start">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">No</button>
                                                <form class="text-center"
                                                    action="{{ route('flat.imagedelete', $image->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="emptyContainer">
                                    No image found for this flat
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
