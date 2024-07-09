@extends('layouts.admin')
@section('content')
@section('title', $pageTitle)
@section('pageName', $pageTitle)
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script>
        $(function() {
            $(window).ready(function() {
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
            });
        });
    </script>
@endpush
<div class="row">
    <div class="col-lg-8">
        <div class="card mb-4">
            <form action="{{ route('admin.settings.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-facebook">{{ __('cruds.setting.fields.facebook') }}</label>
                                <input type="url" value="{{ $row->facebook }}" name="facebook"
                                    class="form-control" id="basic-default-facebook"
                                    placeholder="{{ __('cruds.setting.fields.facebook') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-youtube">{{ __('cruds.setting.fields.youtube') }}</label>
                                <input type="url" value="{{ $row->full_name }}" name="youtube"
                                    class="form-control" id="basic-default-youtube"
                                    placeholder="{{ __('cruds.setting.fields.youtube') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-linkedin">{{ __('cruds.setting.fields.linkedin') }}</label>
                                <input type="url" value="{{ $row->linkedin }}" name="linkedin"
                                    class="form-control" id="basic-default-linkedin"
                                    placeholder="{{ __('cruds.setting.fields.linkedin') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-twitter">{{ __('cruds.setting.fields.twitter') }}</label>
                                <input type="url" value="{{ $row->full_name }}" name="twitter"
                                    class="form-control" id="basic-default-twitter"
                                    placeholder="{{ __('cruds.setting.fields.twitter') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-tiktok">{{ __('cruds.setting.fields.tiktok') }}</label>
                                <input type="url" value="{{ $row->tiktok }}" name="tiktok"
                                    class="form-control" id="basic-default-tiktok"
                                    placeholder="{{ __('cruds.setting.fields.tiktok') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-link_1">{{ __('cruds.setting.fields.link_1') }}</label>
                                <input type="url" value="{{ $row->link_1 }}" name="link_1"
                                    class="form-control" id="basic-default-link_1"
                                    placeholder="{{ __('cruds.setting.fields.link_1') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-link_2">{{ __('cruds.setting.fields.link_2') }}</label>
                                <input type="url" value="{{ $row->link_2 }}" name="link_2"
                                    class="form-control" id="basic-default-link_2"
                                    placeholder="{{ __('cruds.setting.fields.link_2') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-link_3">{{ __('cruds.setting.fields.link_3') }}</label>
                                <input type="url" value="{{ $row->link_3 }}" name="link_3"
                                    class="form-control" id="basic-default-link_3"
                                    placeholder="{{ __('cruds.setting.fields.link_3') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-email_1">{{ __('cruds.setting.fields.email_1') }}</label>
                                <input type="email" value="{{ $row->email_1 }}" name="email_1"
                                    class="form-control" id="basic-default-email_1"
                                    placeholder="{{ __('cruds.setting.fields.email_1') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-email_2">{{ __('cruds.setting.fields.email_2') }}</label>
                                <input type="email" value="{{ $row->email_2 }}" name="email_2"
                                    class="form-control" id="basic-default-email_2"
                                    placeholder="{{ __('cruds.setting.fields.email_2') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-email_3">{{ __('cruds.setting.fields.email_3') }}</label>
                                <input type="email" value="{{ $row->email_3 }}" name="email_3"
                                    class="form-control" id="basic-default-email_3"
                                    placeholder="{{ __('cruds.setting.fields.email_3') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-repeater">
                                <div data-repeater-list="increase">
                                    
                                    @if ($row->increase != null)

                                    @foreach (json_decode($row->increase) as $item)
                                        @php
                                        $c = 0;
                                        @endphp
                                    <div data-repeater-item>
                                        <div class="row">
                                            <div class="mb-3 col-10 mb-0">
                                                    <label class="form-label" for="form-repeater-{{ $c }}-1">{{ __('cruds.setting.fields.increase') }}</label>
                                                    <input type="number" value="{{ $item }}" step="0.5" name="increase[]" id="form-repeater-{{ $c }}-1" class="form-control" placeholder="{{ __('cruds.setting.fields.increase') }}" />
                                            </div>
                                            <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                                <button class="btn btn-label-danger mt-4" data-repeater-delete type="button"> 
                                                  <i class="ti ti-x ti-xs me-1"></i>
                                                  <span class="align-middle">Delete</span>
                                                </button>
                                              </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div data-repeater-item>
                                        <div class="row">
                                          <div class="mb-3 col-10 mb-0">
                                            <label class="form-label" for="form-repeater-0-1">{{ __('cruds.setting.fields.increase') }}</label>
                                            <input type="number" value="5" step="0.5" name="increase[]" id="form-repeater-0-1" class="form-control" placeholder="{{ __('cruds.setting.fields.increase') }}" />
                                          </div>
                                          <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                            <button class="btn btn-label-danger mt-4" data-repeater-delete type="button"> 
                                              <i class="ti ti-x ti-xs me-1"></i>
                                              <span class="align-middle">Delete</span>
                                            </button>
                                          </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="mb-0">
                                    <button class="btn btn-primary" type="button" data-repeater-create>
                                      <i class="ti ti-plus me-1"></i>
                                      <span class="align-middle">Add</span>
                                    </button>
                                  </div>
                            </div>

                           {{--  <div class="form-repeater">
                                <div data-repeater-list="group-a">
                                @if ($row->increase != null)
                                @php
                                    $c = 0;
                                @endphp
                                @foreach (json_decode($row->increase) as $item)
                                <div data-repeater-item>
                                    <div class="row">
                                      <div class="mb-3 col-10 mb-0">
                                        <label class="form-label" for="form-repeater-{{ $c }}-1">{{ __('cruds.setting.fields.increase') }}</label>
                                        <input type="number" value="{{ $item }}" step="0.5" name="increase[]" id="form-repeater-{{ $c }}-1" class="form-control" placeholder="{{ __('cruds.setting.fields.increase') }}" />
                                      </div>
                                                                     
                                      <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                        <button class="btn btn-label-danger mt-4" data-repeater-delete type="button"> 
                                          <i class="ti ti-x ti-xs me-1"></i>
                                          <span class="align-middle">Delete</span>
                                        </button>
                                      </div>
                                    </div>
                                    <hr />
                                  </div>
                                @endforeach
                               @else
                               <div data-repeater-item>
                                <div class="row">
                                  <div class="mb-3 col-10 mb-0">
                                    <label class="form-label" for="form-repeater-1-1">{{ __('cruds.setting.fields.increase') }}</label>
                                    <input type="number" step="0.5" name="increase[]" id="form-repeater-1-1" class="form-control" placeholder="{{ __('cruds.setting.fields.increase') }}" />
                                  </div>
                                                                 
                                  <div class="mb-3 col-2 d-flex align-items-center mb-0">
                                    <button class="btn btn-label-danger mt-4" data-repeater-delete type="button"> 
                                      <i class="ti ti-x ti-xs me-1"></i>
                                      <span class="align-middle">Delete</span>
                                    </button>
                                  </div>
                                </div>
                                <hr />
                              </div>
                                @endif
                                </div>
                                <div class="mb-0">
                                  <button class="btn btn-primary" type="button" data-repeater-create>
                                    <i class="ti ti-plus me-1"></i>
                                    <span class="align-middle">Add</span>
                                  </button>
                                </div>
                                <br><br>
                              </div> --}}
                        </div>
                       

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-min_withdraw">{{ __('cruds.setting.fields.min_withdraw') }}</label>
                                <input type="number" step="0.5" value="{{ $row->min_withdraw }}" name="min_withdraw"
                                    class="form-control" id="basic-default-min_withdraw"
                                    placeholder="{{ __('cruds.setting.fields.min_withdraw') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-min_deposit">{{ __('cruds.setting.fields.min_deposit') }}</label>
                                <input type="number" step="0.5" value="{{ $row->min_deposit }}" name="min_deposit"
                                    class="form-control" id="basic-default-min_deposit"
                                    placeholder="{{ __('cruds.setting.fields.min_deposit') }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label"
                                    for="basic-default-request_price">{{ __('cruds.setting.fields.request_price') }}</label>
                                <input type="number" step="0.5" value="{{ $row->request_price }}" name="request_price"
                                    class="form-control" id="basic-default-request_price"
                                    placeholder="{{ __('cruds.setting.fields.request_price') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('global.save') }}</button>

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>




@endsection
