@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>{{ $content->subject }}</h1>
            <div>{{ $content->getContentHtml() }}</div>
        </div>
    </div>
@endsection
