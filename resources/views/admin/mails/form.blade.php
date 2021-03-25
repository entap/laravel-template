<fieldset class="form-group">
    <div class="form-group">
        <label for="title">@lang('mails.properties.title')</label>
        <div>
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                value="{{ old('title', isset($mail) ? $mail->title : '') }}" required autocomplete="off" />
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="description">@lang('mails.properties.description')</label>
        <div>
            <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                name="description"
                autocomplete="off">{{ old('description', isset($mail) ? $mail->description : '') }}</textarea>
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
        <label for="mail_type_id">@lang('mails.properties.mail_type')</label>
        <div>
            <select name="mail_type_id" id="mail_type_id"
                class="form-control @error('mail_type_id') is-invalid @enderror">
                @foreach ($typeOptions as $option)
                    <option value="{{ $option->id }}"
                        {{ $option->id === old('mail_type_id', isset($mail) ? $mail->mail_type_id : '') ? 'selected' : '' }}>
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
        <label for="from">@lang('mails.properties.from')</label>
        <div>
            <input type="text" id="from" class="form-control @error('from') is-invalid @enderror" name="from"
                value="{{ old('from', isset($mail) ? $mail->from : '') }}" required autocomplete="off" />
            @error('from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="to">@lang('mails.properties.to')</label>
        <div>
            <input type="text" id="to" class="form-control @error('to') is-invalid @enderror" name="to"
                value="{{ old('to', isset($mail) ? $mail->to : '') }}" required autocomplete="off" />
            @error('to')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="subject">@lang('mails.properties.subject')</label>
        <div>
            <input type="text" id="subject" class="form-control @error('subject') is-invalid @enderror" name="subject"
                value="{{ old('subject', isset($mail) ? $mail->subject : '') }}" required autocomplete="off" />
            @error('subject')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="body">@lang('mails.properties.body')</label>
        <div>
            <textarea type="text" id="body" class="form-control @error('body') is-invalid @enderror" name="body"
                required autocomplete="off">{{ old('body', isset($mail) ? $mail->body : '') }}</textarea>
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
        <label for="status">@lang('mails.properties.status')</label>
        <div>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                @foreach ($statusOptions as $option)
                    <option value="{{ $option['value'] }}"
                        {{ $option['value'] === old('status', isset($mail) ? $mail->status : '') ? 'selected' : '' }}>
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
        <label for="starts_at">@lang('mails.properties.start_date')</label>
        <div>
            <input type="datetime-local" id="starts_at" class="form-control @error('starts_at') is-invalid @enderror"
                name="starts_at"
                value="{{ old('starts_at', isset($mail) ? optional($mail->starts_at)->format('Y-m-d\TH:i') : '') }}"
                autocomplete="off" />
            @error('starts_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <label for="expires_at">@lang('mails.properties.expire_date')</label>
        <div>
            <input type="datetime-local" id="expires_at" class="form-control @error('expires_at') is-invalid @enderror"
                name="expires_at"
                value="{{ old('expires_at', isset($mail) ? optional($mail->expires_at)->format('Y-m-d\TH:i') : '') }}"
                autocomplete="off" />
            @error('expires_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</fieldset>
