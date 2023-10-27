@extends('flat.layouts.flatLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">User Profile</div>
                    <div class="card-body">
                        <img src="{{ Auth::user()->avatar ? '/images/avatar.jpg' : '/images/avatar.jpg' }}"
                            class="card-img-top rounded-circle mx-auto mt-0" alt="Profile Picture"
                            style="width: 100px; height: 100px;">
                        <h5 class="card-title mt-2 ms-3">{{ Auth::user()->name }}</h5>
                        <form method="post" onsubmit="return handleBasicForm('fileUploader')" action="#"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
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
                                        Change Picture
                                        <div class="spinner-border spinner-border-sm" role="status"> </div>
                                    </button>
                                </div>
                            </div>
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
                                        <select name="division" id="division" class="form-control">
                                            @foreach ($divisions as $divisionlist)
                                                <option value="{{ $divisionlist->name }}">{{ $divisionlist->name }}
                                                </option>
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
                                        <select name="district" id="district" class="form-control">
                                            @foreach ($districts as $districtlist)
                                                <option value="{{ $districtlist->name }}">{{ $districtlist->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('district')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Thana:</label>
                                        <select name="thana" id="thana" class="form-control">
                                            @foreach ($thanas as $thanalist)
                                                <option {{ $flatlocation->thana == $thanalist->name ? 'selected' : '' }}
                                                    value="{{ $thanalist->name }}">{{ $thanalist->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('thana')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Socity Name:</label>
                                        <input type="text" name="socity_name" value='{{ $flatlocation->socity_name }}'
                                            class="form-control" placeholder="Socity Name">
                                        @error('socity_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Road Number:</label>
                                        <input type="text" name="road_number" value='{{ $flatlocation->road_number }}'
                                            class="form-control" placeholder="Road Number">
                                        @error('road_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>Block:</label>

                                        @if ($flatlocation == null)
                                            <input type="text" name="block" value='' class="form-control"
                                                placeholder="Block">
                                        @else
                                            <input type="text" name="block" value='{{ $flatlocation->block }}'
                                                class="form-control" placeholder="Block">
                                        @endif
                                        @error('block')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label>House Number:</label>
                                        @if ($flatlocation == null)
                                            <input type="text" name="house_number" value=''
                                                class="form-control" placeholder="House Number">
                                        @else
                                            <input type="text" name="house_number"
                                                value='{{ $flatlocation->house_number }}' class="form-control"
                                                placeholder="House Number">
                                        @endif
                                        @error('house_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <label>Flat Number:</label>

                                        @if ($flatlocation == null)
                                            <input type="text" name="flat_number" value='' class="form-control"
                                                placeholder="Flat Number">
                                        @else
                                            <input type="text" name="flat_number"
                                                value='{{ $flatlocation->flat_number }}' class="form-control"
                                                placeholder="Flat Number">
                                        @endif
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
