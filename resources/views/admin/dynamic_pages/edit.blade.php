@extends(config('admin.view.layouts.default'))

@section('content')
    <div class="row">
        <div class="col-6">
            <form action="{{ route('admin.dynamic-pages.update', $dynamicPage) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="slug">@lang('Slug')</label>
                    <div>
                        <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug"
                            value="{{ old('slug', $dynamicPage->slug) }}" required autocomplete="off" />
                        <x-error name="slug"></x-error>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cover">@lang('Cover')</label>
                    <div>
                        <div>
                            <a href="#" onclick="document.getElementById('cover').click(); return false;">
                                <img src="{{ $content->cover ? Storage::url($content->cover, 'public') : asset('img/placeholder_cover.png') }}"
                                    alt="Cover" id="coverPreview" class="w-100" />
                            </a>
                            <input type="file" name="cover" id="cover" class="d-none" accept="image/png,image/jpg" />
                        </div>
                        <x-error name="cover"></x-error>
                    </div>
                </div>

                <div class="form-group">
                    <label for="subject">@lang('Subject')</label>
                    <div>
                        <input type="text" id="subject" class="form-control @error('subject') is-invalid @enderror"
                            name="subject" value="{{ old('subject', $content->subject) }}" required autocomplete="off" />
                        <x-error name="subject"></x-error>
                    </div>
                </div>

                <div class="form-group">
                    <label for="body">@lang('Body')</label>
                    <div>
                        {{-- Quill Editor --}}
                        <div id="editor">{!! old('body', $content->getContentHtml()->toHtml()) !!}</div>

                        <input type="hidden" name="body" id="body" required />
                        <x-error name="body"></x-error>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary text-nowrap"
                        onclick="document.getElementById('body').value = document.getElementById('editor').innerHTML">
                        @lang('Update')
                    </button>
                </div>
            </form>

            <hr>

            <div>
                <a href="{{ route('admin.dynamic-pages.index') }}" class="btn btn-link text-nowrap">
                    @lang('Back')
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var editor = new Quill('#editor', {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['link'],
                    [{
                            'header': 1
                        },
                        {
                            'header': 2
                        }
                    ], // custom button values
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],

                    ['clean'] // remove formatting button
                ],
            },
            theme: 'snow'
        });

    </script>
    <script>
        document.getElementById('cover').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(ee) {
                document.getElementById('coverPreview').setAttribute('src', ee.target.result);
            };
            reader.readAsDataURL(e.target.files[0]);
        });

    </script>
@endsection

@push('head')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endpush
