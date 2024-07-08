<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('faq.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.faq.fields.description') }}</label>
        <input class="form-control" type="text" name="description" id="description" wire:model.defer="faq.description">
        <div class="validation-message">
            {{ $errors->first('faq.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.faq.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('faq.enable') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="enable" id="enable" wire:model.defer="faq.enable">
        <label class="form-label inline ml-1" for="enable">{{ trans('cruds.faq.fields.enable') }}</label>
        <div class="validation-message">
            {{ $errors->first('faq.enable') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.faq.fields.enable_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('faq.title') ? 'invalid' : '' }}">
        <label class="form-label" for="title">{{ trans('cruds.faq.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" wire:model.defer="faq.title">
        <div class="validation-message">
            {{ $errors->first('faq.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.faq.fields.title_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>