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
            <th class="text-center">{{ __('app.payment_id') }}</th>
            <th class="text-center">{{ __('app.status') }}</th>
            <th class="text-center">{{ __('app.amount') }}</th>
            <th class="text-center">{{ __('app.payment_method') }}</th>
            <th class="text-center">{{ __('app.payment_gateway') }}</th>
            <th class="text-center">{{ __('app.user') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($rows as $item)
            <tr>
                <td class="text-center">{{ $item->id }}</td>
                <td class="text-center">{{ $item->payment_id }}</td>
                <td class="text-center">{{ $item->status }}</td>
                <td class="text-center">{{ number_format($item->amount, 2) }} L.E</td>
                <td class="text-center">{{ $item->payment_method }}</td>
                <td class="text-center">{{ $item->payment_gateway }}</td>
                <td class="text-center">{{ $item->user->email }}</td>
                
            </tr>
            @endforeach

           
        </tbody>
      </table>
    </div>
  </div>
@endsection