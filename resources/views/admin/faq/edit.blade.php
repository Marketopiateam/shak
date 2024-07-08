@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.faq.title_singular') }}:
                    {{ trans('cruds.faq.fields.id') }}
                    {{ $faq->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('faq.edit', [$faq])
        </div>
    </div>
</div>
@endsection