@extends('flat.layouts.flatLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Notifications
                    </div>
                    <div class="card-body notification">
                        <ul class="list-group">
                            @forelse(Auth::user()->allnotification() as $notification)
                                <li class="list-group-item {{ $notification->is_read == 0 ? 'unread' : 'read' }}">
                                    <a class="text-dark text-decoration-none" href="javascript:void(0)"
                                        onclick="openNotification({{ json_encode($notification) }})">
                                        <div class="row">
                                            <div class="col-6 title">
                                                {{ $notification->title }}
                                            </div>
                                            <div class="col-6 text-end">
                                                <small>{{ $notification->created_at->diffForHumans() }}</small>
                                            </div>
                                        </div>
                                        <div>
                                            {{ $notification->description }}
                                        </div>

                                    </a>
                                </li>
                            @empty
                                <div>
                                    <i class="fa-regular fa-folder-open"></i>
                                </div>
                            @endforelse
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
