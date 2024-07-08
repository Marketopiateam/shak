@extends('layouts.admin')
@section('content')
@section('title', $pageTitle)
@section('pageName', $pageTitle)
@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet"
        href="{{ asset('/') }}assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css" />
@endpush
@push('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script>
@endpush
<div class="card">
    <div class="card-datatable table-responsive pt-0">
        <table class="datatables-basic table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">{{ __('app.name') }}</th>
                    <th class="text-center">{{ __('app.state') }}</th>
                    <th class="text-center">{{ __('app.country') }}</th>
                    <th class="text-center">{{ __('app.status') }}</th>
                    <th class="text-center">{{ __('app.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cities as $country)
                    <tr>
                        <td class="text-center">{{ $country->id }}</td>
                        <td class="text-center">{{ $country->translate(app()->getLocale())->name }}</td>    
                        <td class="text-center">
                            @if ($country->state != null)
                                {{ $country->state->translate(app()->getLocale())->name }}
                            @else
                                <span class="badge bg-danger">{{ __('app.not_found') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($country->country != null)
                                {{ $country->country->translate(app()->getLocale())->name }}
                            @else
                                <span class="badge bg-danger">{{ __('app.not_found') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($country->status == 1)
                                <span class="badge bg-success">{{ __('app.active') }}</span>
                            @else
                                <span class="badge bg-danger">{{ __('app.inactive') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                @if($country->status == 1)
                                <form action="{{ route('admin.cities.deactivate', $country->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="ti ti-close me-1"></i>
                                        {{ __('app.deactivate') }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.cities.activate', $country->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="ti ti-check me-1"></i>
                                        {{ __('app.activate') }}
                                    </button>
                                </form>
                            @endif
                    
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
