@extends('flat.layouts.flatLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <h5 class="card-title mt-2 ms-3">{{ Auth::user()->name }}</h5>
                        <form method="post" id="avatarForm" action="{{ route('profile.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <div class="avatarContainer">
                                    <img src="{{ Auth::user()->avatar ? str_replace('uploads/', 'uploads/200X200-', Auth::user()->avatar()->imagepath) : '/images/avatar.jpg' }}"
                                        class="card-img-top rounded-circle mx-auto mt-0" alt="Profile Picture"
                                        style="width: 100px; height: 100px;" id="avatarPreview">
                                    <input type="file" name="file" id="avatarInput" required
                                        accept="image/png, image/jpg, image/jpeg" onchange="selectAvatar(this)"
                                        class="form-control">
                                    <label class="text-center" for="avatarInput">Change</label>
                                </div>
                            </div>
                            {{-- <div class="form-group ">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" id="fileUploader" class="btn btn-primary">
                                        Change Picture
                                        <div class="spinner-border spinner-border-sm" role="status"> </div>
                                    </button>
                                </div>
                            </div> --}}
                        </form>
                        <form method="post" onsubmit="return handleBasicForm('fileUploader')"
                            action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data"
                            class="mt-0">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Name:</label>
                                        <input type="text" name="name" value='{{ Auth::user()->name }}'
                                            class="form-control" placeholder="Name" readonly>
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Email:</label>
                                        <input type="text" name="email" value='{{ Auth::user()->email }}'
                                            class="form-control" placeholder="Email" readonly>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Division:</label>
                                        <select name="division" id="division" class="form-control"
                                            onchange="handleDivision(this)">
                                            <option disabled selected>Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option {{ $address->division == $division->id ? 'selected' : '' }}
                                                    value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>District:</label>
                                        <select name="district" id="district" class="form-control"
                                            {{ $address->district == null ? 'disabled' : '' }}
                                            onchange="handleDistrict(this)">
                                            <option>Select District</option>
                                            @if ($districts)
                                                @foreach ($districts as $district)
                                                    <option {{ $address->district == $district->id ? 'selected' : '' }}
                                                        value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('district')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Thana:</label>
                                        <select name="thana" id="thana" class="form-control"
                                            {{ $address->thana == null ? 'disabled' : '' }}>
                                            <option>Select Thana</option>
                                            @if ($thanas)
                                                @foreach ($thanas as $thana)
                                                    <option {{ $address->thana == $thana->id ? 'selected' : '' }}
                                                        value="{{ $thana->id }}">{{ $thana->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('thana')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Socity Name:</label>
                                        <input type="text" name="socity_name" value='{{ $address->socity_name }}'
                                            class="form-control" placeholder="Socity Name">
                                        @error('socity_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Road Number:</label>
                                        <input type="text" name="road_number" value='{{ $address->road_number }}'
                                            class="form-control" placeholder="Road Number">
                                        @error('road_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Block:</label>
                                        <input type="text" name="block" value='{{ $address->block }}'
                                            class="form-control" placeholder="Block">
                                        @error('block')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>House Number:</label>
                                        <input type="text" name="house_number" value='{{ $address->house_number }}'
                                            class="form-control" placeholder="House Number">
                                        @error('house_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label>Flat Number:</label>
                                        <input type="text" name="flat_number" value='{{ $address->flat_number }}'
                                            class="form-control" placeholder="Flat Number">
                                        @error('flat_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-2 ">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" id="fileUploader" class="btn btn-primary">
                                        Update
                                        <div class="spinner-border spinner-border-sm" role="status"> </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
