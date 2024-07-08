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
                    <th class="text-center">{{ __('cruds.service.fields.image') }}</th>
                    <th class="text-center">{{ __('cruds.service.fields.title') }} </th>
                    <th class="text-center">{{ __('cruds.service.fields.admin_commission') }} </th>
                    <th class="text-center">{{ __('cruds.service.fields.enable') }} </th>
                    <th class="text-center">{{ __('cruds.service.fields.intercity_type') }} </th>
                    <th class="text-center">{{ __('cruds.service.fields.km_charge') }} </th>
                    <th class="text-center">{{ __('cruds.service.fields.offer_rate') }} </th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td class="text-center"><img src="{{ $item->thumbnail[0]['url'] }}" width="100"
                                height="100" alt=""></td>
                        <td class="text-center">{{ $item->title }}</td>
                        <td class="text-center">
                            @if ($item->admin_commission == null)
                                <i class="ti ti-circle-check text-danger"></i>
                            @else
                            {{ $item->admin_commission }}
                            @endif
                        </td>
                            
                            
                        <td class="text-center">
                            @if (!$item->enable)
                                <i class="ti ti-circle-check text-danger"></i>
                            @else
                                <i class="ti ti-circle-check text-success"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if (!$item->intercity_type)
                                {{ __('global.inter_city') }}
                            @else
                            {{ __('global.out_city') }}
                            @endif
                        </td>
                        <td class="text-center">{{ $item->km_charge }}</td>
                        <td class="text-center">
                            @if ($item->offer_rate)
                                <i class="ti ti-circle-check text-danger"></i>
                            @else
                                <i class="ti ti-circle-check text-success"></i>
                            @endif
                        </td>

                        <td>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary btn-sm me-1"
                                    href="{{ route('admin.services.edit', $item->id) }}">
                                    <i class="ti ti-edit me-1"></i>
                                    {{ __('global.edit') }}
                                </a>
                                <a class="btn btn-success btn-sm me-1"
                                    href="{{ route('admin.services.show', $item->id) }}">
                                    <i class="ti ti-eye me-1"></i>
                                    {{ __('global.show') }}
                                </a>
                                <a class="btn btn-danger btn-sm me-1"
                                    href="{{ route('admin.services.destroy', $item->id) }}">
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