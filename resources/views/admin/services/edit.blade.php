@extends('layouts.admin')
@section('content')
@section('title', __('global.edit').' | '.$pageTitle)
@section('pageName', __('global.edit').' | '.$pageTitle)
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('custom/marketopia-drop-zone/css/style.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('custom/marketopia-drop-zone/js/script.js') }}"></script>
    <script>
        $(function() {
            var select2 = $('.select2');
            if (select2.length) {
                select2.each(function() {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>').select2({
                        placeholder: 'Select value',
                        dropdownParent: $this.parent()
                    });
                });
            }
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const commissionTypeCheckbox = document.getElementById('commissionTypeCheckbox');
            const adminCommissionInput = document.getElementById('adminCommissionInput');

            // Function to toggle the visibility of the admin commission input
            function toggleAdminCommissionInput() {
                if (commissionTypeCheckbox.checked) {
                    adminCommissionInput.classList.remove('d-none');
                    adminCommissionInput.style.display = 'block';
                } else {
                    adminCommissionInput.classList.add('d-none');
                    adminCommissionInput.style.display = 'none';
                }
            }

            // Add event listener for checkbox change
            commissionTypeCheckbox.addEventListener('change', toggleAdminCommissionInput);

            // Initialize the visibility based on the checkbox state
            toggleAdminCommissionInput();
        });
    </script>
@endpush
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('admin.services.update', $row) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-title">{{ __('cruds.service.fields.title') }}</label>
                                <input type="text" name="title" class="form-control" id="basic-default-title"
                                    placeholder="{{ __('cruds.service.fields.title') }}" value="{{ $row->title }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-km_charge">{{ __('cruds.service.fields.km_charge') }}</label>
                                <input type="number" name="km_charge" step="0.5" class="form-control"
                                    placeholder="{{ __('cruds.service.fields.km_charge') }}"value="{{ $row->km_charge }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="switch switch-primary">
                                    <input type="checkbox" class="switch-input" name="enable" {{ $row->enable == 1 ? 'checked' : '' }}>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="ti ti-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="ti ti-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">
                                        {{ __('cruds.service.fields.enable') }}
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="switch switch-primary">
                                    <input type="checkbox" class="switch-input" name="offer_rate" {{ $row->offer_rate == 1 ? 'checked' : '' }}>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="ti ti-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="ti ti-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">
                                        {{ __('cruds.service.fields.offer_rate') }}
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="switch switch-primary">
                                    <input type="checkbox" class="switch-input" name="intercity_type" {{ $row->intercity_type == 1 ? 'checked' : '' }}>
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="ti ti-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="ti ti-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label">
                                        {{ __('cruds.service.fields.intercity_type') }}
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label"
                                for="basic-default-title">{{ __('cruds.service.fields.image') }}</label>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="mb-3">
                                    <label class="switch switch-primary">
                                        <input type="checkbox" class="switch-input" name="commission_type" id="commissionTypeCheckbox" {{ $row->commission_type == 1 ? 'checked' : '' }}>
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="ti ti-check"></i>
                                            </span>
                                            <span class="switch-off">
                                                <i class="ti ti-x"></i>
                                            </span>
                                        </span>
                                        <span class="switch-label">
                                            {{ __('cruds.service.fields.commission_type') }}
                                        </span>
                                    </label>
                                </div>
                               
                            </div>
                            <div class="">
                                <div class="mb-3 {{ $row->commission_type == 1 ? 'd-block' : 'd-none' }}" id="adminCommissionInput">
                                    <label class="form-label" for="basic-default-admin_commission">
                                        {{ __('cruds.service.fields.admin_commission') }}
                                    </label>
                                    <input type="number" name="admin_commission" step="0.5" class="form-control" id="basic-default-admin_commission"
                                        placeholder="{{ __('cruds.service.fields.admin_commission') }}" value="{{ $row->admin_commission }}">
                                </div>
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
