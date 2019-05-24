@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($articles as $article)
                <div style="margin: 10px">
                    <div>
                        <strong>
                            <a href="{{route('articles.show', ['id' => $article->id])}}">
                                {{$article->title}}
                            </a>
                        </strong>
                        <small>Created at: {{date('l jS \of F Y h:i:s A', strtotime($article->created_at))}}</small>
                        <small>By {{$article->author->name}}</small>
                    </div>
                    <div>{{$article->preview( app()->make(\App\Services\Summarizers\NewsStandSummarizer::class))}}</div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
