@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Notifications</div>
                @foreach ($notifications as $notification)
                    <p><a href="{{ $notification->data['url'] }}">Click to Verify Email</a></p>
                @endforeach
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
