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
                                    {{ $flat->id }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Flat Name:
                                </div>
                                <div class="col-8">
                                    {{ $flat->flat_name }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Total Square Feet:
                                </div>
                                <div class="col-8">
                                    {{ $flat->sft }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Bed Room:
                                </div>
                                <div class="col-8">
                                    {{ $flat->bed_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Dining Room:
                                </div>
                                <div class="col-8">
                                    {{ $flat->dining_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Drawing Room:
                                </div>
                                <div class="col-8">
                                    {{ $flat->drawing_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Bath Room:
                                </div>
                                <div class="col-8">
                                    {{ $flat->bath_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Kitchen Room:
                                </div>
                                <div class="col-8">
                                    {{ $flat->kitchen_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Store Room:
                                </div>
                                <div class="col-8">
                                    {{ $flat->store_room }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Belkuni:
                                </div>
                                <div class="col-8">
                                    {{ $flat->belkuni }}
                                </div>
                            </div>
                        </div>
                        <div class="item mb-2">
                            <div class="row">
                                <div class="col-4">
                                    Address:
                                </div>
                                <div class="col-8">
                                    {{ $flat->address->flat_number }}, House Number: {{ $flat->address->house_number }},
                                    Block: {{ $flat->address->block }},
                                    Road: {{ $flat->address->road_number }}, Socity Name:
                                    {{ $flat->address->socity_name }}, Thana: {{ $flat->address->thanaInfo->name }},
                                    District: {{ $flat->address->districtInfo->name }}, Division:
                                    {{ $flat->address->divisionInfo->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 rightcontent">
                <div class="card mb-3">
                    <div class="card-header">
                        Images
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($flat->files() as $image)
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
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
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

                                                <button type="button" class="btn btn-danger delete" data-bs-toggle="modal"
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
                                                    action="{{ route('flat.imagedelete', [$image->id, $flat->id]) }}"
                                                    method="post">
                                                    @csrf
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
                <div class="card mb-3">
                    <div class="card-header">
                        Advertisement
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="image-container">
                                        <img src="/images/ad/1.jpg" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="w-100">
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <img src="/images/ad/1.jpg" class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="image-container">
                                        <img src="/images/ad/1.jpg" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="w-100">
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <img src="/images/ad/1.jpg" class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="col-md-12">
                                    <div class="image-container">
                                        <img src="/images/ad/1.jpg" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="w-100">
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body p-0">
                                                        <img src="/images/ad/1.jpg" class="w-100">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
