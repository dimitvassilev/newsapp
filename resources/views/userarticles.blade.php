@extends('layouts.app')

@section('content')
<div class="container">
        @if(\Illuminate\Support\Facades\Session::has('message'))
            <div class="row justify-content-center">
                <p class="alert alert-info">
                    {{ \Illuminate\Support\Facades\Session::get('message') }}</p>
            </div>
        @endif
            <h3>{{__('My Articles')}}</h3>
            <div class="row justify-content-end">
                <a class="btn btn-primary" href="{{route('articles.new')}}" role="button">{{__('New Article')}}</a>
            </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            @foreach($articles as $article)
                <div class="row justify-content-center" style="margin:15px">
                    <div class="col-md-8">
                        <div>
                            <strong>
                                <a href="{{route('articles.show', ['id' => $article->id])}}">
                                    {{$article->title}}
                                </a>
                            </strong>
                            <div>
                                <small>Created at: {{date('l jS \of F Y h:i:s A', strtotime($article->created_at))}}</small>
                            </div>
                        </div>
                        <div>{{$article->preview( app()->make(\App\Services\Summarizers\NewsStandSummarizer::class))}}</div>

                    </div>
                    <div class="col-md-2">
                        @include('partials.deletebutton')
                    </div>
                    <div class="col-md-2">
                        @include('partials.downloadbutton')
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
{{ $articles->links() }}
@endsection
