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
            <th class="text-center">{{ __('app.payroll_method') }}</th>
            <th class="text-center">{{ __('app.status') }}</th>
            <th class="text-center">{{ __('app.amount') }}</th>
            <th class="text-center">{{ __('app.note') }}</th>
            <th class="text-center">{{ __('app.user') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($rows as $item)
            <tr>
                <td class="text-center">{{ $item->id }}</td>
                <td class="text-center">{{ $item->payroll_method }}</td>
                <td class="text-center">
                    @if ($item->status == 'success')
                    <span class="badge bg-success">{{ $item->status }}</span>
                    @elseif ($item->status == 'pending')
                    <span class="badge bg-warning">{{ $item->status }}</span>
                    @elseif ($item->status == 'failed' || $item->status == 'rejected')
                    <span class="badge bg-danger">{{ $item->status }}</span>
                    @endif
                </td>
                <td class="text-center">{{ number_format($item->amount, 2) }} L.E</td>
                <td class="text-center">
                  @if ($item->note == null)
                  <span class="badge bg-danger">null</span>

                  @else
                      {{ $item->note }}
                  @endif
                </td>
                <td class="text-center">{{ $item->user->email }}</td>
                <td>
                  <a class="btn btn-success btn-sm me-1" href="{{ route('admin.payments.accept', $item->id) }}">
                    <i class="ti ti-edit me-1"></i>
                    {{ __('global.accept') }}
                </a>    
                <a class="btn btn-danger btn-sm me-1" href="{{ route('admin.payments.reject', $item->id) }}">
                    <i class="ti ti-eye me-1"></i>
                    {{ __('global.reject') }}
                </a>    
               
                </td>
            </tr>
            @endforeach

           
        </tbody>
      </table>
    </div>
  </div>
@endsection