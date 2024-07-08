@extends('layouts.admin')
@section('content')
@section('title', $pageTitle)
@section('pageName', $pageTitle)

<form action="{{ route('admin.payment-methods.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="nav-align-left nav-tabs-shadow mb-4">
        <ul class="nav nav-tabs" role="tablist">
            @foreach ($payment_methods as $key => $inputs)
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link {{ $loop->first ? 'active' : '' }}" role="tab"
                        data-bs-toggle="tab" data-bs-target="#{{ $key }}" aria-controls="{{ $key }}"
                        aria-selected="true">
                        {{ $key }}
                    </button>
                </li>
            @endforeach

        </ul>
        <div class="tab-content">
            @foreach ($payment_methods as $key => $inputs)
                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="{{ $key }}"
                    role="tabpanel">
                    @foreach ($inputs as $input => $value)
                    @if ($input == 'logo' && $value != null && $value != "")
                       <br>
                       <img src="{{ $value }}" alt="logo" width="200" height="200"> 
                       <br>                       
                       <br>                       
                    @endif

                        @if ($input == 'enabled')
                        <div class="mb-3">
                            <label class="switch switch-primary">
                                <input name="{{ $key . '[' . $input . ']' }}" type="checkbox" class="switch-input" {{ $value == 1 ? 'checked' : '' }}>
                                <span class="switch-toggle-slider">
                                  <span class="switch-on">
                                    <i class="ti ti-check"></i>
                                  </span>
                                  <span class="switch-off">
                                    <i class="ti ti-x"></i>
                                  </span>
                                </span>
                                <span class="switch-label">{{ __('app.' . $input) }}</span>
                              </label>
                        </div>
                        @else
                        <div class="mb-3">
                            <label class="form-label" for="{{ $input }}Input">{{ __('app.' . $input) }}</label>
                            <input {{ $input == 'name' ? 'readonly' : '' }}
                                type="{{ $input == 'logo' ? 'file' : 'text' }}" value="{{ $value }}"
                                name="{{ $key . '[' . $input . ']' }}" class="form-control"
                                id="{{ $input }}Input" placeholder={{ __('app.' . $input) }}>
                        </div>    
                        @endif
                        
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>


    {{-- <div class="">
        <ul class="nav nav-tabs languageModelSwitcher">
            @foreach ($payment_methods as $key => $inputs)
                <li class="nav-item">
                    <a class="nav-link active" id="{{ $key }}-tab" data-toggle="tab"
                        href="#{{ $key }}">{{ $key }}</a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach ($payment_methods as $key => $inputs)
                <div class="tab-pane fade show active" id="{{ $key }}">
                    @foreach ($inputs as $input => $value)
                        
                    @endforeach

                </div>
            @endforeach
        </div>
    </div> --}}
    <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('global.save') }}</button>
</form>
@push('scripts')
    <script src="{{ asset('marketopia/js/tabs.js') }}"></script>
@endpush
@endsection
