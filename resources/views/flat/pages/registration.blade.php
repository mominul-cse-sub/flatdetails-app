@extends('flat.layouts.flatLayout')

@section('content')
    <div class="container">
        <form method="post" onsubmit="return handleBasicForm('fileUploader')" action="{{ route('store') }}"
            enctype="multipart/form-data" class="mt-0">
            @csrf
            <div class="row">
                <div class="col-md-8 leftcontent">
                    <div class="card">
                        <div class="card-header">
                            Create new Flat
                        </div>
                        <div class="card-body mb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Division:</label>
                                        <select name="division" id="division" class="form-control"
                                            onchange="handleDivision(this)">
                                            <option disabled selected>Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('division')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>District:</label>
                                        <select name="district" id="district" class="form-control" disabled
                                            onchange="handleDistrict(this)">
                                            <option>Select District</option>
                                        </select>
                                        @error('district')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Thana:</label>
                                        <select name="thana" id="thana" class="form-control" disabled>
                                            <option>Select Thana</option>
                                        </select>
                                        @error('thana')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Socity Name:</label>
                                        <input type="text" name="socity_name" class="form-control"
                                            placeholder="Socity Name">
                                        @error('socity_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Road Number:</label>
                                        <input type="text" name="road_number" class="form-control"
                                            placeholder="Road Number">
                                        @error('road_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Block:</label>
                                        <input type="text" name="block" class="form-control" placeholder="Block">
                                        @error('block')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>House Number:</label>
                                        <input type="text" name="house_number" class="form-control"
                                            placeholder="House Number">
                                        @error('house_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Flat Number:</label>
                                        <input type="text" name="flat_number" class="form-control"
                                            placeholder="Flat Number">
                                        @error('flat_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!---------------2nd Table Data----------->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Flat Name:</label>
                                        <input type="text" name="flat_name" class="form-control" placeholder="Flat Name">
                                        @error('flat_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Total Square Feet:</label>
                                        <input type="text" name="sft" class="form-control"
                                            placeholder="Total Square Feet">
                                        @error('sft')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Bed Room:</label>
                                        <input type="text" name="bed_room" class="form-control" placeholder="Bed Room">
                                        @error('bed_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Dining Room:</label>
                                        <input type="text" name="dining_room" class="form-control"
                                            placeholder="Dining Room">
                                        @error('dining_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Drawing Room:</label>
                                        <input type="text" name="drawing_room" class="form-control"
                                            placeholder="Drawing Room">
                                        @error('drawing_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Bath Room:</label>
                                        <input type="text" name="bath_room" class="form-control"
                                            placeholder="Bath Room">
                                        @error('bath_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Kitchen Room:</label>
                                        <input type="text" name="kitchen_room" class="form-control"
                                            placeholder="Kitchen Room">
                                        @error('kitchen_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Store Room:</label>
                                        <input type="text" name="store_room" class="form-control"
                                            placeholder="Store Room">
                                        @error('store_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Belkuni:</label>
                                        <input type="text" name="belkuni" class="form-control" placeholder="Belkuni">
                                        @error('belkuni')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 rightcontent">
                    <div class="card mb-3">
                        <div class="card-header">
                            Upload Image
                        </div>
                        <div class="card-body mb-0">
                            <div class="form-group mb-4">
                                <input type="file" name="file[]" multiple class="form-control">
                                <!-- Error -->
                                @if ($errors->has('file'))
                                    <div class='text-danger mt-2'>
                                        * {{ $errors->first('file') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group mt-2 ">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="fileUploader" class="btn btn-primary">
                        Register
                        <div class="spinner-border spinner-border-sm" role="status"> </div>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
