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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($flats as $flat)
                        <tr>
                            <td class= "text-center">{{ $flat->id }}</td>
                            <td>{{ $flat->flat_name }}</td>
                            <td>
                                {{ $flat->address->divisionInfo->name }}, {{ $flat->address->districtInfo->name }},
                                {{ $flat->address->thanaInfo->name }}
                            </td>
                            <td class= "text-center">
                                <img style="max-width:100px"
                                    src="{{ isset($flat->files()[0]) ? str_replace('uploads/', 'uploads/200X200-', $flat->files()[0]->imagepath) : '/images/no-image-wide.jpg' }}"
                                    alt="">
                            </td>
                            <td class="text-center">
                                <span style="color: {{ $flat->status == 1 ? 'green' : 'red' }}">
                                    {{ $flat->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <form class="text-center" action="{{ route('destroy', $flat->id) }}" method="Post">
                                    <a class="btn btn-primary" title="Flat Details" href="{{ route('show', $flat->id) }}"><i
                                            class="fa-solid fa-eye"></i></a>
                                    <a class="btn btn-primary" title="Edit" href="{{ route('flat.edit', $flat->id) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal{{ $flat->id }}" title="Delete"><i
                                            class="fa-solid fa-trash " title="Flat Details"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="confirmModal{{ $flat->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body text-start">
                                                    Are you sure?
                                                </div>
                                                <div class="modal-footer d-flex justify-content-start">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                    <form class="text-center" action="{{ route('destroy', $flat->id) }}"
                                                        method="post">
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
