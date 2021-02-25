@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Jobs')</h1>

    <div class="mt-4">
        @foreach ($jobs as $job)
            <div class="card my-2">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $job->title }}
                    </h5>
                    <div class="card-text">
                        {{ $job->description }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $jobs->withQueryString()->links() }}
    </div>
@endsection
