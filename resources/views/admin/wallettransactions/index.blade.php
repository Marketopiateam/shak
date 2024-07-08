@extends('layouts.admin')
@section('content')
@section('title', $pageTitle)
@section('pageName', $pageTitle)
@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
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
            <th class="text-center">{{ __('global.amount') }}</th>
            <th class="text-center">{{ __('global.type') }}</th>
            <th class="text-center">{{ __('global.order') }}</th>
            <th class="text-center">{{ __('global.driver') }}</th>
            <th class="text-center">{{ __('global.user') }}</th>
            <th class="text-center">{{ __('global.created_at') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($rows as $item)
            <tr>
                <td class="text-center">{{ $item->id }}</td>
                <td class="text-center">{{ number_format($item->amount, 2) }} EGP</td>
                <td class="text-center">{{ $item->type }}</td>
                <td class="text-center">
                    @if ($item->order != null)
                        {{ $item->order->id }}
                    @else
                    <i class="ti ti-circle-check text-danger"></i>
                    @endif
                </td>
                <td class="text-center">
                    @if ($item->driver != null)
                        {{ $item->driver->email }}
                    @else
                    <i class="ti ti-circle-check text-danger"></i>
                    @endif
                </td>
                <td class="text-center">
                    @if ($item->user != null)
                        {{ $item->user->email }}
                    @else
                    <i class="ti ti-circle-check text-danger"></i>
                    @endif
                </td>
                <td class="text-center">
                   {{$item->created_at}}
                </td>
            </tr>
            @endforeach

           
        </tbody>
      </table>
    </div>
  </div>
@endsection