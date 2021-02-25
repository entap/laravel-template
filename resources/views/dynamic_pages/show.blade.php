@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($content->cover)
                <div>
                    <img src="{{ Storage::url($content->cover, 'public') }}" alt="Cover" class="w-100">
                </div>
            @endif

            <h1>{{ $content->subject }}</h1>
            <div>{{ $content->getContentHtml() }}</div>
        </div>
    </div>
@endsection
