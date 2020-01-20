<div class="form-group row">
    <label for="in_property" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>


    <div class="col-md-8">
        <label  class="col-form-label text-md-left">{{ __($property->name) }}</label>
            <input id="in_property" type="hidden" class="form-control" name="in_property" value="{{ $property->id}}" required  readonly/>
    </div>
</div>