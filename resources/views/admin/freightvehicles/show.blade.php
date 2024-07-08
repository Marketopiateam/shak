@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.freightVehicle.title_singular') }}:
                    {{ trans('cruds.freightVehicle.fields.id') }}
                    {{ $freightVehicle->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.id') }}
                            </th>
                            <td>
                                {{ $freightVehicle->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.description') }}
                            </th>
                            <td>
                                {{ $freightVehicle->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.enable') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $freightVehicle->enable ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.height') }}
                            </th>
                            <td>
                                {{ $freightVehicle->height }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.image') }}
                            </th>
                            <td>
                                {{ $freightVehicle->image }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.km_charge') }}
                            </th>
                            <td>
                                {{ $freightVehicle->km_charge }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.length') }}
                            </th>
                            <td>
                                {{ $freightVehicle->length }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.name') }}
                            </th>
                            <td>
                                {{ $freightVehicle->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.freightVehicle.fields.width') }}
                            </th>
                            <td>
                                {{ $freightVehicle->width }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('freight_vehicle_edit')
                    <a href="{{ route('admin.freight-vehicles.edit', $freightVehicle) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.freight-vehicles.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection