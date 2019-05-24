@extends('layouts.app')

@section('content')
<div class="container">
    {{--<div class="row justify-content-center">--}}
        <div class="panel panel-primary">
            <div class="panel-heading"><h2>{{__('Photo Upload')}}</h2></div>
            <div class="panel-body">
                @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    <img src="{{
                     \Illuminate\Support\Facades\URL::to('/').'/storage/img/'.
                     \Illuminate\Support\Facades\Session::get('photo') }}"
                         style="margin:5px; height: 200px; width: 200px;">
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>{{__('Whoops!')}}</strong> {{__('There were some problems with your input.')}}
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row justify-content-end">
                    <a class="btn btn-primary" href="{{route('articles.show', ['id' => $id])}}" role="button">
                        {{__('Back to Article')}}
                    </a>
                </div>

                <form action="{{ route('photo.upload', ['id' => $id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Select') }}</label>
                        <div class="col-md-6">
                            <input id="photo" type="file" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Caption') }}</label>

                        <div class="col-md-6">
                            <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autocomplete="caption">

                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{__('Upload')}}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    {{--</div>--}}
</div>
@endsection
