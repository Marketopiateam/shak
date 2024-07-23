@extends('layouts.admin')
@section('content')
@section('title', $pageTitle)
@section('pageName', $pageTitle)
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
@endpush
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="name">{{ __('global.name') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ __('global.name') }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label" for="name">{{ __('global.content_en') }}</label>
                            <div class="content_en"></div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-label" for="name">{{ __('global.content_ar') }}</label>
                            <div class="content_ar"></div>
                        </div>
                    </div>


            </div>

            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('global.save') }}</button>
            </form>
        </div>
    </div>
</div>




@endsection
