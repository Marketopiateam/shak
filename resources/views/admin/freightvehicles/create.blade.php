@extends('layouts.admin')
@section('content')
@section('title', $pageTitle)
@section('pageName', $pageTitle)
@push('styles')
    <link rel="stylesheet" href="{{ asset('custom/marketopia-drop-zone/css/style.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('custom/marketopia-drop-zone/js/script.js') }}"></script>
@endpush
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.freight-vehicles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-name">{{ __('cruds.freightVehicle.fields.name') }}</label>
                                <input type="text" name="name" class="form-control" id="basic-default-name"
                                    placeholder="{{ __('cruds.freightVehicle.fields.name') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-km_charge">{{ __('cruds.freightVehicle.fields.km_charge') }}</label>
                                <input type="number" name="km_charge" step="0.5" class="form-control"
                                    placeholder="{{ __('cruds.freightVehicle.fields.km_charge') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="switch switch-primary">
                                    <input type="checkbox" class="switch-input" name="enable" checked="">
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="ti ti-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="ti ti-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">
                                        {{ __('cruds.freightVehicle.fields.enable') }}
                                    </span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <label class="form-label"
                                for="basic-default-title">{{ __('cruds.freightVehicle.fields.image') }}</label>
                            <div class="marketopia-dropzone" id="dropzone">
                                <input type="file" hidden name="images[]" id="fileInput" accept="image/*" multiple>
                                <div class="mdz-message" id="mdzMessage">
                                    Drop files here or click to upload
                                    <span class="note">(This is just a demo dropzone. Selected files are <span
                                            class="fw-medium">not</span> actually uploaded.)</span>
                                </div>
                                <div id="previewContainer"
                                    style="display: flex; flex-wrap: wrap; gap: 1rem; margin-top: 1rem;"></div>
                            </div>
                            <br><br>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-height">{{ __('cruds.freightVehicle.fields.height') }}</label>
                                <input type="text" name="height" class="form-control" id="basic-default-height"
                                    placeholder="{{ __('cruds.freightVehicle.fields.height') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-width">{{ __('cruds.freightVehicle.fields.width') }}</label>
                                <input type="text" name="width" class="form-control" id="basic-default-width"
                                    placeholder="{{ __('cruds.freightVehicle.fields.width') }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-description">{{ __('cruds.freightVehicle.fields.description') }}</label>
                                <textarea type="text" name="description" class="form-control" id="basic-default-description"
                                    placeholder="{{ __('cruds.freightVehicle.fields.description') }}"></textarea>
                            </div>
                        </div>
                    </div>
            </div>

            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('global.save') }}</button>
            </form>
        </div>
    </div>
</div>



@endsection
