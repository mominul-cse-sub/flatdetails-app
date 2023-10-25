@extends('flat.layouts.flatLayout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
            </div>
        </div>
        <div>
            <h2 class="m-0 mb-2">All Flats
                <a href="/flat/create" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-plus"></i> Add New
                </a>
            </h2>
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
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($flatlocations as $flatlocation)
                        <tr>
                            <td class= "text-center">{{ $flatlocation->id }}</td>
                            <td>{{ $flatlocation->division }}</td>
                            <td>{{ $flatlocation->district }}</td>
                            <td>{{ $flatlocation->thana }}</td>
                            <td>{{ $flatlocation->socity_name }}</td>
                            <td class= "text-center">{{ $flatlocation->road_number }}</td>
                            <td class= "text-center">{{ $flatlocation->block }}</td>
                            <td class= "text-center">{{ $flatlocation->house_number }}</td>
                            <td class= "text-center">{{ $flatlocation->flat_number }}</td>
                            <td class="text-center">
                                <span style="color: {{ $flatlocation->status == 1 ? 'green' : 'red' }}">
                                    {{ $flatlocation->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <form class="text-center" action="{{ route('destroy', $flatlocation->id) }}"
                                    method="Post">
                                    <a class="btn btn-primary" title="Flat Details"
                                        href="{{ route('show', $flatlocation->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    <a class="btn btn-primary" title="Edit"
                                        href="{{ route('flat.edit', $flatlocation->id) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal{{ $flatlocation->id }}" title="Delete"><i
                                            class="fa-solid fa-trash " title="Flat Details"></i>
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
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                    <form class="text-center"
                                                        action="{{ route('destroy', $flatlocation->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Yes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </Table>
        </div>
    </div>
@endsection
