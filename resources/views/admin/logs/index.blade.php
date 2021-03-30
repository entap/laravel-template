@extends(config('admin.view.layouts.default'))

@section('content')
    @if (count($tables))
        <form action="{{ route('admin.logs.show') }}">
            <div class="form-group">
                <label for="table">{{ __('Table Name') }}</label>
                <div>
                    <select name="table" id="table" class="form-control @error('table') is-invalid @enderror">
                        @foreach ($tables as $table)
                            <option value="{{ $table->getName() }}"
                                {{ old('table', '') == $table->getName() ? 'selected' : '' }}>
                                {{ $table->getName() }}
                            </option>
                        @endforeach
                    </select>

                    <x-error name="table"></x-error>
                </div>
            </div>

            <div class="form-group">
                <label for="fields">{{ __('Fields & keywords') }}</label>
                <div>
                    @for ($i = 0; $i < 3; $i++)
                        <div class="row mb-1">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="fields[{{ $i }}][key]"
                                    value="{{ old("fields.{$i}.key") }}" autocomplete="off" />
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="fields[{{ $i }}][query]"
                                    value="{{ old("fields.{$i}.query") }}" autocomplete="off" />
                            </div>
                        </div>
                    @endfor
                    <x-error name="fields"></x-error>
                </div>
            </div>

            <div class="form-group">
                <label for="start_created_at">{{ __('Created At') }}</label>
                <div class="mb-1">
                    <input type="datetime-local" id="start_created_at"
                        class="form-control @error('start_created_at') is-invalid @enderror" name="start_created_at"
                        value="{{ old('start_created_at', '') }}" autocomplete="off" />
                    <x-error name="start_created_at"></x-error>
                </div>
                <div>
                    <input type="datetime-local" id="stop_created_at"
                        class="form-control @error('stop_created_at') is-invalid @enderror" name="stop_created_at"
                        value="{{ old('stop_created_at', '') }}" autocomplete="off" />
                    <x-error name="stop_created_at"></x-error>
                </div>
            </div>

            <div class="text-right mt-4">
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Search') }}
                    </button>
                </div>
            </div>
        </form>
    @else
        <div>{{ __('No Log Table') }}</div>
    @endif
@endsection
