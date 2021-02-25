@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Jobs')</h1>

    <div class="mt-4">
        @foreach ($jobs as $job)
            <div class="card my-2">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $job->title }}
                        @if ($job->isPending())
                            <div class="badge badge-sm badge-secondary">
                                {{ $job->status }}
                            </div>
                        @endif
                        @if ($job->isProgressing())
                            <div class="badge badge-sm badge-primary">
                                {{ $job->status }}
                            </div>
                        @endif
                        @if ($job->isSuccess())
                            <div class="badge badge-sm badge-success">
                                {{ $job->status }}
                            </div>
                        @endif
                        @if ($job->isFailed())
                            <div class="badge badge-sm badge-danger">
                                {{ $job->status }}
                            </div>
                        @endif
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
