<div class="form-group row">
                            <label for="in_property_id" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>


                            <div class="col-md-8">
                                    <label  class="col-form-label text-md-left">{{ __($property->name) }}</label>
                                    <input id="in_property_id" type="hidden" class="form-control" name="in_property_id" value="{{ $property->id}}" required  readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="in_unit_id" class="col-md-4 col-form-label text-md-left">{{ __('In Unit') }}</label>

                            
                            <div class="col-md-8">
                                    <label  class="col-form-label text-md-left">{{ __($unit->unit_house_number) }}</label>
                                    <input id="in_unit_id" type="hidden" class="form-control" name="in_unit_id" value="{{ $unit->id}}" readonly/>
                            </div>
                        </div>