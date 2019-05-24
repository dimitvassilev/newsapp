@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>{{$article->title}}</h3>
            <small>Created at: {{date('l jS \of F Y h:i:s A', strtotime($article->created_at))}}</small>
            <small>By {{$article->author->name}}</small>

            <div>
                @foreach($article->photos as $photo)
                    <div style="display: inline-block; vertical-align: top;">
                        <a href="{{ \Illuminate\Support\Facades\URL::to('/').$photo->path }}">
                            <img src="{{ \Illuminate\Support\Facades\URL::to('/').$photo->path }}"
                                 style="margin:5px; height: 200px; width: 200px;">
                        </a>
                        <div style="width: 200px;  word-wrap: break-word; margin:15px 0">
                            <small>{{$photo->caption}}</small>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="margin:15px 0">{{$article->body}}</div>
            @if($article->isAuthoredBy(\Illuminate\Support\Facades\Auth::user()))
                @include('partials.deletebutton')
            @endif

        </div>
        <div class="col-md-1">
                @include('partials.downloadbutton')
        </div>
        <div class="col-md-1">
            @if($article->isAuthoredBy(\Illuminate\Support\Facades\Auth::user()))
                @include('partials.uploadbutton')
            @endif
        </div>
    </div>
</div>
@endsection
