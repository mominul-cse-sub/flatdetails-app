@extends('tenant.layouts.tenantLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div>
            <a class="btn btn-primary" href="/tenant"><i class="bi bi-plus-square"></i>Back</a>
        </div>
        <div>
            <Table class="table table-bordered">
                <thead class = "text-center">
                    <tr>
                        <th>Flat Id</th>
                        <th>Division</th>
                        <th>District</th>
                        <th>Thana</th>
                        <th>Socity Name</th>
                        <th>Road No</th>
                        <th>Block</th>
                        <th>House No</th>
                        <th>Flat No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <td class= "text-center">{{ $address->id }}</td>
                            <td>{{ $address->division }}</td>
                            <td>{{ $address->district }}</td>
                            <td>{{ $address->thana }}</td>
                            <td>{{ $address->socity_name }}</td>
                            <td class= "text-center">{{ $address->road_number }}</td>
                            <td class= "text-center">{{ $address->block }}</td>
                            <td class= "text-center">{{ $address->house_number }}</td>
                            <td class= "text-center">{{ $address->flat_number }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('tenant.show', $address->id) }}">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </Table>
        </div>
    </div>
@endsection
