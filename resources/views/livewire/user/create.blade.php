<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('user.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.user.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="user.name">
        <div class="validation-message">
            {{ $errors->first('user.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.email') ? 'invalid' : '' }}">
        <label class="form-label required" for="email">{{ trans('cruds.user.fields.email') }}</label>
        <input class="form-control" type="email" name="email" id="email" required wire:model.defer="user.email">
        <div class="validation-message">
            {{ $errors->first('user.email') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.email_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.password') ? 'invalid' : '' }}">
        <label class="form-label required" for="password">{{ trans('cruds.user.fields.password') }}</label>
        <input class="form-control" type="password" name="password" id="password" required wire:model.defer="password">
        <div class="validation-message">
            {{ $errors->first('user.password') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.password_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('roles') ? 'invalid' : '' }}">
        <label class="form-label required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
        <x-select-list class="form-control" required id="roles" name="roles" wire:model="roles" :options="$this->listsForFields['roles']" multiple />
        <div class="validation-message">
            {{ $errors->first('roles') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.roles_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.locale') ? 'invalid' : '' }}">
        <label class="form-label" for="locale">{{ trans('cruds.user.fields.locale') }}</label>
        <input class="form-control" type="text" name="locale" id="locale" wire:model.defer="user.locale">
        <div class="validation-message">
            {{ $errors->first('user.locale') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.locale_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.country_code') ? 'invalid' : '' }}">
        <label class="form-label" for="country_code">{{ trans('cruds.user.fields.country_code') }}</label>
        <input class="form-control" type="text" name="country_code" id="country_code" wire:model.defer="user.country_code">
        <div class="validation-message">
            {{ $errors->first('user.country_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.country_code_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.fcm_token') ? 'invalid' : '' }}">
        <label class="form-label" for="fcm_token">{{ trans('cruds.user.fields.fcm_token') }}</label>
        <input class="form-control" type="text" name="fcm_token" id="fcm_token" wire:model.defer="user.fcm_token">
        <div class="validation-message">
            {{ $errors->first('user.fcm_token') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.fcm_token_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.is_active') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="is_active" id="is_active" wire:model.defer="user.is_active">
        <label class="form-label inline ml-1" for="is_active">{{ trans('cruds.user.fields.is_active') }}</label>
        <div class="validation-message">
            {{ $errors->first('user.is_active') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.is_active_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.login_type') ? 'invalid' : '' }}">
        <label class="form-label" for="login_type">{{ trans('cruds.user.fields.login_type') }}</label>
        <input class="form-control" type="text" name="login_type" id="login_type" wire:model.defer="user.login_type">
        <div class="validation-message">
            {{ $errors->first('user.login_type') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.login_type_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.phone_number') ? 'invalid' : '' }}">
        <label class="form-label" for="phone_number">{{ trans('cruds.user.fields.phone_number') }}</label>
        <input class="form-control" type="text" name="phone_number" id="phone_number" wire:model.defer="user.phone_number">
        <div class="validation-message">
            {{ $errors->first('user.phone_number') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.phone_number_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.profile_pic') ? 'invalid' : '' }}">
        <label class="form-label" for="profile_pic">{{ trans('cruds.user.fields.profile_pic') }}</label>
        <input class="form-control" type="text" name="profile_pic" id="profile_pic" wire:model.defer="user.profile_pic">
        <div class="validation-message">
            {{ $errors->first('user.profile_pic') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.profile_pic_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.reviews_count') ? 'invalid' : '' }}">
        <label class="form-label" for="reviews_count">{{ trans('cruds.user.fields.reviews_count') }}</label>
        <input class="form-control" type="text" name="reviews_count" id="reviews_count" wire:model.defer="user.reviews_count">
        <div class="validation-message">
            {{ $errors->first('user.reviews_count') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.reviews_count_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.reviews_sum') ? 'invalid' : '' }}">
        <label class="form-label" for="reviews_sum">{{ trans('cruds.user.fields.reviews_sum') }}</label>
        <input class="form-control" type="text" name="reviews_sum" id="reviews_sum" wire:model.defer="user.reviews_sum">
        <div class="validation-message">
            {{ $errors->first('user.reviews_sum') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.reviews_sum_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user.wallet_amount') ? 'invalid' : '' }}">
        <label class="form-label" for="wallet_amount">{{ trans('cruds.user.fields.wallet_amount') }}</label>
        <input class="form-control" type="text" name="wallet_amount" id="wallet_amount" wire:model.defer="user.wallet_amount">
        <div class="validation-message">
            {{ $errors->first('user.wallet_amount') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.user.fields.wallet_amount_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>