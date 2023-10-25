@extends('admin.layouts.adminLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Flat Owner List') }}</div>
                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <div class="alert {{ Session::get('alert-class') }} ">
                {{ Session::get('message') }}
            </div>
        @elseif(Session::has('delete'))
            <div class="alert {{ Session::get('alert-class') }} ">
                {{ Session::get('delete') }}
            </div>
        @endif

        <div>
            <a class="btn btn-primary" href="\admin"><i class="bi bi-arrow-left-short"></i>Back</a>
            <div>
                <Table class="table table-bordered">
                    <thead class = "text-center">
                        <tr>
                            <th>Flat Owner Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flatowners as $flatowner)
                            <tr>
                                <td class= "text-center">{{ $flatowner->id }}</td>
                                <td>{{ $flatowner->name }}</td>
                                <td>{{ $flatowner->email }}</td>
                                <td>
                                    <form class="text-center" action="#" method="Post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </Table>
            </div>
        </div>
    </div>
@endsection
