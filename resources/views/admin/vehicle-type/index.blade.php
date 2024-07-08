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
<div class="d-flex justify-content-end">
    <button class="btn add-new btn-primary mb-3 mb-md-0 waves-effect waves-light" 
    tabindex="0" aria-controls="DataTables_Table_0" 
    type="button" 
    data-bs-toggle="modal" 
    data-bs-target="#addVehicleTypenModal">
        <span>{{ __('app.add_vehicle_types') }}</span>
    </button>
</div>
<br>
<div class="card">
    
    <div class="card-datatable table-responsive pt-0">
        <table class="datatables-basic table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">{{ __('app.name') }}</th>
                    <th class="text-center">{{ __('app.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicleTypes as $country)
                    <tr>
                        <td class="text-center">{{ $country->id }}</td>
                        <td class="text-center">{{ $country->name }}</td>    
                      
                        <td>
                            <div class="d-flex justify-content-center">
                                @if($country->enable  == 1)
                                <form action="{{ route('admin.vehicle-types.deactivate', $country->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="ti ti-close me-1"></i>
                                        {{ __('app.deactivate') }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.vehicle-types.activate', $country->id) }}" method="POST">
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
<div class="modal fade" id="addVehicleTypenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-3 p-md-5">
        <button
          type="button"
          class="btn-close btn-pinned"
          data-bs-dismiss="modal"
          aria-label="Close"></button>
        <div class="modal-body">
          <div class="text-center mb-4">
            <h3 class="mb-2">{{ __('app.add_vehicle_types') }}</h3>
          </div>
          <form action="{{ route('admin.vehicle-types.store') }}" method="POST">
            @csrf
            <div class="col-12 mb-3">
              <label class="form-label" for="modalName">{{ __('app.name') }}</label>
              <input
                type="text"
                id="modalName"
                name="name"
                class="form-control"
                placeholder="{{ __('app.name') }}"
                autofocus />
            </div>
            <div class="col-12 mb-2">
              <label class="switch switch-primary">
                <input name="enable" type="checkbox" class="switch-input">
                <span class="switch-toggle-slider">
                  <span class="switch-on">
                    <i class="ti ti-check"></i>
                  </span>
                  <span class="switch-off">
                    <i class="ti ti-x"></i>
                  </span>
                </span>
                <span class="switch-label">{{ __('app.enabled') }}</span>
              </label>
            </div>
            <div class="col-12 text-center demo-vertical-spacing">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">{{ __('global.save') }}</button>
              <button
                type="reset"
                class="btn btn-label-secondary"
                data-bs-dismiss="modal"
                aria-label="Close">
                {{ __('global.discard') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

{{-- @extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        

    </div>
</div>

@endsection --}}