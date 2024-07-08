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
                    <th class="text-center">{{ __('cruds.freightVehicle.fields.image') }}</th>
                    <th class="text-center">{{ __('cruds.freightVehicle.fields.name') }} </th>
                    <th class="text-center">{{ __('cruds.freightVehicle.fields.enable') }} </th>
                    <th class="text-center">{{ __('cruds.freightVehicle.fields.height') }} </th>
                    <th class="text-center">{{ __('cruds.freightVehicle.fields.width') }} </th>
                    <th class="text-center">{{ __('cruds.freightVehicle.fields.km_charge') }} </th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center"><img src="{{ $item->thumbnail[0]['url'] }}" width="100"
                                height="100" alt=""></td>
                        <td class="text-center">{{ $item->name }}</td>
                        <td class="text-center">{{number_format($item->height, 2)}} cm</td>
                        <td class="text-center">{{number_format($item->width, 2)}} cm</td>
                        <td class="text-center">{{number_format($item->km_charge, 2)}} EGP</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary btn-sm me-1"
                                    href="{{ route('admin.freight-vehicles.edit', $item->id) }}">
                                    <i class="ti ti-edit me-1"></i>
                                    {{ __('global.edit') }}
                                </a>
                                <a class="btn btn-success btn-sm me-1"
                                    href="{{ route('admin.freight-vehicles.show', $item->id) }}">
                                    <i class="ti ti-eye me-1"></i>
                                    {{ __('global.show') }}
                                </a>
                                <a class="btn btn-danger btn-sm me-1"
                                    href="{{ route('admin.freight-vehicles.destroy', $item->id) }}">
                                    <i class="ti ti-trash me-1"></i>
                                    {{ __('global.delete') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
</div>
@endsection  
{{-- 

<div class="row">
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.freightVehicle.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('freight_vehicle_create')
                    <a class="btn btn-indigo" href="{{ route('admin.freight-vehicles.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.freightVehicle.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('freight-vehicle.index')

    </div>
</div>
@endsection --}}