@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.faq.title_singular') }}:
                    {{ trans('cruds.faq.fields.id') }}
                    {{ $faq->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.faq.fields.id') }}
                            </th>
                            <td>
                                {{ $faq->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.faq.fields.description') }}
                            </th>
                            <td>
                                {{ $faq->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.faq.fields.enable') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $faq->enable ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.faq.fields.title') }}
                            </th>
                            <td>
                                {{ $faq->title }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('faq_edit')
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection