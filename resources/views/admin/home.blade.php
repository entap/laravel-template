@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ app('settings')->welcome_message }}</h1>
@endsection
