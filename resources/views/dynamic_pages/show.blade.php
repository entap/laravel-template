@extends('layouts.app')

@section('content')
    <div>
        {{ $page->slug }}
    </div>

    <div>
        {{ $content->subject }}
    </div>

    <div>
        {!! $contentBody !!}
    </div>
@endsection
