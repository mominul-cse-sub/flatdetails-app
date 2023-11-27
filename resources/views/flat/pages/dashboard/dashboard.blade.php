@extends('flat.layouts.flatLayout')

@section('content')
    <div class="row">
        <div class="col-md-3 ">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header">All Flat</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $allflat }}</h2>
                </div>
                <div class="card-footer">
                    <a class="text-white d-block text-decoration-none" href="{{ route('flat.allflat') }}">Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 ">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">Active Flat</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $activeflat }}</h2>
                </div>
                <div class="card-footer">
                    <a class="text-white d-block text-decoration-none" href="{{ route('flat.activeflat') }}">Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 ">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
                <div class="card-header">Inactive Flat</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $inactiveflat }}</h2>
                </div>
                <div class="card-footer">
                    <a class="text-white d-block text-decoration-none" href="{{ route('flat.inactiveflat') }}">Details</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 ">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header">Deleted Flat</div>
                <div class="card-body">
                    <h2 class="card-title">{{ $deleteflat }}</h2>
                </div>
                <div class="card-footer">
                    <a class="text-white d-block text-decoration-none" href="#">Details</a>
                </div>
            </div>
        </div>
    @endsection
