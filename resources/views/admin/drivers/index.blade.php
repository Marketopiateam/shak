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
<div class="card mb-4">
    <div class="card-header">
      <div class="d-flex justify-content-between mb-3">
        <h5 class="card-title mb-0">{{ __('app.statistics') }}</h5>
      </div>
    </div>
    <div class="card-body">
      <div class="row gy-3">
        <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded-pill bg-label-primary me-3 p-2">
              <i class="ti ti-users ti-sm"></i>
            </div>
            <div class="card-info">
              <h5 class="mb-0">{{ $allDriversCount }}</h5>
              <small>{{ __('app.all_drivers') }}</small>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded-pill bg-label-warning me-3 p-2">
              <i class="ti ti-alert-triangle ti-sm"></i>
            </div>
            <div class="card-info">
              <h5 class="mb-0">{{ $pendingDriversCount }}</h5>
              <small>{{ __('app.pending_drivers') }}</small>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded-pill bg-label-danger me-3 p-2">
              <i class="ti ti-ban ti-sm"></i>
            </div>
            <div class="card-info">
              <h5 class="mb-0">{{ $blockedDriversCount }}</h5>
              <small>{{ __('app.blocked_drivers') }}</small>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="d-flex align-items-center">
            <div class="badge rounded-pill bg-label-success me-3 p-2">
              <i class="ti ti-check ti-sm"></i>
            </div>
            <div class="card-info">
              <h5 class="mb-0">{{ $activeDriversCount }}</h5>
              <small>{{ __('app.active_drivers') }}</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="card">
    <div class="card-datatable table-responsive pt-0">
      <table class="datatables-basic table">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">{{ __('global.name') }}</th>
            <th class="text-center">{{ __('app.email') }}</th>
            <th class="text-center">{{ __('global.status') }}</th>
            <th class="text-center">{{ __('global.created_at') }}</th>
            <th class="text-center">{{ __('global.action') }}</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($rows as $item)
            <tr>
                <td class="text-center">{{ $item->id }}</td>
                <td class="text-center">{{ $item->user->full_name }}</td>
                <td class="text-center">{{ $item->user->email }}</td>
                <td class="text-center">
                    @if($item->status == 'pending')
                    <span class="badge bg-warning">{{__('app.pending')}}</span>
                    @elseif($item->status == 'active')
                    <span class="badge bg-success">{{__('app.active')}}</span>
                    @elseif($item->status == 'blocked')
                    <span class="badge bg-danger">{{__('app.blocked')}}</span>
                    @else
                    <span class="badge bg-danger">{{__('app.unknown')}}</span>
                    @endif
                </td>
                <td class="text-center">{{ $item->created_at }}</td>

                <td>
                    
                    <div class="d-flex justify-content-center">
                        @if($item->status == 'pending')
                        <form action="{{ route('admin.drivers.active', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" onclick="confirm('{{ __('app.are_you_sure') }}')" class="btn btn-success btn-sm me-1">
                                <i class="ti ti-check me-1"></i>
                                {{ __('app.active') }}
                            </button>  
                        </form>
                        <form action="{{ route('admin.drivers.block', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" onclick="confirm('{{ __('app.are_you_sure') }}')" class="btn btn-danger btn-sm me-1">
                                <i class="ti ti-ban me-1"></i>
                                {{ __('app.block') }}
                                </button>  
                        </form>
                        @elseif($item->status == 'active')
                        <form action="{{ route('admin.drivers.block', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" onclick="confirm('{{ __('app.are_you_sure') }}')" class="btn btn-danger btn-sm me-1">
                                <i class="ti ti-ban me-1"></i>
                                {{ __('app.block') }}
                                </button>  
                        </form>
                        @elseif($item->status == 'blocked')
                         <form action="{{ route('admin.drivers.active', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" onclick="confirm('{{ __('app.are_you_sure') }}')" class="btn btn-success btn-sm me-1">
                                <i class="ti ti-check me-1"></i>
                                {{ __('app.active') }}
                            </button>  
                        </form>
                        @else
                        @endif

                       
                        {{-- <form action="{{ route('admin.drivers.block', $item->id) }}">@csrf</form>
                        <form action="{{ route('admin.drivers.destroy', $item->id) }}">@csrf</form>
                        @if($item->status == 'pending')
                        
                        <a class="btn btn-danger btn-sm me-1" href="{{ route('admin.drivers.block', $item->id) }}">
                        </a>  
                        @elseif($item->status == 'active')
                        <a class="btn btn-success btn-sm me-1" href="{{ route('admin.drivers.block', $item->id) }}">
                            <i class="ti ti-check me-1"></i>
                            {{ __('app.block') }}
                        </a>  
                        @elseif($item->status == 'blocked')
                        <a class="btn btn-danger btn-sm me-1" href="{{ route('admin.drivers.active', $item->id) }}">
                            <i class="ti ti-ban me-1"></i>
                            {{ __('app.active') }}
                        </a>
                        @else
                        @endif --}}
                        <a class="btn btn-primary btn-sm me-1" href="{{ route('admin.drivers.show', $item->id) }}">
                            <i class="ti ti-eye me-1"></i>
                            {{ __('global.show') }}
                        </a>    
                        <a class="btn btn-danger btn-sm me-1" href="{{ route('admin.drivers.destroy', $item->id) }}">
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