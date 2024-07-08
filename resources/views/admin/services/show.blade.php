@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.service.title_singular') }}:
                    {{ trans('cruds.service.fields.id') }}
                    {{ $service->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.id') }}
                            </th>
                            <td>
                                {{ $service->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.admin_commission') }}
                            </th>
                            <td>
                                {{ $service->admin_commission }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.enable') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $service->enable ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.image') }}
                            </th>
                            <td>
                                {{ $service->image }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.intercity_type') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $service->intercity_type ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.km_charge') }}
                            </th>
                            <td>
                                {{ $service->km_charge }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.offer_rate') }}
                            </th>
                            <td>
                                {{ $service->offer_rate }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.service.fields.title') }}
                            </th>
                            <td>
                                {{ $service->title }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('service_edit')
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection