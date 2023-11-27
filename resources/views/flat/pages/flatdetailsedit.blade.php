@extends('flat.layouts.flatLayout')

@section('content')

    <head>
        @vite(['resources/sass/flatdetails.scss', 'resources/js/app.js'])
    </head>
    <div class="container">
        <form method="post" onsubmit="return handleBasicForm('fileUploader')" action="{{ route('flat.update', $flat->id) }}"
            enctype="multipart/form-data" class="mt-0">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8 leftcontent">
                    <div class="card">
                        <div class="card-header">
                            Flat Details Edit
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Division:</label>
                                        <select name="division" id="division" class="form-control"
                                            onchange="handleDivision(this)">
                                            <option disabled selected>Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option
                                                    {{ $flat->address->divisionInfo->name == $division->name ? 'selected' : '' }}
                                                    value="{{ $division->id }}">{{ $division->name }}</option>
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
                                        <select name="district" id="district" class="form-control"
                                            onchange="handleDistrict(this)">
                                            <option>Select District</option>
                                            @foreach ($districts as $district)
                                                <option
                                                    {{ $flat->address->districtInfo->name == $district->name ? 'selected' : '' }}
                                                    value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('district')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Thana:</label>
                                        <select name="thana" id="thana" class="form-control">
                                            <option>Select Thana</option>
                                            @foreach ($thanas as $thana)
                                                <option
                                                    {{ $flat->address->thanaInfo->name == $thana->name ? 'selected' : '' }}
                                                    value="{{ $thana->id }}">{{ $thana->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('thana')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Socity Name:</label>
                                        <input type="text" name="socity_name" value='{{ $flat->address->socity_name }}'
                                            class="form-control" placeholder="Socity Name">
                                        @error('socity_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Road Number:</label>
                                        <input type="text" name="road_number" value='{{ $flat->address->road_number }}'
                                            class="form-control" placeholder="Road Number">
                                        @error('road_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Block:</label>
                                        <input type="text" name="block" value='{{ $flat->address->block }}'
                                            class="form-control" placeholder="Block">
                                        @error('block')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>House Number:</label>
                                        <input type="text" name="house_number"
                                            value='{{ $flat->address->house_number }}' class="form-control"
                                            placeholder="House Number">
                                        @error('house_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Flat Number:</label>
                                        <input type="text" name="flat_number" value='{{ $flat->address->flat_number }}'
                                            class="form-control" placeholder="Flat Number">
                                        @error('flat_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!---------------2nd Table Data----------->

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Flat Name:</label>
                                        <input type="text" name="flat_name" value='{{ $flat->flat_name }}'
                                            class="form-control" placeholder="Flat Name">
                                        @error('flat_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Total Square Feet:</label>
                                        <input type="text" name="sft" value="{{ $flat->sft }}"
                                            class="form-control" placeholder="Total Square Feet">
                                        @error('sft')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Bed Room:</label>
                                        <input type="text" name="bed_room" value="{{ $flat->bed_room }}"
                                            class="form-control" placeholder="Bed Room">
                                        @error('bed_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Dining Room:</label>
                                        <input type="text" name="dining_room" value="{{ $flat->dining_room }}"
                                            class="form-control" placeholder="Dining Room">
                                        @error('dining_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Drawing Room:</label>
                                        <input type="text" name="drawing_room" value="{{ $flat->drawing_room }}"
                                            class="form-control" placeholder="Drawing Room">
                                        @error('drawing_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Bath Room:</label>
                                        <input type="text" name="bath_room" value="{{ $flat->bath_room }}"
                                            class="form-control" placeholder="Bath Room">
                                        @error('bath_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Kitchen Room:</label>
                                        <input type="text" name="kitchen_room" value="{{ $flat->kitchen_room }}"
                                            class="form-control" placeholder="Kitchen Room">
                                        @error('kitchen_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Store Room:</label>
                                        <input type="text" name="store_room" value="{{ $flat->store_room }}"
                                            class="form-control" placeholder="Store Room">
                                        @error('store_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Belkuni:</label>
                                        <input type="text" name="belkuni" value="{{ $flat->belkuni }}"
                                            class="form-control" placeholder="Belkuni">
                                        @error('belkuni')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ $flat->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="2" {{ $flat->status == 2 ? 'selected' : '' }}>Inactive
                                        </option>
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
                            @if (sizeof($flat->files()) >= config('variables.FLAT_MAX_IMAGES'))
                                <div>Maximum {{ config('variables.FLAT_MAX_IMAGES') }} images are allowed for a flat.
                                    Please
                                    delete exiting images before upload any
                                    image.</div>
                            @else
                                <div class="mb-3 mb-4">
                                    <input type="file" name="file[]" multiple class="form-control">
                                    <!-- Error -->
                                    @if ($errors->has('file'))
                                        <div class='text-danger mt-2'>
                                            * {{ $errors->first('file') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3 mb-4">
                                    <button type="submit" id="fileUploader" class="btn btn-primary">
                                        Upload
                                        <div class="spinner-border spinner-border-sm" role="status"> </div>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 mt-2 ">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="fileUploader" class="btn btn-primary">
                        Update
                        <div class="spinner-border spinner-border-sm" role="status"> </div>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
