@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.user.title_singular') }}:
                    {{ trans('cruds.user.fields.id') }}
                    {{ $user->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.id') }}
                            </th>
                            <td>
                                {{ $user->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <td>
                                {{ $user->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $user->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $user->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.email_verified_at') }}
                            </th>
                            <td>
                                {{ $user->email_verified_at }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.roles') }}
                            </th>
                            <td>
                                @foreach($user->roles as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.locale') }}
                            </th>
                            <td>
                                {{ $user->locale }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.country_code') }}
                            </th>
                            <td>
                                {{ $user->country_code }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.fcm_token') }}
                            </th>
                            <td>
                                {{ $user->fcm_token }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.is_active') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $user->is_active ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.login_type') }}
                            </th>
                            <td>
                                {{ $user->login_type }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.phone_number') }}
                            </th>
                            <td>
                                {{ $user->phone_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.profile_pic') }}
                            </th>
                            <td>
                                {{ $user->profile_pic }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.reviews_count') }}
                            </th>
                            <td>
                                {{ $user->reviews_count }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.reviews_sum') }}
                            </th>
                            <td>
                                {{ $user->reviews_sum }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.user.fields.wallet_amount') }}
                            </th>
                            <td>
                                {{ $user->wallet_amount }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('user_edit')
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection