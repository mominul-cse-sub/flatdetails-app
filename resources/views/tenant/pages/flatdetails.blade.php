@extends('tenant.layouts.tenantLayout')
@section('content')

    <head>
        @vite(['resources/sass/flat.scss', 'resources/js/app.js'])
    </head>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('Flat Details') }}</div>
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
            <a class="btn btn-primary" href="\tenant\allflat"><i class="bi bi-arrow-left-short"></i>Back</a>
            <div>
                <Table class="table table-bordered">
                    <thead class = "text-center">
                        <tr>
                            <th>Flat Id</th>
                            <th>Total Square Feet</th>
                            <th>Total Room</th>
                            <th>Dining Room</th>
                            <th>Drawing Room</th>
                            <th>Bath Room</th>
                            <th>Kitchen Room</th>
                            <th>Store Room</th>
                            <th>Belkuni</th>
                        </tr>
                    </thead>
                    <tbody class = "text-center">
                        <tr>
                            <td>{{ $flatdetails->flat_id }}</td>
                            <td>{{ $flatdetails->sft }}</td>
                            <td>{{ $flatdetails->total_room }}</td>
                            <td>{{ $flatdetails->dining_room }}</td>
                            <td>{{ $flatdetails->drawing_room }}</td>
                            <td>{{ $flatdetails->bath_room }}</td>
                            <td>{{ $flatdetails->kitchen_room }}</td>
                            <td>{{ $flatdetails->store_room }}</td>
                            <td>{{ $flatdetails->belkuni }}</td>
                        </tr>
                    </tbody>
                </Table>
            </div>
        </div>
    @endsection
