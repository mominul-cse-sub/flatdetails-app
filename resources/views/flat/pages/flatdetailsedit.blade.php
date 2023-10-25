@extends('flat.layouts.flatLayout')

@section('content')

    <head>
        @vite(['resources/sass/flatdetails.scss', 'resources/js/app.js'])
    </head>
    <div class="container">
        <form method="post" onsubmit="return handleBasicForm('fileUploader')"
            action="{{ route('flat.update', $flatlocation->id) }}" enctype="multipart/form-data" class="mt-0">
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
                                    <div class="form-group">
                                        <label>Division:</label>
                                        <input type="text" name="division" value='{{ $flatlocation->division }}'
                                            class="form-control" placeholder="Division">
                                        @error('division')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>District:</label>
                                        <input type="text" name="district" value='{{ $flatlocation->district }}'
                                            class="form-control" placeholder="District">
                                        @error('district')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Thana:</label>
                                        <input type="text" name="thana" value='{{ $flatlocation->thana }}'
                                            class="form-control" placeholder="Thana">
                                        @error('thana')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Socity Name:</label>
                                        <input type="text" name="socity_name" value='{{ $flatlocation->socity_name }}'
                                            class="form-control" placeholder="Socity Name">
                                        @error('socity_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Road Number:</label>
                                        <input type="text" name="road_number" value='{{ $flatlocation->road_number }}'
                                            class="form-control" placeholder="Road Number">
                                        @error('road_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Block:</label>
                                        <input type="text" name="block" value='{{ $flatlocation->block }}'
                                            class="form-control" placeholder="Block">
                                        @error('block')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>House Number:</label>
                                        <input type="text" name="house_number" value='{{ $flatlocation->house_number }}'
                                            class="form-control" placeholder="House Number">
                                        @error('house_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Flat Number:</label>
                                        <input type="text" name="flat_number" value='{{ $flatlocation->flat_number }}'
                                            class="form-control" placeholder="Flat Number">
                                        @error('flat_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!---------------2nd Table Data----------->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Flat Name:</label>
                                        <input type="text" name="flat_name" value='{{ $flatdetails->flat_name }}'
                                            class="form-control" placeholder="Flat Name">
                                        @error('flat_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Square Feet:</label>
                                        <input type="text" name="sft" value="{{ $flatdetails->sft ?? '' }}"
                                            class="form-control" placeholder="Total Square Feet">
                                        @error('sft')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bed Room:</label>
                                        <input type="text" name="bed_room" value="{{ $flatdetails->bed_room ?? '' }}"
                                            class="form-control" placeholder="Bed Room">
                                        @error('bed_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dining Room:</label>
                                        <input type="text" name="dining_room"
                                            value="{{ $flatdetails->dining_room ?? '' }}" class="form-control"
                                            placeholder="Dining Room">
                                        @error('dining_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Drawing Room:</label>
                                        <input type="text" name="drawing_room"
                                            value="{{ $flatdetails->drawing_room ?? '' }}" class="form-control"
                                            placeholder="Drawing Room">
                                        @error('drawing_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Bath Room:</label>
                                        <input type="text" name="bath_room"
                                            value="{{ $flatdetails->bath_room ?? '' }}" class="form-control"
                                            placeholder="Bath Room">
                                        @error('bath_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kitchen Room:</label>
                                        <input type="text" name="kitchen_room"
                                            value="{{ $flatdetails->kitchen_room ?? '' }}" class="form-control"
                                            placeholder="Kitchen Room">
                                        @error('kitchen_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Store Room:</label>
                                        <input type="text" name="store_room"
                                            value="{{ $flatdetails->store_room ?? '' }}" class="form-control"
                                            placeholder="Store Room">
                                        @error('store_room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Belkuni:</label>
                                        <input type="text" name="belkuni" value="{{ $flatdetails->belkuni ?? '' }}"
                                            class="form-control" placeholder="Belkuni">
                                        @error('belkuni')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="status">Status:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ $flatdetails->status == 1 ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="2" {{ $flatdetails->status == 2 ? 'selected' : '' }}>Inactive
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
                            <div class="form-group mb-4">
                                <input type="file" name="file" multiple class="form-control">
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
                        Update
                        <div class="spinner-border spinner-border-sm" role="status"> </div>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
