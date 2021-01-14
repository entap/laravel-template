@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ __('Add Mail Template') }}</h1>

    <div class="alert alert-secondary">
        <ul class="small m-0">
            <li>メールテンプレートの送信元、宛先、題名、本文には、{変数名}の形式で変数を埋め込みできます。</li>
            <li>宛先はセミコロンで区切ることで複数のアドレスを指定ができます。</li>
        </ul>
    </div>

    <form action="{{ route('admin.mails.store') }}" method="POST">
        @csrf

        <fieldset class="form-group">
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <div>
                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                        value="{{ old('title', '') }}" required autocomplete="off" />
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <div>
                    <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                        name="description" autocomplete="off">{{ old('description', '') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <label for="mail_type_id">{{ __('Mail Type') }}</label>
                <div>
                    <select name="mail_type_id" id="mail_type_id"
                        class="form-control @error('mail_type_id') is-invalid @enderror">
                        @foreach ($typeOptions as $option)
                            <option value="{{ $option->id }}"
                                {{ $option->id === old('mail_type_id', '') ? 'selected' : '' }}>
                                {{ $option->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('mail_type_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="from">{{ __('From') }}</label>
                <div>
                    <input type="text" id="from" class="form-control @error('from') is-invalid @enderror" name="from"
                        value="{{ old('from', '') }}" required autocomplete="off" />
                    @error('from')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="to">{{ __('To') }}</label>
                <div>
                    <input type="text" id="to" class="form-control @error('to') is-invalid @enderror" name="to"
                        value="{{ old('to', '') }}" required autocomplete="off" />
                    @error('to')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subject">{{ __('Subject') }}</label>
                <div>
                    <input type="text" id="subject" class="form-control @error('subject') is-invalid @enderror"
                        name="subject" value="{{ old('subject', '') }}" required autocomplete="off" />
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="body">{{ __('Body') }}</label>
                <div>
                    <textarea type="text" id="body" class="form-control @error('body') is-invalid @enderror" name="body"
                        required autocomplete="off">{{ old('body', '') }}</textarea>
                    @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <label for="status">{{ __('Status') }}</label>
                <div>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                        @foreach ($statusOptions as $option)
                            <option value="{{ $option['value'] }}"
                                {{ $option['value'] === old('status', '') ? 'selected' : '' }}>
                                {{ $option['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="starts_at">{{ __('Start Date') }}</label>
                <div>
                    <input type="datetime-local" id="starts_at"
                        class="form-control @error('starts_at') is-invalid @enderror" name="starts_at"
                        value="{{ old('starts_at', '') }}" required autocomplete="off" />
                    @error('starts_at')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="expires_at">{{ __('Expire Date') }}</label>
                <div>
                    <input type="datetime-local" id="expires_at"
                        class="form-control @error('expires_at') is-invalid @enderror" name="expires_at"
                        value="{{ old('expires_at', '') }}" required autocomplete="off" />
                    @error('expires_at')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </fieldset>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create') }}
            </button>
        </div>
    </form>
@endsection
