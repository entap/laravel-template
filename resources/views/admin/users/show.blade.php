@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ $user->name }}</h1>
@endsection
