{{-- <div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{ $id }}" class="col-sm-2 control-label">{{ $label }}</label>

    <div class="col-sm-6">

        @include('admin::form.error')

        <textarea class="form-control" id="{{ $id }}" name="{{ $name }}"
            placeholder="{{ trans('admin::lang.input') }} {{ $label }}" {!! $attributes !!}>{{ old($column, $value) }}</textarea>
    </div>
</div> --}}
<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">
    <label for="{{ $id }}" class="col-sm-2 control-label">{{ $label }}</label>
    <div class="col-sm-6 ">
        @include('admin::form.error')
        <span class="input-group-btn">
            <a id="{{ $id }}" data-input="{{ old($column, $value) }}" data-preview="holder2" class="btn btn-primary text-white">
                <i class="fa fa-picture-o"></i> Choose
            </a>
        </span>
        <input id="{{ $id }}" class="form-control" type="text" name="filepath" readonly>
    </div>
</div>
